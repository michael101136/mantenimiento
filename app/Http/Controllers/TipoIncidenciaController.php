<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoIncidenciaRequest;
use App\Http\Requests\UpdateTipoIncidenciaRequest;
use App\Repositories\TipoIncidenciaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Helpers\publicFunction;
use DB;
class TipoIncidenciaController extends AppBaseController
{
    /** @var  TipoIncidenciaRepository */
    private $tipoIncidenciaRepository;

    public function __construct(TipoIncidenciaRepository $tipoIncidenciaRepo)
    {
        $this->tipoIncidenciaRepository = $tipoIncidenciaRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the TipoIncidencia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tipoIncidencias = $this->tipoIncidenciaRepository->all();

        return view('admin.tipo_incidencias.index')
            ->with('tipoIncidencias', $tipoIncidencias);
    }

    public function listarIncidencias(Request $request)
     {
        $listar = $this->tipoIncidenciaRepository->all();
        $opcon=1;
        return response(['data' => $listar,'opcionUrl'=>$opcon]);
     }
    /**
     * Show the form for creating a new TipoIncidencia.
     *
     * @return Response
     */
    public function create()
    {
        $max=publicFunction::maxCodigo('tipo_incidencias');
        $opcion=0;
        return view('admin.tipo_incidencias.create',['opcion'=>$opcion,'max'=>$max]);
    }

    /**
     * Store a newly created TipoIncidencia in storage.
     *
     * @param CreateTipoIncidenciaRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoIncidenciaRequest $request)
    {
        $input = $request->all();

        $tipoIncidencia = $this->tipoIncidenciaRepository->create($input);

        Flash::success('Se guardó correctamente el tipo de incidencia.');

        return redirect(route('tipoIncidencias.index'));
    }

    /**
     * Display the specified TipoIncidencia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoIncidencia = $this->tipoIncidenciaRepository->find($id);

        if (empty($tipoIncidencia)) {
            Flash::error('Tipo Incidencia not found');

            return redirect(route('tipoIncidencias.index'));
        }

        return view('admin.tipo_incidencias.show')->with('tipoIncidencia', $tipoIncidencia);
    }

    /**
     * Show the form for editing the specified TipoIncidencia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoIncidencia = $this->tipoIncidenciaRepository->find($id);

        if (empty($tipoIncidencia)) {
            Flash::error('Tipo Incidencia not found');

            return redirect(route('tipoIncidencias.index'));
        }
        $opcion=1;
        return view('admin.tipo_incidencias.edit')->with('tipoIncidencia', $tipoIncidencia)->with('opcion',$opcion);
    }

    /**
     * Update the specified TipoIncidencia in storage.
     *
     * @param int $id
     * @param UpdateTipoIncidenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoIncidenciaRequest $request)
    {
        $tipoIncidencia = $this->tipoIncidenciaRepository->find($id);

        if (empty($tipoIncidencia)) {
            Flash::error('Tipo Incidencia not found');

            return redirect(route('tipoIncidencias.index'));
        }

        $tipoIncidencia = $this->tipoIncidenciaRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente el tipo de incidencia.');

        return redirect(route('tipoIncidencias.index'));
    }

    /**
     * Remove the specified TipoIncidencia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoIncidencia = $this->tipoIncidenciaRepository->find($id);

        if (empty($tipoIncidencia)) {
            Flash::error('Tipo Incidencia not found');

            return redirect(route('tipoIncidencias.index'));
        }

        
        DB::table('tipo_incidencias')->where('id', '=', $id)->delete();
        Flash::success('Se eliminó correctamente el tipo de incidencia.');

        return redirect(route('tipoIncidencias.index'));
    }
}
