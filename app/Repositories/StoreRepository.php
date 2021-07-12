<?php

namespace App\Repositories;

use App\Models\Store;
use App\Repositories\BaseRepository;

/**
 * Class StoreRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:02 am UTC
*/

class StoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'img',
        'link',
        'city_id'
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
        return Store::class;
    }
}
