<?php

namespace App\Repositories;

use App\Models\tuansetting;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class tuansettingRepository
 * @package App\Repositories
 * @version October 23, 2017, 11:43 am CST
 *
 * @method tuansetting findWithoutFail($id, $columns = ['*'])
 * @method tuansetting find($id, $columns = ['*'])
 * @method tuansetting first($columns = ['*'])
*/
class tuansettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tuan_num',
        'man_num'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return tuansetting::class;
    }
}
