<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ubicacion
 * @package App\Models
 * @version May 21, 2019, 4:25 am UTC
 *
 * @property string codigo
 * @property string descripcion
 */
class Ubicacion extends Model
{
    use SoftDeletes;

    public $table = 'ubicacions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
