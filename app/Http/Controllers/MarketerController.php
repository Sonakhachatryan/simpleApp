<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\UserBaseController;
use App\Http\Requests;
use App\Models\Partner;

use App\User;
use Illuminate\Http\Request;

class MarketerController extends Controller
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
        $record = Partner::first();

        return view('partnerWithUs',compact('record'));
    }


}
