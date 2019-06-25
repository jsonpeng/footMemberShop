<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_images extends Model
{
    use SoftDeletes;

    public $table = 'product_images';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'url',
        'products_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'url'=>'string',
        'products_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    //
    public function product(){
        return $this->belongsTo('App\Modes\products');
    }


}
