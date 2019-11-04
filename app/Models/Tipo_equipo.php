<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tipo_equipo
 * @package App\Models
 * @version May 21, 2019, 4:12 am UTC
 *
 * @property string codigo
 * @property string descripcion
 */
class Tipo_equipo extends Model
{
    use SoftDeletes;

    public $table = 'tipo_equipos';
    

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
