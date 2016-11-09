<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marketer extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','avatar', 'email', 'password','promo_code','current_commissions','contract','deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $dates = ['deleted_at'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
