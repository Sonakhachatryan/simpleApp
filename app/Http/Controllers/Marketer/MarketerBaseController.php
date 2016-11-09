<?php

namespace App\Http\Controllers\Marketer;

use App\Traits\Notifications;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notifiable;
use App\Traits\Common;
use App\Http\Controllers\NotificationsController;

class MarketerBaseController extends Controller
{
    use Notifications;

    protected  $marketer;

    public function __construct()
    {  
        $this->middleware('auth:marketer');
        $this->marketer = auth('marketer');
        $notifications  = $this->getLastFiveUnreadNotifications('marketer', 'App\Models\Marketer');
        $unread_notifications_count =$this->getUnreadNotificationsCount('marketer', 'App\Models\Marketer');
        view()->share(['marketer' => $this->marketer,'unread_notifications' => $notifications,'unread_notifications_count' => $unread_notifications_count]);
    }


    public function getAllNotifications()
    {
        $notifications = Notifiable::with('notification')->where([
            'notifiable_id' => $this->marketer->id(),
            'notifiable_type' => 'App\Models\Marketer',
        ])->orderBy('created_at','desc')->paginate(15);

        return view('marketer.notifications',compact('notifications'));
    }

}
