<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coupon
 * @package App\Models
 * @version October 23, 2017, 4:59 pm CST
 *
 * @property string name
 * @property string type
 * @property string time_type
 * @property date time_begin
 * @property date time_end
 * @property float base
 * @property float given
 * @property float discount
 * @property string together
 * @property integer expired_days
 */
class Coupon extends Model
{
    use SoftDeletes;

    public $table = 'coupons';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'type',
        'time_type',
        'time_begin',
        'time_end',
        'base',
        'given',
        'discount',
        'together',
        'expired_days'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'string',
        'time_type' => 'string',
        'time_begin' => 'date',
        'time_end' => 'date',
        'base' => 'float',
        'given' => 'float',
        'discount' => 'float',
        'together' => 'string',
        'expired_days' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'type' => 'required',
        'time_type' => 'required'
    ];

    
}
