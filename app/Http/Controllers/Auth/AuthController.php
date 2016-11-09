<?php

namespace App\Http\Controllers\Auth;

use App\Models\Commission;
use App\Models\Marketer;
use App\Models\UserActivation;
use App\User;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PaypalController;
use Mail;
use Exception;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $guard = 'user';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
            'status' => 'required',
            'payment' => 'required',
            'promo_code' => 'exists:marketers,promo_code',
//            'terms' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $create = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => $data['status'],
            'avatar' => 'user.png',
            'deleted_at' => Carbon::now(),
        ];

        if(isset($data['promo_code']))
            $create['promo_code'] = $data['promo_code'];

            $user = User::create($create);
            $token = csrf_token();
            $url = "http://keepingitsimple.app/approve-account/$user->id/$token";

            UserActivation::create(['user_id' => $user->id,'token' =>$token]);
        try{
            Mail::send('emails.confirm', array('url' => "$url"), function($message) use ($user)
            {
                $message->from('simpleapp789@gmail.com', 'Simple');
                $message->to("$user->email", "$user->name")->subject('Confirmation!');
            });
        }catch(Exception $e){
            User::withTrashed()->find($user->id)->forceDelete();
            if($e->getCode() == 554)
                return view('auth.register')->with('email_error', 'Email doesn\'t exists.');
            else
                return back()->with('error', 'Something went wrong');
        }

        if ($data['payment'] == 'paypal')
            return redirect("getCheckout/$user->status/$user->id");

        elseif ($data['payment'] == 'card'){
            try {

                if ($user->status == 'gold')
                    $amount=1000;
                else
                    $amount=500;

                \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
                $token = $data['stripeToken'];
                $charge = \Stripe\Charge::create(array(
                    "amount" => $amount, // Amount in cents
                    "currency" => "usd",
                    "source" => $token,
                ));
            }catch(\Stripe\Error\Card $e) {
                User::withTrashed()->find($user->id)->forceDelete();
               return view('auth.register')->with('error',"Something went wrong.");
            }


            if($data['promo_code']!= "") {
                $marketer = Marketer::where('promo_code',$data['promo_code'])->first();
            }

            if(isset($marketer))
            {
                $commission = $user->status == 'gold' ? 10:5;
                $commission1 = $commission + $marketer->current_commissions;
                $marketer->update(['current_commissions'=> $commission1]);
                $commissions = Commission::where('marketer_id',$marketer->id)->orderBy('id','DESC')->first();
                $commission+=$commissions->commissios;
                $commissions->update(['commissios' =>  $commission ]);
                NotificationsController::promo_code_uses($marketer->id, $user->id);
            }


            // Clear the shopping cart, write to database, send notifications, etc.

            // Thank the user for the purchase
            NotificationsController::user_registers(1, $user->id);
            return view('auth/login')->with('success','Your registration completed, please check your email to activate account.');
        }

    }

    public function activate($id, $token)
    {
        if (UserActivation::where(['user_id' => $id, 'token' => $token])->first()) {

            $user = User::withTrashed()->findOrFail($id);
            $user->update(['deleted_at' => NULL]);
            NotificationsController::user_activated(1, $user->id);
            NotificationsController::user_approved($user->id);
            auth('user')->login($user);
            return redirect('home');
        }
        dd('No,no,no');

    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        return $this->create($request->all());
    }
    
}
