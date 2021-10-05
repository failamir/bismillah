<?php

namespace App\Repositories;

use App\Models\Isnacategory;
use App\Repositories\BaseRepository;

/**
 * Class IsnacategoryRepository
 * @package App\Repositories
 * @version October 4, 2021, 8:12 pm UTC
*/

class IsnacategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Isnacategory::class;
    }
}
