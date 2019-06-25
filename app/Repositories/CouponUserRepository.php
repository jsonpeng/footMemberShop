<?php

namespace App\Repositories;

use App\Models\CouponUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CouponUserRepository
 * @package App\Repositories
 * @version October 23, 2017, 5:05 pm CST
 *
 * @method CouponUser findWithoutFail($id, $columns = ['*'])
 * @method CouponUser find($id, $columns = ['*'])
 * @method CouponUser first($columns = ['*'])
*/
class CouponUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'time_begin',
        'time_end',
        'type',
        'base',
        'given',
        'discount',
        'together',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CouponUser::class;
    }
}
