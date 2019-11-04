<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Ponente
 * @package App\Models
 * @version May 20, 2019, 4:54 pm UTC
 *
 * @property string name
 * @property sttring apellido
 */
class Ponente extends Model
{

    public $table = 'ponentes';
    


    public $fillable = [
        'name',
        'apellido'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
