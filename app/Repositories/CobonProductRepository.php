<?php

namespace App\Repositories;

use App\Models\CobonProduct;
use App\Repositories\BaseRepository;

/**
 * Class CobonProductRepository
 * @package App\Repositories
 * @version March 23, 2020, 12:12 am UTC
*/

class CobonProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'cobon_id'
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
        return CobonProduct::class;
    }
}
