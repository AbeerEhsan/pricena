<?php

namespace App\Repositories;

use App\Models\QuestionRate;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRateRepository
 * @package App\Repositories
 * @version March 19, 2020, 1:49 am UTC
*/

class QuestionRateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order'
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
        return QuestionRate::class;
    }
}
