<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdersRecharge extends Model
{
    use SoftDeletes;

    public $table = 'orders_recharge';
    protected $dates = ['deleted_at'];
    public $fillable = [
        'no',
        'price',
        'status',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'no'=>'string',
        'price' => 'float',
        'status'=>'string',
        'user_id'=>'integer'
    ];
}
