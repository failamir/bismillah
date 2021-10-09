<?php

namespace App\Repositories;

use App\Models\zulan;
use App\Repositories\BaseRepository;

/**
 * Class zulanRepository
 * @package App\Repositories
 * @version October 4, 2021, 10:57 pm UTC
*/

class zulanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'photo'
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
        return zulan::class;
    }
}
