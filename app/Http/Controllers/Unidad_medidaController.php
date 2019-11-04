<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUnidad_medidaRequest;
use App\Http\Requests\UpdateUnidad_medidaRequest;
use App\Repositories\Unidad_medidaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use App\Helpers\publicFunction;
class Unidad_medidaController extends AppBaseController
{
    /** @var  Unidad_medidaRepository */
    private $unidadMedidaRepository;

    public function __construct(Unidad_medidaRepository $unidadMedidaRepo)
    {
        $this->unidadMedidaRepository = $unidadMedidaRepo;
       $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Unidad_medida.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $unidadMedidas = $this->unidadMedidaRepository->all();

        return view('admin.unidad_medidas.index')
            ->with('unidadMedidas', $unidadMedidas);
    }

    /**
     * Show the form for creating a new Unidad_medida.
     *
     * @return Response
     */
    public function create()
    {
        $maxMedida=publicFunction::maxCodigo('unidad_medidas');
       
        $opcion=0;
        
        return view('admin.unidad_medidas.create',['maxCodigo'=>$maxMedida,'opcion'=>$opcion]);
    }

    /**
     * Store a newly created Unidad_medida in storage.
     *
     * @param CreateUnidad_medidaRequest $request
     *
     * @return Response
     */
    public function store(CreateUnidad_medidaRequest $request)
    {
        $input = $request->all();

        $unidadMedida = $this->unidadMedidaRepository->create($input);

        Flash::success('Se guardó la unidad de medida.');

        return redirect(route('unidadMedidas.index'));
    }

    /**
     * Display the specified Unidad_medida.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unidadMedida = $this->unidadMedidaRepository->find($id);

        if (empty($unidadMedida)) {
            Flash::error('Unidad Medida not found');

            return redirect(route('unidadMedidas.index'));
        }

        return view('admin.unidad_medidas.show')->with('unidadMedida', $unidadMedida);
    }

    /**
     * Show the form for editing the specified Unidad_medida.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unidadMedida = $this->unidadMedidaRepository->find($id);

        if (empty($unidadMedida)) {
            Flash::error('Unidad Medida not found');

            return redirect(route('unidadMedidas.index'));
        }

        $opcion=1;
        
        return view('admin.unidad_medidas.edit',['unidadMedida'=>$unidadMedida,'opcion'=>$opcion]);
    }

    /**
     * Update the specified Unidad_medida in storage.
     *
     * @param int $id
     * @param UpdateUnidad_medidaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUnidad_medidaRequest $request)
    {
        $unidadMedida = $this->unidadMedidaRepository->find($id);

        if (empty($unidadMedida)) {
            Flash::error('Unidad Medida not found');

            return redirect(route('unidadMedidas.index'));
        }

        $unidadMedida = $this->unidadMedidaRepository->update($request->all(), $id);

        Flash::success('Se actualizó la unidad de medida.');

        return redirect(route('unidadMedidas.index'));
    }

    /**
     * Remove the specified Unidad_medida from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unidadMedida = $this->unidadMedidaRepository->find($id);

        if (empty($unidadMedida)) {
            Flash::error('Unidad Medida no encontrada');

            return redirect(route('unidadMedidas.index'));
        }

        DB::table('unidad_medidas')->where('id', '=', $id)->delete();

        Flash::success('Se eliminó la unidad de medida.');

        return redirect(route('unidadMedidas.index'));
    }
    
    public function unidad_listar()
    {
         $unidad = db::table('unidad_medidas')
           ->select('unidad_medidas.id','unidad_medidas.description','unidad_medidas.codigo')
           ->get();
        return datatables()->of($unidad)
            ->make(true);
    }
}
