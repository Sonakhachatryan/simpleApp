<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\UserActivation;
use App\User;
use Illuminate\Http\Request;
use Netshell\Paypal\Facades\Paypal as Paypal;
use Mail;
use Redirect;

class PaypalController extends Controller
{
    private $_apiContext;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function getCheckout($status,$id)
    {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');
        $amount = PayPal::Amount();
        $amount->setCurrency('USD');
        
        if ($status == 'gold')
            $amount->setTotal(10);
        else
            $amount->setTotal(5);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('What are you selling?');

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('PaypalController@getDone'));
        $redirectUrls->setCancelUrl(url($id . '/getCancel'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        User::withTrashed()->find($id)->update(["payment_id" => $payment->id]);
        return Redirect::to($redirectUrl);
    }

    public function getDone(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');


        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $user = User::withTrashed()->where("payment_id",$id)->first();

//        $token = csrf_token();
//        $url = "http://keepingitsimple.app/approve-account/$user->id/$token";
//        UserActivation::create(['user_id' => $user->id,'token' =>$token]);
//
//        Mail::send('emails.confirm', array('url' => "$url"), function($message) use ($user)
//        {
//            $message->from('sona.khachatryan1995@gmail.com', 'Simple');
//            $message->to($user->email, "$user->name")->subject('Confirmation!');
//        });

        if(isset($user->promo_code)) {
            $marketer = Marketer::where('promo_code',$user->promo_code)->first();
        }

        if(isset($marketer))
        {
            $commission = $user->status == 'gold' ? 10:5;
            $commission1 = $commission + $marketer->current_commissions;
            $marketer->update(['current_commissions'=> $commission1]);
            $commissions = Commission::where('marketer_id',$marketer->id)->orderBy('id','DESC')->first();
            $commission+=$commissions->commissios;
            $commissions->update(['commissios' =>  $commission ]);
            NotificationsController::promo_code_uses($marketer->id,$user->id);
        }

        // Clear the shopping cart, write to database, send notifications, etc.

        // Thank the user for the purchase
        NotificationsController::user_registers(1, $user->id);
        return view('auth/register')->with('success','Your registration completed, please check your email to activate account.');
    }

    public function getCancel($id,Request $request)
    {
        User::withTrashed()->where('id',$id)->first()->forceDelete();
        
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return view('auth.register')->withErrors('Something went wrong');
    }


}
