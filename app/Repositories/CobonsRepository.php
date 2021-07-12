<?php

namespace App\Repositories;

use App\Models\Cobons;
use App\Repositories\BaseRepository;

/**
 * Class CobonsRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:10 am UTC
*/

class CobonsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'maxUser',
        'product_id',
        'store_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cobons::class;
    }
}
