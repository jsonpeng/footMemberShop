<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CouponNewUser
 * @package App\Models
 * @version October 23, 2017, 5:41 pm CST
 *
 * @property integer new_open
 */
class CouponNewUser extends Model
{
    use SoftDeletes;

    public $table = 'coupon_new_users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'new_open'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'new_open' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'new_open' => 'required'
    ];

    
}
