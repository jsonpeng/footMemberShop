<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\CardBuy;
use App\Models\Order;
/**
 * Class MemberCard
 * @package App\Models
 * @version October 7, 2017, 2:13 am UTC
 *
 * @property integer shop_id
 * @property timestamp start
 * @property timestamp end
 * @property integer user_id
 */
class MemberCard extends Model
{
    use SoftDeletes;

    public $table = 'member_cards';
    

    protected $dates = ['deleted_at', 'start', 'end'];


    public $fillable = [
        'shop_id',
        'start',
        'end',
        'user_id',
        'card_no',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'shop_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shop_id' => 'required',
        'start' => 'required',
        'end' => 'requied',
        'user_id' => 'required'
    ];

    // 会员卡所属用户
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getExpiredAttribute(){
        if ($this->end->lt(Carbon::now())) {
            return '是';
        }else{
            return '否';
        }

    }

    // 会员卡所属店铺
    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }

    public function getTradeNoAttribute(){
        $cardBuy = CardBuy::where('user_id', $this->user_id)->where('shop_id', $this->shop_id)->where('status', '已支付')->first();
        if (is_null($cardBuy)) {
            return '';
        } else {
            return $cardBuy->order_num;
        }
    }

    public function getShoppingCountAttribute(){
        return Order::where('user_id', $this->user_id)->where('shop_id', $this->shop_id)->where('status', '已支付')->whereBetween('updated_at', [$this->start, $this->end])->count();    
    }

    public function getShoppingAmountAttribute(){
        return Order::where('user_id', $this->user_id)->where('shop_id', $this->shop_id)->where('status', '已支付')->whereBetween('updated_at', [$this->start, $this->end])->sum('price');    
    }

    public function getUsedCouponsAttribute(){
        return Order::where('user_id', $this->user_id)->where('shop_id', $this->shop_id)->where('status', '已支付')->whereBetween('updated_at', [$this->start, $this->end])->where('coupon_id', '<>', 0)->count();    
    }
}
