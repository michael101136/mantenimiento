<?php

namespace App\Repositories;

use App\Models\Paises;
use App\Repositories\BaseRepository;

/**
 * Class PaisesRepository
 * @package App\Repositories
 * @version May 27, 2019, 11:02 pm -05
*/

class PaisesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
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
        return Paises::class;
    }
}
