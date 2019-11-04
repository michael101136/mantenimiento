<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Unidad_medida
 * @package App\Models
 * @version May 21, 2019, 4:32 am UTC
 *
 * @property string codigo
 * @property string description
 */
class Unidad_medida extends Model
{
    use SoftDeletes;

    public $table = 'unidad_medidas';
    

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
        
    ];

    
}
