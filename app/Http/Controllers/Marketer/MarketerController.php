<?php

namespace App\Http\Controllers\Marketer;

use App\Models\Marketer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class MarketerController extends MarketerBaseController
{

    protected $paginate = 2;

    public function index()
    {
        return view('marketer.index');
    }

    public function commissions()
    {
        $commissions = $this->marketer->user()->commissions()->orderBy('created_at', 'desc')->paginate(2);
        
        return view('marketer.commissions',compact('commissions'));
    }


    public function getUsers(Request $request)
    {
        if(!isset($request->date))
            $users = User::withTrashed()->where('marketer_id',$this->marketer->id())->orderBy('created_at', 'desc')->paginate(2);
        else{
            $date = $request->date;
            $date = explode('/',$date);
            $date = $date[1] . "-" . $date[0];
            $users = User::withTrashed()->where('marketer_id',$this->marketer->id())->where('created_at','like',"$date%")->orderBy('created_at', 'desc')->paginate(2);
        }
        
        return view('marketer.users.index',compact('users'));

    }
    
    
    public function getUser($id)
    {
        $showing_user = User::findOrFail($id);
        
        return view('marketer.users.show',compact('showing_user'));
    }
}
