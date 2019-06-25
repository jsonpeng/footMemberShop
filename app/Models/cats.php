<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class cats
 * @package App\Models
 * @version October 17, 2017, 3:58 pm CST
 *
 * @property string name
 */
class cats extends Model
{
    use SoftDeletes;

    public $table = 'cats';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'image',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'image'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string'
    ];


    /*
    * 对应商品
    */
    public function products(){
        return $this->belongsToMany('App\Models\products','cat_product','cat_id','product_id');
    }

    
}
