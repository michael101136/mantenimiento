<?php

namespace App\Repositories;

use App\Models\Medidor;
use App\Repositories\BaseRepository;

/**
 * Class MedidorRepository
 * @package App\Repositories
 * @version May 28, 2019, 4:57 pm -05
*/

class MedidorRepository extends BaseRepository
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
        return Medidor::class;
    }
}
