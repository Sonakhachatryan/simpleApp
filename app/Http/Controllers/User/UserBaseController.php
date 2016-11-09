<?php

namespace App\Http\Controllers\User;

use App\Traits\Notifications;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notifiable;
use App\Traits\Common;
use App\Http\Controllers\NotificationsController;

class UserBaseController extends Controller
{
    use Notifications;

    protected  $user;

    public function __construct()
    {
        $this->middleware('auth:user');
        $this->user = auth('user');
        $notifications  = $this->getLastFiveUnreadNotifications('user', 'App\User');
        $unread_notifications_count =$this->getUnreadNotificationsCount('user', 'App\User');
        view()->share(['user' => $this->user,'unread_notifications' => $notifications,'unread_notifications_count' => $unread_notifications_count]);
    }


    public function getAllNotifications()
    {
        $notifications = Notifiable::with('notification')->where([
            'notifiable_id' => $this->user->id(),
            'notifiable_type' => 'App\User',
        ])->orderBy('created_at','desc')->paginate(15);

        return view('user.notifications',compact('notifications'));
    }
    
}
