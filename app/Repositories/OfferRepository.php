<?php

namespace App\Repositories;

use App\Models\Offer;
use App\Repositories\BaseRepository;

/**
 * Class OfferRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:09 am UTC
*/

class OfferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'store_id',
        'link',
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
        return Offer::class;
    }
}
