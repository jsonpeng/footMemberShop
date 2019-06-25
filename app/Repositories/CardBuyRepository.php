<?php

namespace App\Repositories;

use App\Models\CardBuy;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CardBuyRepository
 * @package App\Repositories
 * @version October 7, 2017, 9:00 am UTC
 *
 * @method CardBuy findWithoutFail($id, $columns = ['*'])
 * @method CardBuy find($id, $columns = ['*'])
 * @method CardBuy first($columns = ['*'])
*/
class CardBuyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_num',
        'price',
        'status',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CardBuy::class;
    }
}
