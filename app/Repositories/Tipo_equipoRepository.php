<?php

namespace App\Repositories;

use App\Models\Tipo_equipo;
use App\Repositories\BaseRepository;

/**
 * Class Tipo_equipoRepository
 * @package App\Repositories
 * @version May 21, 2019, 4:12 am UTC
*/

class Tipo_equipoRepository extends BaseRepository
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
        return Tipo_equipo::class;
    }
}
