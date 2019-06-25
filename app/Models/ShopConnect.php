<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ShopConnect
 * @package App\Models
 * @version October 30, 2017, 3:52 pm CST
 *
 * @property string id
 * @property string name
 * @property integer shop_id
 */
class ShopConnect extends Model
{
    use SoftDeletes;

    public $table = 'shop_connects';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'shop_id',
        'name',
        'shop_connet_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'shop_id' => 'string',
        'name' => 'string',
        'shop_connet_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shop_id' => 'required',
        'name' => 'required'
    ];

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_connet_id');
    }
}
