<?php

namespace App\Repositories;

use App\Models\ProductGallery;
use App\Repositories\BaseRepository;

/**
 * Class ProductGalleryRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:07 am UTC
*/

class ProductGalleryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'video',
        'img'
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
        return ProductGallery::class;
    }
}
