<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CardBuy
 * @package App\Models
 * @version October 7, 2017, 9:00 am UTC
 *
 * @property string order_num
 * @property float price
 * @property string status
 * @property integer user_id
 */
class CardBuy extends Model
{
    use SoftDeletes;

    public $table = 'card_buys';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'order_num',
        'price',
        'status',
        'user_id',
        'shop_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_num' => 'string',
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
        'order_num' => 'required',
        'price' => 'required',
        'status' => 'required',
        'user_id' => 'required'
    ];

    // 会员卡所属店铺
    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }
    
}
