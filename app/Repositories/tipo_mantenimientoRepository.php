<?php

namespace App\Repositories;

use App\Models\tipo_mantenimiento;
use App\Repositories\BaseRepository;

/**
 * Class tipo_mantenimientoRepository
 * @package App\Repositories
 * @version May 21, 2019, 2:04 am UTC
*/

class tipo_mantenimientoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'descripcion',
        'siglas'
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
        return tipo_mantenimiento::class;
    }
}
