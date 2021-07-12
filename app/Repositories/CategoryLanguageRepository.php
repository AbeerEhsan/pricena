<?php

namespace App\Repositories;

use App\Models\CategoryLanguage;
use App\Repositories\BaseRepository;

/**
 * Class CategoryLanguageRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:03 am UTC
*/

class CategoryLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'category_id',
        'name',
        'lang_id',
        'description'
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
        return CategoryLanguage::class;
    }
}
