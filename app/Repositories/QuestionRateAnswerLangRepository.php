<?php

namespace App\Repositories;

use App\Models\QuestionRateAnswerLang;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRateAnswerLangRepository
 * @package App\Repositories
 * @version March 19, 2020, 1:35 am UTC
*/

class QuestionRateAnswerLangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'answer_id',
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
        return QuestionRateAnswerLang::class;
    }
}
