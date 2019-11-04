<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tipo_programacion
 * @package App\Models
 * @version June 18, 2019, 3:58 pm -05
 *
 * @property string codigo
 * @property string descripcion
 */
class Tipo_programacion extends Model
{
    use SoftDeletes;

    public $table = 'tipo_programacions';
    

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
        'codigo' => 'required',
        'descripcion' => 'required'
    ];

    
}
