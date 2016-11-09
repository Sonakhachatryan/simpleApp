<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\View;

class Answer extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answers';

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
    protected $fillable = ['content','question_id','status','user_id','alias','deleted_at'];

    protected $dates = ['deleted_at'];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'answer_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($answer)
        {
            $notifications = Notifiable::where('url','admin/user/' . $answer->user_id .'/question/' . $answer->question_id . '/answer')->get();
            foreach($notifications as $notification)
                $notification->delete();

            $notifications = Notifiable::where('url','user/question/answer/' . $answer->question_id .'/show')->get();
            foreach($notifications as $notification)
                $notification->delete();

        });
    }

}
