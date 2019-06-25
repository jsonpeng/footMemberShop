<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class bankinfo
 * @package App\Models
 * @version October 24, 2017, 11:08 am CST
 *
 * @property integer user_id
 * @property string card_name
 * @property string starthu
 * @property string user_name
 * @property string user_mobile
 * @property string card_no
 */
class bankinfo extends Model
{
    use SoftDeletes;

    public $table = 'bankinfos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'card_name',
        'starthu',
        'user_name',
        'user_mobile',
        'card_no',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'card_name' => 'string',
        'starthu' => 'string',
        'user_name' => 'string',
        'user_mobile' => 'string',
        'card_no' => 'string',
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

    public function account_user(){
        return $this->hasMany('App\Models\account_user');
    }

    public function getsubcardnoAttribute (){
        return substr($this->card_no,-4);
}
    
}
