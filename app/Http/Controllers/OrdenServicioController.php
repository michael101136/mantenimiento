<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Flash;
use Datatables;
class OrdenServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
        {
         $this->middleware(['auth' ,'roles:admin,supervisor,tecnico,visitante,jefe']);
       }
     
    public function index()
    {
        
       $usuarios = User::where('privilege', 'supervisor')->get();

      
                
            $data=DB::table('categoria_tienda')
                    ->select('orden_servicio.id','orden_servicio.estado','orden_servicio.id_preventivo','orden_servicio.fecha','orden_servicio.descripcion','orden_servicio.prioridad', 'orden_servicio.codigo','orden_servicio.prioridad','equipo_incidencia.id as idIncidencia','equipo_incidencia.descripcion as incidenciaDes','tipo_mantenimientos.id as idMante','tipo_mantenimientos.descripcion as manteDes','users.name as nameUser','orden_servicio.id_usuario_supervisor as id_usuario_supervisor','problema.problema','tipo_incidencias.description as tipoincidencia','tipo_equipos.descripcion as tipoequipo','tiendas.nombre as tienda','empresas.nombre as nombreEmpresa')
                    ->join('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
                    ->join('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                     ->join('areas','areas.id','=','equipo.id_area')
                    ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('problema', 'equipo.id', '=', 'problema.id_equipo')
                    ->join('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
                    ->leftjoin('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
                    ->leftjoin('tipo_incidencias', 'tipo_incidencias.id', '=', 'equipo_incidencia.id_incidencia')
                    ->join('orden_servicio','equipo_incidencia.id','=','orden_servicio.id_incidencia')
                    ->join('tipo_mantenimientos', 'tipo_mantenimientos.id', '=', 'orden_servicio.id_tipo_mantenimiento')
                    ->join('users','users.id','=','problema.id_usuario')
                    ->orderBy('problema.id','desc')
                ->get();

                
        return view('admin.ordenServicio.index',['data' =>$data,'usuarios' =>$usuarios]);
    }

    public function listarPreventivo()
    {
            
            $usuarios = User::where('privilege', 'supervisor')->get();
            $data=DB::table('incidencia_preventivos')
                            ->select('tipo_incidencias.description as ti_inc_description','incidencia_preventivos.fecha_incidencia',
                                'incidencia_preventivos.codigo','incidencia_preventivos.id as idIncidenciaPreventivo','users.name as nombreSupervisor','orden_servicio.prioridad','orden_servicio.estado')
                            ->join('tipo_incidencias','tipo_incidencias.id','=','incidencia_preventivos.id_tipo_incidencia')
                            ->join('orden_servicio','incidencia_preventivos.id','=','orden_servicio.id_preventivo')
                            ->join('users','users.id','=','orden_servicio.id_usuario_supervisor')
                            ->where('incidencia_preventivos.estado','proceso')
                            ->get();
              
            $arrayPreventivo=[];
            foreach($data as $key => $value)
            {
                 
                 $arrayPreventivo[]=[

                        'idIncidenciaPreventivo' => $value->idIncidenciaPreventivo,
                        'description' => $value->ti_inc_description,
                        'codigo' => $value->codigo,
                        'fecha_incidencia' => $value->fecha_incidencia,
                        'orden_prioridad' => $value->prioridad,
                        'nombreSupervisor' =>$value->nombreSupervisor,
                        'estado_prioridad' =>$value->estado,
                        'detalle'=> DB::table('categoria_tienda')
                                    ->select('tiendas.nombre as tienda','empresas.nombre as empresa','categorias.descripcion as partida')
                                    ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
                                    ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                                    ->join('empresas','empresas.id','=','tiendas.id_empresa')
                                    ->join('detalle_incidencia_preventivo','categoria_tienda.id','=','detalle_incidencia_preventivo.id_categoria_tienda')
                                    ->where('detalle_incidencia_preventivo.incidencia_preventivos','=',$value->idIncidenciaPreventivo)
                                    ->get()
                        
                    ];
                    
              
               
            }
             return view('admin.ordenServicio.index_preventivo',['data' =>$arrayPreventivo,'usuarios' =>$usuarios]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          
       
        $usuarios = User::where('privilege', 'supervisor')->get();
        
       
        $max_codigo=DB::select(DB::raw('select * from orden_servicio where id = (select max(`id`) from orden_servicio)')); 
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
         $maxCodigo=(int)$max+1;
        return view('admin.ordenServicio.create',['usuario'=>$usuarios,'maxCodigo'=>$maxCodigo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function ordenServicioCreate(Request $request)
    {

       
        if(is_null($request->id_incidencia_preventivo))
        {
            
            $user = Auth::user();

            DB::table('orden_servicio')->insert(
                    [
    
                    'codigo' => $request->codigo, 
                    'prioridad' => $request->prioridad,
                    'id_incidencia' =>$request->id_incidencia,
                    'id_tipo_mantenimiento' => $request->id_tipo_mantenimiento,
                    'estado' => $request->estado,
                    'fecha' => $request->fecha,
                    'descripcion'=>$request->descripcion,
                    'id_usuario'=>$user->id,
                    'id_preventivo'=>'',
                    'id_usuario_supervisor'=>$request->id_usuario_supervisor
                    ]
                );
            
                DB::table('equipo_incidencia')
                	->where('id', '=', $request->id_incidencia)
                	->update([
                		'estado' => 'proceso',
                	]);
           
            $id=DB::table('orden_servicio')->max('id'); 
    
            return response(['id' => $id]);
        }else
        {
            

            $user = Auth::user();

            DB::table('orden_servicio')->insert(
                    [
    
                    'codigo' => $request->codigo, 
                    'prioridad' => $request->prioridad,
                    'id_incidencia' =>$request->id_incidencia,
                    'id_tipo_mantenimiento' => $request->id_tipo_mantenimiento,
                    'estado' => $request->estado,
                    'fecha' => $request->fecha,
                    'descripcion'=>$request->descripcion,
                    'id_usuario'=>$user->id,
                    'id_preventivo'=>$request->id_incidencia_preventivo,
                    'id_usuario_supervisor'=>$request->id_usuario_supervisor
                    ]
                );
            
                DB::table('incidencia_preventivos')
                	->where('id', '=', $request->id_incidencia_preventivo)
                	->update([
                		'estado' => 'proceso',
                	]);
           
            $id=DB::table('orden_servicio')->max('id'); 
    
            return response(['id' => $id]);
        }
        
        
        
    }

     public function BuscarOrdenServicios()
    {

     
        $resultado=DB::table('categoria_tienda')
                  ->select(DB::raw('CONCAT("PROBLEMA: ",problema.problema, ", EQUIPO: ",tipo_equipos.descripcion  ) AS problemades'),'empresas.nombre as nombreEmpresa','tiendas.nombre as  nombreTienda','orden_servicio.codigo','orden_servicio.id')
                ->join('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
                    ->join('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                     ->join('areas','areas.id','=','equipo.id_area')
                    ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('problema', 'equipo.id', '=', 'problema.id_equipo')
                    ->join('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
                    ->leftjoin('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
                    ->leftjoin('tipo_incidencias', 'tipo_incidencias.id', '=', 'equipo_incidencia.id_incidencia')

                ->join('orden_servicio','orden_servicio.id_incidencia','=','equipo_incidencia.id')
                ->where('orden_servicio.estado',1)
                ->get(); 
        return datatables()->of($resultado)
            ->make(true); 


    }

    public function ordenServicioActualizar(Request $request)
    {
        $user = Auth::user();

        DB::table('orden_servicio')
            ->where('id', '=', $request->id)
            ->update([
                'codigo' => $request->codigo, 
                'prioridad' => $request->prioridad,
                'id_incidencia' =>$request->id_incidencia,
                'id_tipo_mantenimiento' => $request->id_tipo_mantenimiento,
                'estado' => $request->estado,
                'fecha' => $request->fecha,
                'descripcion'=>$request->descripcion,
                'id_usuario'=>$user->id,
                'id_usuario_supervisor'=>$request->id_usuario_supervisor
            ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listarTipoMantenimiento()
    {
        $data=DB::table('tipo_mantenimientos')
                ->select('id','codigo','descripcion')
                ->get();

        return response(['data' => $data]);
    }
    public function listarTiendas()
    {
        $data=DB::table('tiendas')
                ->select('id','codigo','nombre')
                ->get();
        
        return response(['data' =>$data]);
    }

      public function listarIncidenciasPreventivosProgramacion()
      {

         $listar=db::table('incidencia_preventivos as inc_pre')        
                        ->select('orden_servicio.id','orden_servicio.codigo','tipo_incidencias.description','orden_servicio.descripcion as descripcionOrden')
                        ->join('tipo_incidencias','inc_pre.id_tipo_incidencia','=','tipo_incidencias.id')
                        ->join('orden_servicio','orden_servicio.id_preventivo','=','inc_pre.id')
                        ->where('orden_servicio.estado',1)
                        ->get();

            return datatables()->of($listar)
                                ->make(true); 

      }
}
