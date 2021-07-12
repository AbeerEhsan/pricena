<?php

namespace App\Repositories;

use App\Models\QuestionRateLang;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRateLangRepository
 * @package App\Repositories
 * @version March 19, 2020, 1:34 am UTC
*/

class QuestionRateLangRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question',
        'question_id',
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
        return QuestionRateLang::class;
    }
}
