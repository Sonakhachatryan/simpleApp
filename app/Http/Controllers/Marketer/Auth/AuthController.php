<?php

namespace App\Http\Controllers\Marketer\Auth;

use App\Models\Marketer;
use App\Models\Commission;
use App\User;
use Carbon\Carbon;
use Mockery\CountValidator\Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\NotificationsController;
use Mail,Response;
use Exeption;


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

    protected $redirectTo = '/marketer/account';

    protected $guard='marketer';
    protected $redirectPath = 'marketer/account';
    protected $loginView = 'marketer.auth.login';
    protected $registerView = 'marketer.auth.register';
    protected $redirectAfterLogout = 'marketer/auth';
    
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
            'email' => 'required|email|max:255|unique:marketers,email',
            'password' => 'required|confirmed',
            'terms' => 'required|mimes:docx,pdf',
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
        $bool = true;
        $promo_code=0;

        while($bool)
        {
            $promo_code = rand(1000000000, 9999999999);
            if(!Marketer::where('promo_code',$promo_code)->first())
                $bool = false;
        }

        $contract = request()->file('terms');
        $extension = $contract->getClientOriginalExtension();
        $name = $contract->getClientOriginalName();
        $pos = strpos($name,'.');
        $name = substr($name, 0, $pos);

        $name = $name . $promo_code . '.' . $extension;
        $contract->move('contract/marketerContracts', $name);
       
//        $this->uploadFile($image,$data['avatar'],$this->user->user()->avatar);


        $marketer = Marketer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'promo_code' => $promo_code,
            'contract' => $name,
            'deleted_at' => Carbon::now(),
        ]);

        Commission::create(['marketer_id' => $marketer->id]);

        try{
            Mail::send('emails.promoCode', ['code' => "$promo_code"], function ($message) use ($marketer) {
                $message->from('sona.khachatryan1995@gmail.com', 'Simple');
                $message->to($marketer->email, "$marketer->name")->subject('Welcome!');
            });
        }catch (Exception $e){
            User::withTrashed()->find($marketer->id)->forceDelete();
            if($e->getCode() == 554)
                return view('marketer.auth.auth')->with('email_error', 'Email doesn\'t exists.');
            else
                return back()->with('error', 'Something went wrong');
        }
        
        
        // Clear the shopping cart, write to database, send notifications, etc.

        NotificationsController::marketer_registers(1, $marketer);
        
        return $marketer;
    }

    public function showForm()
    {
        return view('marketer.auth.auth');
    }

    public function getCredentials(Request $request)
    {
        return ['email' => $request->login_email, 'password' => $request->login_password];
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'login_email' => 'required|exists:marketers,email',
            'login_password' => 'required',
        ],[
            'login_email.required' => 'Email field id required.',
            'login_password.required' => 'Password field id required.',
        ]);
    }


    public function getDownload(){
        //PDF file is stored under project/public/download/info.pdf
        $file="contract/Affiliate Marketing Agreement.docx";
        return Response::download($file);
    }


}
