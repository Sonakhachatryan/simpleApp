<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'about';

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
    protected $fillable = ['devider_text','about_hading','about_content','image_haed','image_text'];

}
