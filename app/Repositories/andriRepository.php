<?php

namespace App\Repositories;

use App\Models\andri;
use App\Repositories\BaseRepository;

/**
 * Class andriRepository
 * @package App\Repositories
 * @version October 5, 2021, 3:16 am UTC
*/

class andriRepository extends BaseRepository
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
        return andri::class;
    }
}
