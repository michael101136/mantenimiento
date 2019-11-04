<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Repositories\MarcaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Datatables;
use App\Helpers\publicFunction;
class MarcaController extends AppBaseController
{
    /** @var  MarcaRepository */
    private $marcaRepository;

    public function __construct(MarcaRepository $marcaRepo)
    {
        $this->marcaRepository = $marcaRepo;
        $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Marca.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $marcas = $this->marcaRepository->all();
        
        $marcas = DB::table('marcas')
        ->select('marcas.id','marcas.codigo','marcas.descripcion','tipo_equipos.descripcion as tipoequipo')
        ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
        ->where('marcas.deleted_at','=',null)
        ->get();

        return view('admin.marcas.index')
            ->with('marcas', $marcas);
    }

    /**
     * Show the form for creating a new Marca.
     *
     * @return Response
     */

    public function listarMarcas($id)
    {
       
       
       
        $listar=DB::table('marcas')
                    ->select('*')
                    ->where('id_tipo_equipo',$id)
                    ->get();

        return datatables()->of($listar)
            ->make(true);
        
    }

    public function create()
    {
        $maxCodigo=publicFunction::maxCodigo('marcas');       
        $opcion=0;
        return view('admin.marcas.create',['maxCodigo'=>$maxCodigo,'opcion'=>$opcion]);
    }

    /**
     * Store a newly created Marca in storage.
     *
     * @param CreateMarcaRequest $request
     *
     * @return Response
     */
    public function store(CreateMarcaRequest $request)
    {
        $input = $request->all();

        $marca = $this->marcaRepository->create($input);

        Flash::success('Se guardo correctamente la marca.');

        return redirect(route('marcas.index'));
    }

    /**
     * Display the specified Marca.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $marca = $this->marcaRepository->find($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

        return view('admin.marcas.show')->with('marca', $marca);
    }

    /**
     * Show the form for editing the specified Marca.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $marca = $this->marcaRepository->find($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

        $opcion=1;

        return view('admin.marcas.edit',['marca'=>$marca,'opcion'=>$opcion]);
    }

    /**
     * Update the specified Marca in storage.
     *
     * @param int $id
     * @param UpdateMarcaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMarcaRequest $request)
    {
        $marca = $this->marcaRepository->find($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

        $marca = $this->marcaRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente la marca');

        return redirect(route('marcas.index'));
    }

    /**
     * Remove the specified Marca from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $marca = $this->marcaRepository->find($id);

        if (empty($marca)) {
            Flash::error('Marca not found');

            return redirect(route('marcas.index'));
        }

       DB::table('marcas')->where('id', $id)->delete();


        Flash::success('Se eliminó correctamente su marca .');

        return redirect(route('marcas.index'));
    }
    
    public function tipos_equipos_listar()
    {
         $tipoEquipo=DB::table('tipo_equipos')
         ->select('*')
         ->where('deleted_at','=',null)
         ->get();
       
        return datatables()->of($tipoEquipo)
            ->make(true); 
    }
}
