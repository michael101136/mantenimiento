<?php

namespace App\Repositories;

use App\Models\TipoIncidencia;
use App\Repositories\BaseRepository;

/**
 * Class TipoIncidenciaRepository
 * @package App\Repositories
 * @version May 28, 2019, 12:20 pm -05
*/

class TipoIncidenciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'description'
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
        return TipoIncidencia::class;
    }
}
