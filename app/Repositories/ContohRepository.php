<?php

namespace App\Repositories;

use App\Models\Contoh;
use App\Repositories\BaseRepository;

/**
 * Class ContohRepository
 * @package App\Repositories
 * @version October 22, 2021, 7:19 pm UTC
*/

class ContohRepository extends BaseRepository
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
        return Contoh::class;
    }
}
