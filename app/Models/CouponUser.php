<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CouponUser
 * @package App\Models
 * @version October 23, 2017, 5:05 pm CST
 *
 * @property string name
 * @property date time_begin
 * @property date time_end
 * @property string type
 * @property float base
 * @property float given
 * @property float discount
 * @property string together
 * @property string status
 */
class CouponUser extends Model
{
    use SoftDeletes;

    public $table = 'coupon_users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'time_begin',
        'time_end',
        'type',
        'base',
        'given',
        'discount',
        'together',
        'status',
        'user_id',
        'order_no'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'time_begin' => 'date',
        'time_end' => 'date',
        'type' => 'string',
        'base' => 'float',
        'given' => 'float',
        'discount' => 'float',
        'together' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
