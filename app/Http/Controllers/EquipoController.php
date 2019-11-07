<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use App\Repositories\EquipoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Barryvdh\DomPDF\Facade as PDF; 
use Datatables;

class EquipoController extends AppBaseController
{
    /** @var  EquipoRepository */
    private $equipoRepository;

    public function __construct(EquipoRepository $equipoRepo)
    {
        $this->equipoRepository = $equipoRepo;
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
    }

    /**
     * Display a listing of the Equipo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $equipos = $this->equipoRepository->all();
       
        return view('admin.equipos.index')
            ->with('equipos', $equipos);
    }

      public function equipo_listar()
    {
        // $equipo = $this->equipoRepository->all();

         $equipo =DB::table('categoria_tienda')
                   ->select('equipo.idequipo as codigo','equipo.id','equipo.descripcion','tiendas.nombre as tienda','empresas.nombre as empresa','equipo.serie','areas.nombre as area','tipo_equipos.descripcion as tipoequipo','marcas.descripcion as marca','categorias.descripcion as partida')
                    ->leftjoin('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->leftjoin('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
                    ->leftjoin('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->leftjoin('categorias','categorias.id','=','categoria_tienda.id_categoria')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->leftjoin('empresas','empresas.id','=','tiendas.id_empresa')
                    ->leftjoin('marcas','marcas.id','=','equipo.id_marca')
                    ->leftjoin('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
                ->get();
       
       
        return datatables()->of($equipo)
            ->make(true);
           
    }
  public function CrearEquipoPrincipal(Request $request)
    {

      
        // DB::table('categoria_tienda')->insert([
           
        //     'id_categoria' => $request->id_partida,
        //     'id_tienda' => $request->id_tienda,
          
        // ]);

        // $id_categoria_tienda=DB::table('categoria_tienda')->max('id'); 

        DB::table('equipo')->insert([
            'idequipo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'id_marca' => $request->id_marca,
            'serie' => $request->peso,
            'modelo' => $request->modelo,
            'voltaje' => $request->peso_envio,
            'estado_cliente' =>'1',
            'amperaje' => $request->altura,
            'tipogas' => $request->ancho,
            'largo' => $request->largo,
            'id_unidad' => $request->id_unidad,
            'cantidad' => $request->cantidad,
            'potencia' => $request->potencia,
            'id_categoria_tienda' =>$request->id_partida,
            'id_area' => $request->id_area,
            'estado_equipo' =>'Inicio',
        ]);

        $id=DB::table('equipo')->max('id'); 



        return response(['id' => $id]);
    }

    public function ActualizarEquipoPrincipal(Request $request)
    {
        
       
        DB::table('equipo')
            ->where('id', '=', $request->id)
            ->update([
                'idequipo' => $request->codigo,
                'descripcion' => $request->descripcion,
                'id_marca' => $request->id_marca,
                'id_categoria_tienda' => $request->id_partida,
                'id_area' => $request->id_area,
                'voltaje' => $request->peso_envio,
                'modelo' => $request->modelo,
                'largo' => $request->largo,
                'id_unidad' => $request->id_unidad,
                'cantidad' => $request->cantidad,
                'potencia' => $request->potencia,
                'id_equipo_padre'=>$request->id_equipo_padre 
            ]);

           


    }
    public function BuscarEquipoPrincipal(Request $request)
    {

       $id=$request->id;

      
       $resultado =DB::table('categoria_tienda')
                   ->select("*",'tipo_equipos.descripcion as descripcionTipo','marcas.descripcion as marcaDescripcion','tiendas.nombre as nombreTienda','tiendas.id as id_tienda','categorias.descripcion as partidaNombre','areas.nombre as areaNombre','unidad_medidas.description as nombreUnuidad')
                    ->join('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
                    ->join('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->leftjoin('categorias','categorias.id','=','categoria_tienda.id_categoria')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->leftjoin('empresas','empresas.id','=','tiendas.id_empresa')
                    ->leftjoin('marcas','marcas.id','=','equipo.id_marca')
                    ->leftjoin('unidad_medidas','unidad_medidas.id','=','equipo.id_unidad')
                    ->leftjoin('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
                    ->where('equipo.id',  $id)->get();

       // $resultado=DB::table('equipo')
       //                  ->select("*",'tipo_equipos.descripcion as descripcionTipo','marcas.descripcion as marcaDescripcion')
       //                   ->join('tipo_equipos','tipo_equipos.id','=','equipo.id_equipo_padre')
       //                   ->join('marcas','marcas.id','=','equipo.id_marca')

       //                  ->where('equipo.id',  $id)->get();
        
          return response(['data' => $resultado]);

    }
    

     public function listarEquipos(Request $request)
     {
        
        // $listar = $this->equipoRepository->all();
        
         $listar=DB::table('equipo')
                     ->select('equipo.id','equipo.descripcion','equipo.idequipo')
                     ->where('equipo.estado_equipo','=','Inicio')
                    ->get();
        
        $opcon=2;
        return response(['data' => $listar,'opcionUrl'=>$opcon]);
        
        
     }
    /**
     * Show the form for creating a new Equipo.
     *
     * @return Response
     */
    public function create()
    {
       
        return view('admin.equipos.create');
    }

    /**
     * Store a newly created Equipo in storage.
     *
     * @param CreateEquipoRequest $request
     *
     * @return Response
     */
    public function store(CreateEquipoRequest $request)
    {
        $input = $request->all();

        $equipo = $this->equipoRepository->create($input);

        Flash::success('Equipo saved successfully.');

        return redirect(route('equipos.index'));
    }

    /**
     * Display the specified Equipo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        return view('admin.equipos.show')->with('equipo', $equipo);
    }

    /**
     * Show the form for editing the specified Equipo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        return view('admin.equipos.edit')->with('equipo', $equipo);
    }

    /**
     * Update the specified Equipo in storage.
     *
     * @param int $id
     * @param UpdateEquipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquipoRequest $request)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        $equipo = $this->equipoRepository->update($request->all(), $id);

        Flash::success('Equipo updated successfully.');

        return redirect(route('equipos.index'));
    }

    /**
     * Remove the specified Equipo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        $this->equipoRepository->delete($id);

        Flash::success('Equipo deleted successfully.');

        return redirect(route('equipos.index'));
    }

    public function pdfListarEquipo()
    {
        $listar=DB::table('equipo')
            ->select('marcas.descripcion as marcas','tipo_equipos.descripcion as tipoequipo','equipo.descripcion','equipo.modelo','equipo.peso','equipo.altura','equipo.ancho','equipo.largo')
            ->join('tipo_equipos','tipo_equipos.id','=','equipo.id_equipo_padre')
            ->join('marcas','marcas.id','=','equipo.id_marca')
            ->get();

        // dd($listar);
        $pdf = PDF::loadView('admin.reportes.inicio.equipos',compact('listar'));
        return $pdf->stream('historialcompleto.pdf');   
    }
     public function storeImagen(Request $request)
    {
        
        $file = $request->file('file');
        $path =public_path().'/admin/equipo';

        $fileName = uniqid() . $file->getClientOriginalName();

        $file->move($path, $fileName);

        $id=DB::table('equipo')->max('id');


        DB::table('equipo')
        	->where('id', '=', $id)
        	->update([
        		'url' => '/admin/equipo'.'/'.$fileName
        	]);
        	
      
     
    }   

}
