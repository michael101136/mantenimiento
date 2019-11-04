<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Logi_Proveedores
 * @package App\Models
 * @version May 27, 2019, 10:35 pm -05
 *
 * @property string razonsoc
 * @property string ruc
 * @property string user_create
 * @property string web
 * @property string estado
 */
class Logi_Proveedores extends Model
{
    use SoftDeletes;

    public $table = 'logi__proveedores';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'razonsoc',
        'ruc',
        'user_create',
        'web',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'razonsoc' => 'string',
        'ruc' => 'string',
        'user_create' => 'string',
        'web' => 'string',
        'estado' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'razonsoc' => 'required',
        'ruc' => 'numeric',
        'web' => 'required'
    ];

    
}
