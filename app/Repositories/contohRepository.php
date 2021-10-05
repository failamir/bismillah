<?php

namespace App\Repositories;

use App\Models\contoh;
use App\Repositories\BaseRepository;

/**
 * Class contohRepository
 * @package App\Repositories
 * @version October 4, 2021, 2:24 pm UTC
*/

class contohRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category_id'
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
        return contoh::class;
    }
}
