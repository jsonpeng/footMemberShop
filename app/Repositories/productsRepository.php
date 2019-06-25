<?php

namespace App\Repositories;

use App\Models\products;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class productsRepository
 * @package App\Repositories
 * @version October 17, 2017, 4:20 pm CST
 *
 * @method products findWithoutFail($id, $columns = ['*'])
 * @method products find($id, $columns = ['*'])
 * @method products first($columns = ['*'])
*/
class productsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'banner',
        'price',
        'img_content',
        'start_time',
        'end_time',
        'status',
        'tuan_num',
        'man_num',
        'deleted',
        'o_price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return products::class;
    }
}
