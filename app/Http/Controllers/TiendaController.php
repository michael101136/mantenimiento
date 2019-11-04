<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTiendaRequest;
use App\Http\Requests\UpdateTiendaRequest;
use App\Repositories\TiendaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Datatables;
use DB;

class TiendaController extends AppBaseController
{
    /** @var  TiendaRepository */
    private $tiendaRepository;

    public function __construct(TiendaRepository $tiendaRepo)
    {
        $this->tiendaRepository = $tiendaRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Tienda.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $tiendas = $this->tiendaRepository->all();

        // $tiendas=db::table('empresas')
        //           ->select('tiendas.id','tiendas.codigo','tiendas.nombre','empresas.nombre as empresaNombre',DB::raw('CONCAT(ubigeos.departamento, ", ",ubigeos.provincia, ", ",ubigeos.distrito) AS ubicacion'),'ubigeo_tienda.direccion')
        //            ->join('tiendas','empresas.id','=','tiendas.id_empresa')
        //            ->join('ubigeo_tienda','tiendas.id','=','ubigeo_tienda.id_tienda')
        //           ->get();

          $tiendas=db::table('empresas')
                  ->select('tiendas.id','tiendas.codigo','tiendas.nombre','empresas.nombre as empresaNombre')
                   ->join('tiendas','empresas.id','=','tiendas.id_empresa')
                  ->get();
          $arrayTienda=[];
          foreach($tiendas as $key => $value)
          {
             $arrayTienda[]=[

                        'id' => $value->id,
                        'codigo' => $value->codigo,
                        'nombre' => $value->nombre,
                        'empresaNombre' => $value->empresaNombre,
                        'ubicacion'=> DB::table('ubigeos')
                                    ->select('ubigeo_tienda.id','ubigeo_tienda.direccion',DB::raw('CONCAT(ubigeos.departamento, ", ",ubigeos.provincia, ", ",ubigeos.distrito) AS ubicacion'))
                                    ->join('ubigeo_tienda','ubigeos.id','=','ubigeo_tienda.id_ubigeo')
                                    ->where('ubigeo_tienda.id_tienda','=', $value->id)
                                    ->get()
                        
                    ];
          }


        return view('admin.tiendas.index')
            ->with('tiendas', $arrayTienda);
    }
    
     public function listar_tienda($id_empresa)
        {
           
           
            $data =DB::table('categoria_tienda')
                   ->select('categoria_tienda.id','ubigeos.departamento','ubigeos.provincia','ubigeo_tienda.direccion','tiendas.nombre as tienda','tiendas.codigo','categorias.descripcion as partida')
                    ->join('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->join('ubigeos','ubigeos.id','=','ubigeo_tienda.id_ubigeo')
                    ->join('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                    ->join('empresas','empresas.id','=','tiendas.id_empresa')  
                    ->where('tiendas.id_empresa',$id_empresa)    
                    ->get();

                           
           return datatables()->of($data)
                                ->make(true);
            
            
        }
        
 public function listar_partida_Tienda($idTienda)
    {
        
        $partida_tienda=DB::table('categoria_tienda')
                     ->select('categoria_tienda.id','tiendas.nombre','categoria_tienda.codigo','categorias.descripcion')
                     ->join('tiendas', 'tiendas.id', '=', 'categoria_tienda.id_tienda')
                     ->join('categorias', 'categorias.id', '=', 'categoria_tienda.id_categoria')
                     ->where('categoria_tienda.id_tienda',$idTienda)
                     ->get();
         
        return datatables()->of($partida_tienda)
            ->make(true);
    }
    
   
    /**
     * Show the form for creating a new Tienda.
     *
     * @return Response
     */
    public function create()
    {
        $max_codigo=DB::select(DB::raw('select * from tiendas where id = (select max(`id`) from tiendas)')); 
        if(count($max_codigo)=='0')
        {
            $max=0;
        }
        else
        {
            $max;
            foreach($max_codigo as $data)
            {
                $max=$data->codigo;
            }
        }
        $maxCodigo= (int)$max+1;
        $option=0;
       
        return view('admin.tiendas.create',['codigo'=>$maxCodigo,'option'=>$option]);
    }

    /**
     * Store a newly created Tienda in storage.
     *
     * @param CreateTiendaRequest $request
     *
     * @return Response
     */
    public function store(CreateTiendaRequest $request)
    {
         
            DB::table('tiendas')->insert(
                array(
                   'codigo' => $request->codigo,  
                   'nombre' => $request->nombre, 
                   'id_empresa' =>  $request->id_empresa
                   )
            );
            
             $idMaxTienda=DB::table('tiendas')->max('id');
             
            DB::table('ubigeo_tienda')->insert(
                array(
                    'id_tienda' => $idMaxTienda, 
                    'id_ubigeo' => $request->id_ubigeo,
                    'direccion' => $request->direccion
                  )
            );
            
          
            Flash::success('Se guardó correctamente la tienda.');

            return redirect(route('tiendas.index'));

          
    }

    /**
     * Display the specified Tienda.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tienda = $this->tiendaRepository->find($id);

        if (empty($tienda)) {
            Flash::error('Tienda not found');

            return redirect(route('tiendas.index'));
        }
        
        
        return view('admin.tiendas.show')->with('tienda', $tienda);
    }

    /**
     * Show the form for editing the specified Tienda.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $option=1;
        $tienda = $this->tiendaRepository->find($id);

        if (empty($tienda)) {
            Flash::error('Tienda not found');

            return redirect(route('tiendas.index'));
        }

        return view('admin.tiendas.edit',['tienda'=>$tienda,'option'=> $option]);
        
    }

    /**
     * Update the specified Tienda in storage.
     *
     * @param int $id
     * @param UpdateTiendaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTiendaRequest $request)
    {
        $tienda = $this->tiendaRepository->find($id);

        if (empty($tienda)) {
            Flash::error('Tienda not found');

            return redirect(route('tiendas.index'));
        }

        $tienda = $this->tiendaRepository->update($request->all(), $id);

        Flash::success('Se actualizó correctamente la tienda.');

        return redirect(route('tiendas.index'));
    }

    /**
     * Remove the specified Tienda from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tienda = $this->tiendaRepository->find($id);

        if (empty($tienda)) {
            Flash::error('Tienda not found');

            return redirect(route('tiendas.index'));
        }

       DB::table('tiendas')->where('id', '=', $id)->delete();

        Flash::success('Se eliminó correctamente la tienda.');

        return redirect(route('tiendas.index'));
    }
    
    
    
       public function listarTiendas()
    {
       

        $tienda=DB::table('tiendas')
            ->select(DB::raw('CONCAT(ubigeos.departamento, ", ",ubigeos.provincia, ", ",ubigeos.distrito) AS ubigeo') ,'empresas.nombre as empresa','tiendas.id','tiendas.nombre','tiendas.codigo','ubigeos.departamento','ubigeos.provincia','ubigeos.distrito')
            ->join('empresas','empresas.id','=','tiendas.id_empresa')
            ->join('ubigeo_empresa','ubigeo_empresa.id_empresa','=','empresas.id')
            ->join('ubigeos','ubigeos.id','=','ubigeo_empresa.id_ubigeo')
            ->get();

    
        return datatables()->of($tienda)
            ->make(true); 
    }
     public function listarTiendasPartidad()
    {
       
        $tienda=DB::table('empresas')
                     ->select(DB::raw('CONCAT(ubigeos.departamento, ", ",ubigeos.provincia, ", ",ubigeos.distrito) AS ubigeo'),'tiendas.nombre as nombre','ubigeo_tienda.id','ubigeo_tienda.direccion','tiendas.codigo','empresas.nombre as nombreEmpresa')
                    ->join('tiendas','empresas.id','=','tiendas.id_empresa')
                    ->join('ubigeo_tienda','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->join('ubigeos','ubigeos.id','=','ubigeo_tienda.id_ubigeo')
                    ->get();
      
        // $tienda=DB::table('categoria_tienda')
        //             ->select(DB::raw('CONCAT(ubigeos.departamento, ", ",ubigeos.provincia, ", ",ubigeos.distrito) AS ubigeo'),'tiendas.nombre as nombre','categoria_tienda.id','categorias.descripcion','categoria_tienda.codigo','empresas.nombre as nombreEmpresa')
        //             ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
        //             ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
        //             ->join('empresas','empresas.id','=','tiendas.id_empresa')
        //             ->join('ubigeo_empresa','ubigeo_empresa.id_empresa','=','empresas.id')
        //             ->join('ubigeos','ubigeos.id','=','ubigeo_empresa.id_ubigeo')
        //             ->get();

    
        return datatables()->of($tienda)
            ->make(true); 
    }

     public function saveUbigeoTienda(Request $request)
    {
        
        
        DB::table('ubigeo_tienda')->insert(
                array(
                    'id_tienda' => $request->id_tienda, 
                    'id_ubigeo' => $request->id_ubigeo,
                    'direccion' => $request->direccion
                  )
            );
        
        
    }
    public function eliminar_tienda_ubicacion($id)
    {
        
        
        DB::table('ubigeo_tienda')->where('id', '=', $id)->delete();
        
        
    }

    
}
