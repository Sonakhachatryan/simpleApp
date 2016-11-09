<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['content','questionable_id','questionable_type'];

    public function questionable()
    {
        return $this->morphTo();
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_question');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($qusetion)
        {
            $notifications = Notifiable::where('url','user/question/' . $qusetion->id. '/answer')->get();
            foreach($notifications as $notification)
                $notification->delete();

            $notifications = Notifiable::where('url','like','admin/user/%/question/'. $qusetion->id .'/answer')->get();
            foreach($notifications as $notification)
                $notification->delete();

        });
    }
}
