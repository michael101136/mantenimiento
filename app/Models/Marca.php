<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Marca
 * @package App\Models
 * @version May 21, 2019, 4:12 am UTC
 *
 * @property string codigo
 * @property string descripcion
 */
class Marca extends Model
{
    use SoftDeletes;

    public $table = 'marcas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'descripcion',
        'id_tipo_equipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'descripcion' => 'string',
           'id_tipo_equipo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
