<?php

namespace App\Repositories;

use App\Models\manager;
use App\Repositories\BaseRepository;

/**
 * Class managerRepository
 * @package App\Repositories
 * @version October 4, 2021, 4:12 pm UTC
*/

class managerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qwerty',
        'asdf',
        'laila_id'
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
        return manager::class;
    }
}
