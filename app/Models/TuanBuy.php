<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TuanBuy extends Model
{
    use SoftDeletes;

    public $table = 'tuan_buys';
    protected $dates = ['deleted_at'];
    public $fillable = [
        'order_num',
        'price',
        'status',
        'user_id',
        'product_id',
        'name',
        'product_name',
        'type'
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
        'user_id' => 'integer',
        'product_id'=>'integer',
        'name'=>'string',
        'product_name'=>'string',
        'type'=>'string'
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

    // 所属团
    public function tuan(){
        return $this->belongsTo('App\Models\Tuaninfo');
    }

    public function getProductsAttribute(){
        $products= products::where('id',$this->product_id)->first();
        if(!empty($products)){
            return $products;
        }
        return '--';
    }

}
