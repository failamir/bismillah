<?php

namespace App\Repositories;

use App\Models\Laila;
use App\Repositories\BaseRepository;

/**
 * Class LailaRepository
 * @package App\Repositories
 * @version October 4, 2021, 2:44 pm UTC
*/

class LailaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Laila::class;
    }
}
