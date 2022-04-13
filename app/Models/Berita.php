<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Berita",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="judul",
 *          description="judul",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="konten",
 *          description="konten",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="penults",
 *          description="penults",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tanggal_terbit",
 *          description="tanggal_terbit",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Berita extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'beritas';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'judul',
        'konten',
        'penults',
        'tanggal_terbit'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'judul' => 'string',
        'penults' => 'string',
        'tanggal_terbit' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
