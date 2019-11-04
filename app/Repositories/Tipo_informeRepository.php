<?php

namespace App\Repositories;

use App\Models\Tipo_informe;
use App\Repositories\BaseRepository;

/**
 * Class Tipo_informeRepository
 * @package App\Repositories
 * @version May 21, 2019, 4:43 am UTC
*/

class Tipo_informeRepository extends BaseRepository
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
        return Tipo_informe::class;
    }
}
