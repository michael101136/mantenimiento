<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Equipo
 * @package App\Models
 * @version May 21, 2019, 3:27 am UTC
 *
 * @property string nombre
 * @property string codigo
 */
class Equipo extends Model
{
    use SoftDeletes;

    public $table = 'equipo';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'descripcion',
        'id_marca',
        'id_pais',
        'peso',
        'modelo',
        'peso_envio',
        'estado_cliente',
        'umedpeso',
        'altura',
        'ancho',
        'largo',
        'funcion',
        'ImagenA',
        'Imagen',
        'umedimens',
        'cantidad',
        'potencia',
        'tipotenc',
        'user_crea',
        'estado_equipo',
        'id_empresa'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'id' => 'integer',
        // 'nombre' => 'string',
        // 'codigo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
