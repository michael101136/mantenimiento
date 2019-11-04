<?php

namespace App\Repositories;

use App\Models\Tipo;
use App\Repositories\BaseRepository;

/**
 * Class TipoRepository
 * @package App\Repositories
 * @version May 28, 2019, 7:42 am -05
*/

class TipoRepository extends BaseRepository
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
        return Tipo::class;
    }
}
