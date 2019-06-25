<?php

namespace App\Repositories;

use App\Models\MemberCard;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MemberCardRepository
 * @package App\Repositories
 * @version October 7, 2017, 2:13 am UTC
 *
 * @method MemberCard findWithoutFail($id, $columns = ['*'])
 * @method MemberCard find($id, $columns = ['*'])
 * @method MemberCard first($columns = ['*'])
*/
class MemberCardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'shop_id',
        'start',
        'end',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MemberCard::class;
    }
}
