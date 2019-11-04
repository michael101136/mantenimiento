<?php

namespace App\Repositories;

use App\Models\Marca;
use App\Repositories\BaseRepository;

/**
 * Class MarcaRepository
 * @package App\Repositories
 * @version May 21, 2019, 4:12 am UTC
*/

class MarcaRepository extends BaseRepository
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
        return Marca::class;
    }
}
