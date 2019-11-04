<?php

namespace App\Repositories;

use App\Models\Ubicacion;
use App\Repositories\BaseRepository;

/**
 * Class UbicacionRepository
 * @package App\Repositories
 * @version May 21, 2019, 4:25 am UTC
*/

class UbicacionRepository extends BaseRepository
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
        return Ubicacion::class;
    }
}
