<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createtipo_mantenimientoRequest;
use App\Http\Requests\Updatetipo_mantenimientoRequest;
use App\Repositories\tipo_mantenimientoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use App\Helpers\publicFunction;
class tipo_mantenimientoController extends AppBaseController
{
    /** @var  tipo_mantenimientoRepository */
    private $tipoMantenimientoRepository;

    public function __construct(tipo_mantenimientoRepository $tipoMantenimientoRepo)
    {
        $this->tipoMantenimientoRepository = $tipoMantenimientoRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the tipo_mantenimiento.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoMantenimientos = $this->tipoMantenimientoRepository->all();

        return view('admin.tipo_mantenimientos.index')
            ->with('tipoMantenimientos', $tipoMantenimientos);
    }

    /**
     * Show the form for creating a new tipo_mantenimiento.
     *
     * @return Response
     */
    public function create()
    {
        
        $codigo=publicFunction::maxCodigo('tipo_mantenimientos');
       
        $opcion=0;
        
        return view('admin.tipo_mantenimientos.create',['codigo'=>$codigo,'opcion'=> $opcion]);
    }

    /**
     * Store a newly created tipo_mantenimiento in storage.
     *
     * @param Createtipo_mantenimientoRequest $request
     *
     * @return Response
     */
    public function store(Createtipo_mantenimientoRequest $request)
    {
        $input = $request->all();

        $tipoMantenimiento = $this->tipoMantenimientoRepository->create($input);

        Flash::success('El tipo de mantenimiento se guardo correctamente .');

        return redirect(route('tipoMantenimientos.index'));
    }

    /**
     * Display the specified tipo_mantenimiento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoMantenimiento = $this->tipoMantenimientoRepository->find($id);

        if (empty($tipoMantenimiento)) {
            Flash::error('Tipo Mantenimiento not found');

            return redirect(route('tipoMantenimientos.index'));
        }

        return view('admin.tipo_mantenimientos.show')->with('tipoMantenimiento', $tipoMantenimiento);
    }

    /**
     * Show the form for editing the specified tipo_mantenimiento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoMantenimiento = $this->tipoMantenimientoRepository->find($id);

        if (empty($tipoMantenimiento)) {
            Flash::error('Tipo Mantenimiento not found');

            return redirect(route('tipoMantenimientos.index'));
        }
        $opcion=1;
        return view('admin.tipo_mantenimientos.edit',['tipoMantenimiento'=>$tipoMantenimiento,'opcion'=>$opcion]);
    }

    /**
     * Update the specified tipo_mantenimiento in storage.
     *
     * @param int $id
     * @param Updatetipo_mantenimientoRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetipo_mantenimientoRequest $request)
    {
        $tipoMantenimiento = $this->tipoMantenimientoRepository->find($id);

        if (empty($tipoMantenimiento)) {
            Flash::error('Tipo Mantenimiento not found');

            return redirect(route('tipoMantenimientos.index'));
        }

        $tipoMantenimiento = $this->tipoMantenimientoRepository->update($request->all(), $id);

        Flash::success('El tipo de mantenimiento se actualizó correctamente.');

        return redirect(route('tipoMantenimientos.index'));
    }

    /**
     * Remove the specified tipo_mantenimiento from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoMantenimiento = $this->tipoMantenimientoRepository->find($id);

        if (empty($tipoMantenimiento)) {
            Flash::error('Tipo Mantenimiento not found');

            return redirect(route('tipoMantenimientos.index'));
        }
        
        DB::table('tipo_mantenimientos')->where('id', '=',$id)->delete();
        Flash::success('SE ELIMINO EL TIPO DE MANTENIMIENTO.');
        return redirect(route('tipoMantenimientos.index'));
    }
}
