<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="manager",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="qwerty",
 *          description="qwerty",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="asdf",
 *          description="asdf",
 *          type="string",
 *          format="binary"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="laila_id",
 *          description="laila_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class manager extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'managers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'qwerty',
        'asdf',
        'laila_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qwerty' => 'string',
        'laila_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function laila()
    {
        return $this->hasOne(\App\Models\Laila::class, 'id', 'laila_id');
    }
}
