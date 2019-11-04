<?php

namespace App\Repositories;

use App\Models\Tienda;
use App\Repositories\BaseRepository;

/**
 * Class TiendaRepository
 * @package App\Repositories
 * @version June 4, 2019, 11:36 am -05
*/

class TiendaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
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
        return Tienda::class;
    }
}
