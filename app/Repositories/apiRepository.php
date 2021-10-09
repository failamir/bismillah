<?php

namespace App\Repositories;

use App\Models\api;
use App\Repositories\BaseRepository;

/**
 * Class apiRepository
 * @package App\Repositories
 * @version October 4, 2021, 4:18 pm UTC
*/

class apiRepository extends BaseRepository
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
        return api::class;
    }
}
