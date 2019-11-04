<?php

namespace App\Repositories;

use App\Models\Tipo_programacion;
use App\Repositories\BaseRepository;

/**
 * Class Tipo_programacionRepository
 * @package App\Repositories
 * @version June 18, 2019, 3:58 pm -05
*/

class Tipo_programacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'descripcion'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tipo_programacion::class;
    }
}
