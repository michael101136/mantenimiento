<?php

namespace App\Repositories;

use App\Models\Ponente;
use App\Repositories\BaseRepository;

/**
 * Class PonenteRepository
 * @package App\Repositories
 * @version May 20, 2019, 4:54 pm UTC
*/

class PonenteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'apellido'
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
        return Ponente::class;
    }
}
