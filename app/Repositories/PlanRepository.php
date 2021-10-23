<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Repositories\BaseRepository;

/**
 * Class PlanRepository
 * @package App\Repositories
 * @version October 22, 2021, 6:27 pm UTC
*/

class PlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'max_sender',
        'max_contact',
        'max_media_size',
        'price',
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
        return Plan::class;
    }
}
