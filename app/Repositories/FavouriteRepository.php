<?php

namespace App\Repositories;

use App\Models\Favourite;
use App\Repositories\BaseRepository;

/**
 * Class FavouriteRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:07 am UTC
*/

class FavouriteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'rating',
        'store_id',
        'product_id'
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
        return Favourite::class;
    }
}
