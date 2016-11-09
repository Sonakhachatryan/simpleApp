<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerTag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answer_tag';

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
    protected $fillable = ['tag_id','answer_id'];

}
