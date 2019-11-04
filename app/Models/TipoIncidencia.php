<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoIncidencia
 * @package App\Models
 * @version May 28, 2019, 12:20 pm -05
 *
 * @property string codigo
 * @property string description
 */
class TipoIncidencia extends Model
{
    use SoftDeletes;

    public $table = 'tipo_incidencias';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required',
        'description' => 'required'
    ];

    
}
