<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 * @package App\Models
 * @version October 7, 2017, 2:16 am UTC
 *
 * @property string card_intro
 * @property float card_num
 * @property string card_pic
 * @property integer card_limit
 */
class Setting extends Model
{
    use SoftDeletes;

    public $table = 'settings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        /*
        'card_intro',
        'card_num',
        'card_pic',
        'card_limit',
        */
        'tongji_limit',
        'serias_limit',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        /*
        'card_intro' => 'string',
        'card_num' => 'float',
        'card_pic' => 'string',
        'card_limit' => 'integer'
        */
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        /*
        'card_intro' => 'required',
        'card_num' => 'required',
        'card_limit' => 'required'
        */
    ];

    
}
