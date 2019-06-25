<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','header', 'mobile', 'shenfenzheng', 'address', 'weixin', 'nickname', 'type', 'birthday','account_price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //会员卡
    public function cards()
    {
        return $this->hasMany('App\Models\MemberCard')->where('member_cards.end', '>', Carbon::now());
    }

    //订单
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
	
	 //操作记录
    public function account(){
        return $this->hasMany('App\Models\account_user');
    }

    //银行卡信息
    public function bankinfo()
    {
        return $this->hasMany('App\Models\bankinfo');
    }

    //参与团购
    public function tuanbuys(){
        return $this->hasMany('App\Models\TuanBuy');
    }
	
	 //所参加的拼团
    public function join_product(){
        return $this->belongsToMany('App\Models\products','product_user','product_id','user_id');
    }

    public function join_tuan()
    {
        return $this->belongsToMany('App\Models\Tuaninfo', 'tuaninfo_user', 'tuaninfo_id', 'user_id');
    }

    public function getShiMingAttribute()
    {
        if (empty($this->shenfenzheng)) {
            return '否';
        } else {
            return '是';
        }
    }
}
