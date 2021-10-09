<?php

namespace App\Repositories;

use App\Models\Pembiayaan;
use App\Repositories\BaseRepository;

/**
 * Class PembiayaanRepository
 * @package App\Repositories
 * @version October 4, 2021, 10:54 pm UTC
*/

class PembiayaanRepository extends BaseRepository
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
        return Pembiayaan::class;
    }
}
