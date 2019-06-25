<?php

namespace App\Repositories;

use App\Models\ShopConnect;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ShopConnectRepository
 * @package App\Repositories
 * @version October 30, 2017, 3:52 pm CST
 *
 * @method ShopConnect findWithoutFail($id, $columns = ['*'])
 * @method ShopConnect find($id, $columns = ['*'])
 * @method ShopConnect first($columns = ['*'])
*/
class ShopConnectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'shop_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ShopConnect::class;
    }
}
