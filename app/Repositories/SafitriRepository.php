<?php

namespace App\Repositories;

use App\Models\Safitri;
use App\Repositories\BaseRepository;

/**
 * Class SafitriRepository
 * @package App\Repositories
 * @version October 9, 2021, 4:32 pm UTC
*/

class SafitriRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'file'
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
        return Safitri::class;
    }
}
