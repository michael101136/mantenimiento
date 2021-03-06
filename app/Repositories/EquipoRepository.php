<?php

namespace App\Repositories;

use App\Models\Equipo;
use App\Repositories\BaseRepository;

/**
 * Class EquipoRepository
 * @package App\Repositories
 * @version May 21, 2019, 3:27 am UTC
*/

class EquipoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'codigo'
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
        return Equipo::class;
    }
}
