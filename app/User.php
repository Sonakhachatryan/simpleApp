<?php

namespace App;

use App\Models\Answer;
use App\Models\Marketer;
use App\Models\Question;
use App\Models\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'alias',
        'deleted_at',
        'avatar',
        'payment_id',
        'marketer_id',
        'facebook',
        'twitter',
        'google',
        'pinterest',
        'about'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class,'user_question')->withPivot('status');
    }

    public function asked()
    {
        return $this->morphMany(Question::class, 'questionable');
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function marketer()
    {
        return $this->hasOne(Marketer::class);
    }
    
    public static function boot()
    {
        parent::boot();

        static::deleting(function($user)
        {
            $notifications = Notifiable::where(['notifiable_id' => $user->id, 'notifiable_type' => 'App\User'])->get();
            foreach($notifications as $notification)
                $notification->delete();
            
            $notifications = Notifiable::where('url','admin/users/' . $user->id)->get();
            foreach($notifications as $notification)
                $notification->delete();

            if ($user->avatar !=""  &&  $user->avatar != "user.png" ) {
                $file = 'images/users/' . $user->avatar;
                if(file_exists($file))
                    unlink($file);
            }
        });
    }
}
