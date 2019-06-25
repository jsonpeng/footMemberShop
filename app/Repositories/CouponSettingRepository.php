<?php

namespace App\Repositories;

use App\Models\CouponSetting;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CouponSettingRepository
 * @package App\Repositories
 * @version October 23, 2017, 6:00 pm CST
 *
 * @method CouponSetting findWithoutFail($id, $columns = ['*'])
 * @method CouponSetting find($id, $columns = ['*'])
 * @method CouponSetting first($columns = ['*'])
*/
class CouponSettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'coupon_id',
        'number'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CouponSetting::class;
    }
}
