<?php

namespace App\Repositories;

use App\Models\Adv;
use App\Repositories\BaseRepository;

/**
 * Class AdvRepository
 * @package App\Repositories
 * @version April 25, 2020, 8:21 am UTC
*/

class AdvRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'media_link',
        'type',
        'description',
        'link',
        'is_active'
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
        return Adv::class;
    }
}
