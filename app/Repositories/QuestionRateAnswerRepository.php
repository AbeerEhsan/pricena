<?php

namespace App\Repositories;

use App\Models\QuestionRateAnswer;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRateAnswerRepository
 * @package App\Repositories
 * @version March 19, 2020, 1:35 am UTC
*/

class QuestionRateAnswerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id'
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
        return QuestionRateAnswer::class;
    }
}
