<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Frecuencia
 * @package App\Models
 * @version May 28, 2019, 7:27 am -05
 *
 * @property string descripcion
 * @property string dias
 */
class Frecuencia extends Model
{
    use SoftDeletes;

    public $table = 'frecuencias';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'descripcion',
        'dias'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
        'dias' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required',
        'dias' => 'numeric'
    ];

    
}
