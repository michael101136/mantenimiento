<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Repositories\EmpresaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Datatables;
use DB;

class EmpresaController extends AppBaseController
{
    /** @var  EmpresaRepository */
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepo)
    {
        $this->empresaRepository = $empresaRepo;
        $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Empresa.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
        
        $empresas = $this->empresaRepository->all();

        return view('admin.empresas.index')
            ->with('empresas', $empresas);
    }


    public function listar_Empresa($id_ubigeo)
    {
       
        $data=DB::table('empresas')
                     ->select('empresas.id','empresas.nombre')
                     ->join('ubigeo_empresa', 'empresas.id', '=', 'ubigeo_empresa.id_empresa')
                     ->where('ubigeo_empresa.id_ubigeo',$id_ubigeo)
                     ->get();
                     
        // $ubigeo=DB::table('ubigeos')
        //              ->select('*')
        //              ->join('ubigeo_empresa', 'ubigeos.id', '=', 'ubigeo_empresa.id_ubigeo')
        //              ->join('empresas', 'empresas.id', '=', 'ubigeo_empresa.id_ubigeo')
        //              ->where('ubigeo_empresa.id_empresa',$idEmpresa)
        //              ->get();
                     
        // $data = DB::table('empresas')
        //             ->where('id_ubigeo', '=', $id_ubigeo)
        //             ->get();

         
        return response()->json(['data'=>$data]);
        
    }
    
    public function listarEmpresas(Request $request)
    {
        $listar = $this->empresaRepository->all();

        $opcon=5;
        
        return response(['data' => $listar,'opcionUrl'=>$opcon]);
    }

    /**
     * Show the form for creating a new Empresa.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.empresas.create');
    }

    /**
     * Store a newly created Empresa in storage.
     *
     * @param CreateEmpresaRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpresaRequest $request)
    {
        
       
        $input = $request->all();
        $empresa = $this->empresaRepository->create($input);
       
        Flash::success('Se guardó correctamente la empresa.');

        return redirect(route('empresas.index'));
    }

    /**
     * Display the specified Empresa.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

        return view('admin.empresas.show')->with('empresa', $empresa);
    }

    /**
     * Show the form for editing the specified Empresa.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

        return view('admin.empresas.edit')->with('empresa', $empresa);
    }

    /**
     * Update the specified Empresa in storage.
     *
     * @param int $id
     * @param UpdateEmpresaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpresaRequest $request)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

        $empresa = $this->empresaRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente la empresa.');

        return redirect(route('empresas.index'));
    }

    /**
     * Remove the specified Empresa from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa not found');

            return redirect(route('empresas.index'));
        }

      
        DB::table('empresas')->where('id', '=', $id)->delete();
        Flash::success('Se eliminó correctamente la empresa.');

        return redirect(route('empresas.index'));
    }
    
    public function ubigeo_listar()
    {
         $ubigeo=DB::table('ubigeos')
         ->select('*')
         ->get();
       
        return datatables()->of($ubigeo)
            ->make(true); 
    }
    
    public function listado_categorias_partida()
    {
       
         $categorias=DB::table('categorias')
                     ->select('*')
                     ->get();
       
        return datatables()->of($categorias)
            ->make(true);  
    }
    
    public function listar_ubigeoEmpresa($idEmpresa)
    {
        
         $ubigeo=DB::table('ubigeos')
                     ->select('*')
                     ->join('ubigeo_empresa', 'ubigeos.id', '=', 'ubigeo_empresa.id_ubigeo')
                     ->where('ubigeo_empresa.id_empresa',$idEmpresa)
                     ->get();
         
        return datatables()->of($ubigeo)
            ->make(true);
    }
   
    

    
    public function listar_partida_all()
    {
       
       $categoria=DB::table('categorias')
                             ->select('*')
                             ->get();
         
        return datatables()->of($categoria)
            ->make(true); 
    }
    
     public function savePartida(Request $request)
    {
     
        $max_codigo=DB::select(DB::raw('select * from categoria_tienda where id = (select max(`id`) from categoria_tienda)')); 
        $max;
        
        if(empty($max_codigo))
        {
            
            $maxCodigo=1;
            
        }else
        {
           foreach($max_codigo as $data)
            {
                $max=$data->codigo;
            }
             $maxCodigo=(int)$max+1;
        }
      
    
        DB::table('categoria_tienda')->insert(
                 [
                     'id_categoria' =>$request->id_partida,
                     'id_tienda' => $request->id_empresa_1,
                     'codigo' =>$maxCodigo,
                 ]
            );
    
    }

       public function empresa_listar()
        {
            
            $empresa=DB::table('empresas')
                         ->select('*')
                         ->get();
 
             // $empresa=DB::table('ubigeo_empresa')
             // ->select(DB::raw('CONCAT(ubigeos.departamento, ", ", ubigeos.provincia,", ",ubigeos.distrito ) AS ubigeoEmpresa'), 'empresas.id','empresas.nombre')
             // ->leftjoin('empresas','empresas.id','=','ubigeo_empresa.id_empresa')
             // ->leftjoin('ubigeos','ubigeos.id','=','ubigeo_empresa.id_ubigeo')
             // ->get();


            return datatables()->of($empresa)
                ->make(true); 
        }
    
    
}
