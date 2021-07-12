<?php

namespace App\Repositories;

use App\Models\ProductStore;
use App\Repositories\BaseRepository;

/**
 * Class ProductStoreRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:07 am UTC
*/

class ProductStoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'store_id',
        'price',
        'currency',
        'deliveryPrice',
        'discount'
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
        return ProductStore::class;
    }
}
