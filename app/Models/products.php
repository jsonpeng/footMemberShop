<?php

namespace App\Models;

use Eloquent as Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class products
 * @package App\Models
 * @version October 17, 2017, 4:20 pm CST
 *
 * @property string name
 * @property string banner
 * @property float price
 * @property longText img_content
 * @property longText word_content
 * @property timestamp start_time
 * @property timestamp end_time
 * @property tinyInteger status
 * @property inventory integer
 * @property float freight
 */
class products extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'banner',
        'price',
        'img_content',
        'start_time',
        'end_time',
        'status',
        'tuan_num',
        'man_num',
        'deleted',
        'o_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'banner' => 'string',
        'price' => 'float',
        'o_price'=>'float',
        'img_content'=>'string',
        'start_time'=>'string',
        'end_time'=>'string',
        'status'=>'integer',
        'tuan_num'=>'integer',
        'man_num'=>'integer',
        'deleted'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'string|required',
        'banner' => 'string|required',
        'price' => 'string|required',
        'o_price'=>'string|required',
    ];

    /*
    * 商品分类
    */
    public function cats(){
        return $this->belongsToMany('App\Models\cats','cat_product','product_id','cat_id');
    }

    //多张封面图片
    public function image(){
        return $this->hasMany('App\Models\product_images');
    }

    public function tuan_buy(){
        return $this->hasMany('App\Models\TuanBuy');
    }

    //开团的信息
    public function tuaninfo(){
        return $this->hasMany('App\Models\Tuaninfo')->where('guoqi', '否');
    }

    //该商品参加拼团的用户
    public function join_user(){
        return $this->belongsToMany('App\User','product_user','product_id','user_id');
    }

    //当前商品拼团多少件
    public function getjoinnumAttribute(){
        return $this->tuaninfo()->sum('num');
    }

    //当前商品还差多少个团拼满
    public function getchatuannumAttribute(){
        $pinman = $this->tuaninfo()->whereRaw('num = man_num') ->count();
         if($this->tuan_num-$pinman<=0){
             return '已拼满';
         }else{
             return $this->tuan_num-$pinman;
         }
    }

    //已拼满多少件
        public function getpinmanAttribute(){
            $pinman = $this->tuaninfo()->whereRaw('num = man_num') ->count();
            return $pinman;
         }
    

  //商品中参加的团已经开奖过
    public function gethadwinedAttribute(){
        $winner=$this->tuaninfo()->where('winner','是')->count();
        if($winner>0){
            return '是';
        }else{
            return '否';
        }

    }

    //现在距离结束时间
    public function gettimewhetherdelayAttribute(){
        $now=strtotime(Carbon::now());
        $end_time=strtotime($this->end_time);
        //return 'now:'.$now.'end:'.$end_time;
        if($now> $end_time){
            return true;
        }else {
           return $this->timediff($now, $end_time);
        }
    }

    //计算时间差分时秒
    protected function  timediff($begin_time,$end_time){
    if($begin_time < $end_time){
    $starttime = $begin_time;
    $endtime = $end_time;
    }else{
        $starttime = $end_time;
        $endtime = $begin_time;
    }

    //计算天数
    $timediff = $endtime-$starttime;
    $days = intval($timediff/86400);
    //计算小时数
    $remain = $timediff%86400;
    $hours = intval($remain/3600);
    //计算分钟数
    $remain = $remain%3600;
    $mins = intval($remain/60);
    //计算秒数
    $secs = $remain%60;
    $res = $days.'天'.$hours.'小时'.$mins.'分钟'.$secs.'秒';
    return $res;
}

    //当前商品是否过期
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
