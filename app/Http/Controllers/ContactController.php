<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Requests;
use App\Models\Contact;
use App\User;
use Illuminate\Http\Request;
use Mail, Session;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(auth('user')->check())
            new UserBaseController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Contact::where('role','phone')->get();
        $emails = Contact::where('role','email')->get();
        $address = Contact::where('role','address')->get();
        $facebook = Contact::where('role','Facebook')->first();
        $twitter = Contact::where('role','Twitter')->first();
        $pinterest = Contact::where('role','Pinterest')->first();
        $google = Contact::where('role','Google+')->first();

        return view('contact', compact('phones','emails','address','contacts','facebook','twitter','pinterest','google'));
    }
    
    public function getLocation()
    {
        $longitude = Contact::where('role','Longitude')->first();
        $latitude = Contact::where('role','latitude')->first();
        return response()->json(['lang' =>$longitude->value,'lat' =>$latitude->value ]);
    }

    public function sendMail(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'content' => 'required',
            'email' => 'required|email',
        ]);
        
        $mail = Contact::where('role','ContactEmail')->first();

        Mail::send('emails.contact', ['phone' => "$request->phone", 'content' => $request->content], function($message) use ($mail,$request)
        {
            $message->from($request->email, $request->name);
            $message->to($mail->value)->subject('Contact');
        });

        Session::flash('success', 'Message sended!');

        return back();
    }

}
