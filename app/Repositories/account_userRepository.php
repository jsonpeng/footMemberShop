<?php

namespace App\Repositories;

use App\Models\account_user;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class account_userRepository
 * @package App\Repositories
 * @version October 23, 2017, 5:44 pm CST
 *
 * @method account_user findWithoutFail($id, $columns = ['*'])
 * @method account_user find($id, $columns = ['*'])
 * @method account_user first($columns = ['*'])
*/
class account_userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'no',
        'user_id',
        'type',
        'price',
        'status',
        'arrive_time',
        'bankinfo_id',
        'account_tem',
        'card_name',
        'starthu',
        'user_name',
        'user_mobile',
        'card_no'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return account_user::class;
    }
}
