<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Shop
 * @package App\Models
 * @version October 7, 2017, 2:21 am UTC
 *
 * @property string name
 * @property string intro
 */
class Shop extends Model
{
    use SoftDeletes;

    public $table = 'shops';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'intro',
        'shop_id',
        'card_price',
        'card_intro',
        'card_pic',
        'card_limit',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'intro' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    public function shopConncts()
    {
        return $this->hasMany('App\Models\ShopConnect', 'shop_connet_id');
    }
}
