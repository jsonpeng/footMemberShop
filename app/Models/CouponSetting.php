<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CouponSetting
 * @package App\Models
 * @version October 23, 2017, 6:00 pm CST
 *
 * @property integer coupon_id
 * @property integer number
 */
class CouponSetting extends Model
{
    use SoftDeletes;

    public $table = 'coupon_settings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'coupon_id',
        'number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'coupon_id' => 'integer',
        'number' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'coupon_id' => 'required',
        'number' => 'required'
    ];


    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon');
    }

    
}
