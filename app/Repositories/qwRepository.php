<?php

namespace App\Repositories;

use App\Models\qw;
use App\Repositories\BaseRepository;

/**
 * Class qwRepository
 * @package App\Repositories
 * @version October 5, 2021, 4:28 am UTC
*/

class qwRepository extends BaseRepository
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
        return qw::class;
    }
}
