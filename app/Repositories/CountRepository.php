<?php

namespace App\Repositories;

use App\Models\Count;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CountRepository
 * @package App\Repositories
 * @version October 12, 2017, 2:20 pm CST
 *
 * @method Count findWithoutFail($id, $columns = ['*'])
 * @method Count find($id, $columns = ['*'])
 * @method Count first($columns = ['*'])
*/
class CountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'info',
        'backup01',
        'backup02'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Count::class;
    }
}
