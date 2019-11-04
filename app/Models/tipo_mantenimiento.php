<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tipo_mantenimiento
 * @package App\Models
 * @version May 21, 2019, 2:04 am UTC
 *
 * @property string codigo
 * @property string descripcion
 * @property string siglas
 */
class tipo_mantenimiento extends Model
{
    use SoftDeletes;

    public $table = 'tipo_mantenimientos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'codigo',
        'descripcion',
        'siglas'
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
        'siglas' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
