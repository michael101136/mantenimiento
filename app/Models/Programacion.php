<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Programacion
 * @package App\Models
 * @version June 18, 2019, 4:39 pm -05
 *
 * @property string id_orden
 * @property string id_medidor
 * @property string id_tipo_programacion
 * @property string codigo
 * @property string descripcion
 * @property string estado
 * @property string fechainicio
 * @property string fechafin
 * @property string frecuencia
 * @property string lectura
 * @property string ultimavez
 * @property string fechaprogramacion
 * @property string tiempoestimado
 * @property string diaestimado
 */
class Programacion extends Model
{
    use SoftDeletes;

    public $table = 'programacions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_orden',
        'id_medidor',
        'id_tipo_programacion',
        'codigo',
        'descripcion',
        'estado',
        'fechainicio',
        'fechafin',
        'frecuencia',
        'lectura',
        'ultimavez',
        'fechaprogramacion',
        'tiempoestimado',
        'diaestimado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_orden' => 'string',
        'id_medidor' => 'string',
        'id_tipo_programacion' => 'string',
        'codigo' => 'string',
        'descripcion' => 'string',
        'estado' => 'string',
        'fechainicio' => 'string',
        'fechafin' => 'string',
        'frecuencia' => 'string',
        'lectura' => 'string',
        'ultimavez' => 'string',
        'fechaprogramacion' => 'string',
        'tiempoestimado' => 'string',
        'diaestimado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_orden' => 'required',
        'id_medidor' => 'required',
        'id_tipo_programacion' => 'required',
        'codigo' => 'required',
        'descripcion' => 'required'
    ];

    
}
