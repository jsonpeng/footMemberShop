<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models
 * @version October 7, 2017, 2:15 am UTC
 *
 * @property string no
 * @property float price
 * @property string status
 * @property integer user_id
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'no',
        'price',
        'status',
        'user_id',
        'shop_id',
        'coupon_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'no' => 'string',
        'price' => 'float',
        'status' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'no' => 'required',
        'price' => 'required',
        'status' => 'required',
        'user_id' => 'reuqired'
    ];

    // 订单所属店铺
    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }

    // 订单所属用户
    public function user(){
        return $this->belongsTo('App\User');
    }

    
}
