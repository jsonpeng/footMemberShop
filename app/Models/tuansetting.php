<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tuansetting
 * @package App\Models
 * @version October 23, 2017, 11:43 am CST
 *
 * @property integer tuan_num
 * @property integer man_num
 */
class tuansetting extends Model
{
    use SoftDeletes;

    public $table = 'tuansettings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tuan_num',
        'man_num'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tuan_num' => 'string',
        'man_num' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
