<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Usuario
 * @package App\Models
 * @version May 20, 2019, 9:09 pm UTC
 *
 * @property string name
 * @property string email
 * @property string password
 * @property string language_id
 * @property string privilege
 * @property string status
 */
class Usuario extends Model
{
    use SoftDeletes;

    public $table = 'usuarios';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'password',
        'language_id',
        'privilege',
        'status',
        'id_empresa'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'language_id' => 'string',
        'privilege' => 'string',
        'status' => 'string',
        'id_empresa' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'text',
        'email' => 'email',
        'password' => 'text',
        'language_id' => 'int'
    ];


}
