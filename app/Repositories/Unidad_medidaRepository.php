<?php

namespace App\Repositories;

use App\Models\Unidad_medida;
use App\Repositories\BaseRepository;

/**
 * Class Unidad_medidaRepository
 * @package App\Repositories
 * @version May 21, 2019, 4:32 am UTC
*/

class Unidad_medidaRepository extends BaseRepository
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
        return Unidad_medida::class;
    }
}
