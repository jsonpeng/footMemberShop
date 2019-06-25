<?php

namespace App\Repositories;

use App\Models\bankinfo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class bankinfoRepository
 * @package App\Repositories
 * @version October 24, 2017, 11:08 am CST
 *
 * @method bankinfo findWithoutFail($id, $columns = ['*'])
 * @method bankinfo find($id, $columns = ['*'])
 * @method bankinfo first($columns = ['*'])
*/
class bankinfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'card_name',
        'starthu',
        'user_name',
        'user_mobile',
        'card_no',
        'type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bankinfo::class;
    }
}
