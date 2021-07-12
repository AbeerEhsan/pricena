<?php

namespace App\Repositories;

use App\Models\QuestionRates;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRatesRepository
 * @package App\Repositories
 * @version March 19, 2020, 1:34 am UTC
*/

class QuestionRatesRepository extends BaseRepository
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
        return QuestionRates::class;
    }
}
