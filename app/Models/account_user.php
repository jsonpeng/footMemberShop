<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class account_user
 * @package App\Models
 * @version October 23, 2017, 5:44 pm CST
 *
 * @property integer user_id
 * @property string type
 * @property float price
 * @property string status
 * @property string arrive_time
 */
class account_user extends Model
{
    use SoftDeletes;

    public $table = 'account_users';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'no',
        'user_id',
        'type',
        'price',
        'status',
        'arrive_time',
        'bankinfo_id',
        'account_tem',
        'card_name',
        'starthu',
        'user_name',
        'user_mobile',
        'card_no'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'no'=>'string',
        'user_id' => 'integer',
        'type' => 'string',
        'price' => 'float',
        'status' => 'string',
        'arrive_time' => 'string',
        'bankinfo_id'=>'integer',
        'account_tem'=>'float',
        'card_name' => 'string',
        'starthu' => 'string',
        'user_name' => 'string',
        'user_mobile' => 'string',
        'card_no' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function bankinfo(){
        return $this->belongsTo('App\Models\bankinfo');
    }

    //格式化金额，保留两位小数
    public function getformatpriceAttribute(){
        $price=number_format($this->price, 2);
        return $price;
    }
    //格式化日期
    public function getformatdateAttribute(){
        $time=strtotime($this->created_at);
        return date("Y-m-d",$time);
    }


    
}
