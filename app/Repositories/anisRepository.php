<?php

namespace App\Repositories;

use App\Models\anis;
use App\Repositories\BaseRepository;

/**
 * Class anisRepository
 * @package App\Repositories
 * @version October 5, 2021, 3:11 am UTC
*/

class anisRepository extends BaseRepository
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
        return anis::class;
    }
}
