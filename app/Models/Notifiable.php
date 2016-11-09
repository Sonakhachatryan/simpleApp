<?php

namespace App\Models;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;

class Notifiable extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifiable';

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
    protected $fillable = ['notification_id','notifiable_id','notifiable_type','url','status'];

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
