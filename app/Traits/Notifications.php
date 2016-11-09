<?php

namespace App\Traits;

//use App\Http\Controllers\NotificationsController;

use App\Models\Notifiable;

trait Notifications
{
    public function getUnreadNotificationsCount($user,$model)
    {
        return Notifiable::where([
            'notifiable_id' => $this->$user->id(),
            'notifiable_type' => $model,
            'status' => 'not viewed'
        ])->get()->count();
    }

    public function getLastFiveUnreadNotifications($user,$model)
    {
        $unread_notifications = Notifiable::with('notification')->where([
            'notifiable_id' => $this->$user->id(),
            'notifiable_type' => $model,
            'status' => 'not viewed'
        ])->orderBy('created_at','desc')->limit(5)->get();

        return $unread_notifications;
    }

    public function changeStatus($id)
    {
        $notification = Notifiable::findOrFail($id);
        $notification->update(['status' => 'viewed']);

        return redirect($notification->url);
    }
    

}