<?php

namespace App\Repositories;

use App\Models\Shop;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ShopRepository
 * @package App\Repositories
 * @version October 7, 2017, 2:21 am UTC
 *
 * @method Shop findWithoutFail($id, $columns = ['*'])
 * @method Shop find($id, $columns = ['*'])
 * @method Shop first($columns = ['*'])
*/
class ShopRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'intro'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Shop::class;
    }
}
