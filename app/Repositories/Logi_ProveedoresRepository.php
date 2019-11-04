<?php

namespace App\Repositories;

use App\Models\Logi_Proveedores;
use App\Repositories\BaseRepository;

/**
 * Class Logi_ProveedoresRepository
 * @package App\Repositories
 * @version May 27, 2019, 10:35 pm -05
*/

class Logi_ProveedoresRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'razonsoc',
        'ruc',
        'user_create',
        'web',
        'estado'
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
        return Logi_Proveedores::class;
    }
}
