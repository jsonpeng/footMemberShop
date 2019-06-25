<?php

namespace App\Repositories;

use App\Models\cats;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class catsRepository
 * @package App\Repositories
 * @version October 17, 2017, 3:58 pm CST
 *
 * @method cats findWithoutFail($id, $columns = ['*'])
 * @method cats find($id, $columns = ['*'])
 * @method cats first($columns = ['*'])
*/
class catsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return cats::class;
    }
}
