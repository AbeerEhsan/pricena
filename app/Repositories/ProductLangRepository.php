<?php

namespace App\Repositories;

use App\Models\ProductLang;
use App\Repositories\BaseRepository;

/**
 * Class ProductLangRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:06 am UTC
*/

class ProductLangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'lang_id',
        'name',
        'description',
        'details'
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
        return ProductLang::class;
    }
}
