<?php

namespace App\Repositories;

use App\Models\StoreLang;
use App\Repositories\BaseRepository;

/**
 * Class StoreLangRepository
 * @package App\Repositories
 * @version February 26, 2020, 11:02 am UTC
*/

class StoreLangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'store_id',
        'lang_id',
        'name',
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
        return StoreLang::class;
    }
}
