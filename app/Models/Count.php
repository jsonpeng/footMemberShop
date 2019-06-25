<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Count
 * @package App\Models
 * @version October 12, 2017, 2:20 pm CST
 *
 * @property integer user_id
 * @property string info
 * @property string backup01
 * @property string backup02
 */
class Count extends Model
{
    use SoftDeletes;

    public $table = 'counts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'info',
        'backup01',
        'backup02'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'info' => 'string',
        'backup01' => 'string',
        'backup02' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'info' => 'required'
    ];

    // 订单所属用户
    public function user(){
        return $this->belongsTo('App\User');
    }
}
