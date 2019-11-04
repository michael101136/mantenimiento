<?php

namespace App\Repositories;

use App\Models\Frecuencia;
use App\Repositories\BaseRepository;

/**
 * Class FrecuenciaRepository
 * @package App\Repositories
 * @version May 28, 2019, 7:27 am -05
*/

class FrecuenciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'dias'
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
        return Frecuencia::class;
    }
}
