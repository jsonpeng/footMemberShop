<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

/**
 * Class Tuaninfo
 * @package App\Models
 * @version October 19, 2017, 2:34 pm CST
 *
 * @property integer tuan_id
 * @property integer product_id
 * @property integer user_id
 * @property string status
 * @property string name
 */
class Tuaninfo extends Model
{
    use SoftDeletes;

    public $table = 'tuaninfos';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'products_id',
        'status',
        'name',
        'num',
        'man_num',
        'end_time',
        'winner',
        'whether_fanxian',
        'guoqi',
        'no'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'products_id' => 'integer',
        'status' => 'string',
        'name' => 'string',
        'num'=>'integer',
        'man_num'=>'integer',
        'end_time'=>'string',
        'winner'=>'string',
        'whether_fanxian'=>'string',
        'guoqi'=>'string',
        'no'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'tuaninfo_user', 'tuaninfo_id', 'user_id');
    }

    public function products(){
        return $this->belongsTo('App\Models\products');
    }


    public function getproductsAttribute()
    {
        $products=products::where('id',$this->products_id)->first();
        if(!empty($products)){
            return  $products;
        }
    }

    //团长
    public function gettuanzhangAttribute(){
        $tuanzhang=$this->users()->first();
        if(!empty($tuanzhang)){
            return $tuanzhang;
        }
    }

    //拼团还差多少人
    public function getchanumAttribute(){
        $allnum=$this->man_num;
        return $allnum-$this->num;
    }


    //该团总金额
    public function  getzongjiaAttribute(){
        if(!empty(products::find($this->product_id))){
        return products::where('id',$this->products_id)->first()->price*$this->num;
        }else{
            return 0;
        }
    }

    //格式化开始时间
    public function getformatcreatedAttribute(){
        $time=strtotime($this->created_at);
        return date("Y-m-d",$time);
    }

    //格式化结束时间
    public function getformatendtimeAttribute(){
        $time=strtotime($this->end_time);
        return date("Y-m-d",$time);
    }

    //当前团是否过期
    public function getwhetherguoqiAttribute(){
        $now=strtotime(Carbon::now());
        $end_time=strtotime($this->end_time);
        if($now> $end_time){
            return '已过期';
        }else {
            return '我也要参团';
        }
    }

}
