<?php

namespace App\Repositories;

use App\Models\nuevo;
use App\Repositories\BaseRepository;

/**
 * Class nuevoRepository
 * @package App\Repositories
 * @version May 20, 2019, 5:09 pm UTC
*/

class nuevoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return nuevo::class;
    }
}
