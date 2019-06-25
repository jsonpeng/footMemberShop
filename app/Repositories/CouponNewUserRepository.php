<?php

namespace App\Repositories;

use App\Models\CouponNewUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CouponNewUserRepository
 * @package App\Repositories
 * @version October 23, 2017, 5:41 pm CST
 *
 * @method CouponNewUser findWithoutFail($id, $columns = ['*'])
 * @method CouponNewUser find($id, $columns = ['*'])
 * @method CouponNewUser first($columns = ['*'])
*/
class CouponNewUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'new_open'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CouponNewUser::class;
    }
}
