<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Notifiable;
use App\Traits\Notifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;

class AdminBaseController extends Controller
{
    protected $admin;
    use Notifications;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->admin = auth('admin');
        $notifications  = $this->getLastFiveUnreadNotifications('admin','App\Models\Admin');
        $unread_notifications_count =$this->getUnreadNotificationsCount('admin','App\Models\Admin');
        view()->share(['admin' => $this->admin,'unread_notifications' => $notifications,'unread_notifications_count' =>$unread_notifications_count]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }


    public function getAllNotifications()
    {
        $notifications = Notifiable::with('notification')->where([
            'notifiable_id' => $this->admin->id(),
            'notifiable_type' => 'App\Models\Admin',
        ])->orderBy('created_at','desc')->paginate(15);

        return view('admin.notifications',compact('notifications'));
    }


}
