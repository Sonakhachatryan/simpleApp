<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Notification;
use App\Models\Notifiable;
use Illuminate\Http\Request;
use Session;

class NotificationsController extends Controller
{
    
   static public function question_added_to__questionary($user,$question)
   {
       $notification = Notification::where('title','question_added')->first();
       Notifiable::create([
           'notifiable_id' => $user,
           'notifiable_type' => 'App\User',
           'notification_id' => $notification->id,
           'url' => "user/question/$question/answer" ,
           'status' =>'not viewed',
       ]);
   }

    static public function answer_approved($user,$question)
   {
       $notification = Notification::where('title','answer_approved')->first();
       Notifiable::create([
           'notifiable_id' => $user,
           'notifiable_type' => 'App\User',
           'notification_id' => $notification->id,
           'url' =>"user/question/answer/$question/show",
           'status' =>'not viewed',
       ]);
   }
    static public function answer_added($admin,$user,$question)
   {
       $notification = Notification::where('title','answer_added')->first();
       Notifiable::create([
           'notifiable_id' => $admin,
           'notifiable_type' => 'App\Models\Admin',
           'notification_id' => $notification->id,
           'url' => 'admin/user/' . $user . '/question/' . $question . '/answer',
           'status' =>'not viewed',
       ]);
       
       return true;
   }

    static public function answer_updated($admin,$user,$question)
   {
       $notification = Notification::where('title','answer_updated')->first();
       Notifiable::create([
           'notifiable_id' => $admin,
           'notifiable_type' => 'App\Models\Admin',
           'notification_id' => $notification->id,
           'url' => "/admin/user/$user/question/$question/answer",
           'status' =>'not viewed',
       ]);
   }


    static public function user_registers($admin,$user)
   {
       $notification = Notification::where('title','user_registers')->first();
       Notifiable::create([
           'notifiable_id' => $admin,
           'notifiable_type' => 'App\Models\Admin',
           'notification_id' => $notification->id,
           'url' => 'admin/users/' . $user,
           'status' =>'not viewed',
       ]);
   }  
    
    static public function user_activated($admin,$user)
   {
       $notification = Notification::where('title','user_activated')->first();
       Notifiable::create([
           'notifiable_id' => $admin,
           'notifiable_type' => 'App\Models\Admin',
           'notification_id' => $notification->id,
           'url' => 'admin/users/' . $user,
           'status' =>'not viewed',
       ]);
   }

    
    static public function user_approved($user)
   {
       $notification = Notification::where('title','user_approved')->first();
       Notifiable::create([
           'notifiable_id' => $user,
           'notifiable_type' => 'App\User',
           'notification_id' => $notification->id,
           'status' =>'not viewed',
           'url'=>'user/account'
       ]);
   }

    static public function marketer_registers($admin,$marketer)
    {
        $notification = Notification::where('title','marketer_registers')->first();
        Notifiable::create([
            'notifiable_id' => $admin,
            'notifiable_type' => 'App\Models\Admin',
            'notification_id' => $notification->id,
            'status' =>'not viewed',
            'url'=>'admin/marketer/' . $marketer->id,
        ]);
    }


    static public function promo_code_uses($marketer,$user)
    {
        $notification = Notification::where('title','promo_code_uses')->first();
        Notifiable::create([
            'notifiable_id' => $marketer,
            'notifiable_type' => 'App\Models\Marketer',
            'notification_id' => $notification->id,
            'status' =>'not viewed',
            'url'=>'marketer/users/' . $user,
        ]);
    }
    
}
