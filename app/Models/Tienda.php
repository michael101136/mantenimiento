<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tienda
 * @package App\Models
 * @version June 4, 2019, 11:36 am -05
 *
 * @property string codigo
 * @property string nombre
 */
class Tienda extends Model
{
    use SoftDeletes;

    public $table = 'tiendas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'direccion'=>'required',
        'id_empresa'=>'required',
        'id_ubigeo'=>'required',
    ];

    
}
