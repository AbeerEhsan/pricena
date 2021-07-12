<?php

namespace App\Repositories;

use App\Models\SliderLang;
use App\Repositories\BaseRepository;

/**
 * Class SliderLangRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:11 am UTC
*/

class SliderLangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'slider_id',
        'lang_id'
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
        return SliderLang::class;
    }
}
