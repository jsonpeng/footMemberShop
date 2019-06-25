<?php

namespace App\Repositories;

use App\Models\Tuaninfo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TuaninfoRepository
 * @package App\Repositories
 * @version October 19, 2017, 2:34 pm CST
 *
 * @method Tuaninfo findWithoutFail($id, $columns = ['*'])
 * @method Tuaninfo find($id, $columns = ['*'])
 * @method Tuaninfo first($columns = ['*'])
*/
class TuaninfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'products_id',
        'user_id',
        'status',
        'name',
        'end_time',
        'winner',
        'whether_fanxian',
        'guoqi',
        'man_num',
        'num',
        'no'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tuaninfo::class;
    }
}
