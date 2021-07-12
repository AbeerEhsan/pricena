<?php

namespace App\Repositories;

use App\Models\TipAppSlider;
use App\Repositories\BaseRepository;

/**
 * Class TipAppSliderRepository
 * @package App\Repositories
 * @version March 19, 2020, 1:36 am UTC
*/

class TipAppSliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
        'image'
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
        return TipAppSlider::class;
    }
}
