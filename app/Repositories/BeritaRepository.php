<?php

namespace App\Repositories;

use App\Models\Berita;
use App\Repositories\BaseRepository;

/**
 * Class BeritaRepository
 * @package App\Repositories
 * @version April 13, 2022, 4:13 pm UTC
*/

class BeritaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'judul',
        'konten',
        'penults',
        'tanggal_terbit'
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
        return Berita::class;
    }
}
