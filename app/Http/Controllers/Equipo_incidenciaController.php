<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Flash;
use Datatables;

class Equipo_incidenciaController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function crearIncidencia(Request $request)
    {


        DB::table('equipo_incidencia')->insert(
                [

                'codigo' => $request->codigo, 
                'id_equipo' => $request->id_equipo,
                'id_incidencia' =>$request->id_incidencia,
                'id_empresa' => $request->id_tienda,
                'descripcion' => $request->descripcion,
                'fecha_incidencia' => $request->fecha,
                'estado' => 'pendiente',
                'id_problema' => $request->id_problema,
                
                ]
            );
        
        $id=DB::table('equipo_incidencia')->max('id'); 
        DB::table('equipo')
            	->where('id', '=', $request->id_equipo)
            	->update([
            		'estado_equipo' => 'proceso',
            	]);
            	
       DB::table('problema')
            	->where('id', '=', $request->id_problema)
            	->update([
            		'estado' => '1',
            	]);
        return response(['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function BuscarIncidencia(Request $request)
    {

        $codigo=$request->codigo;

        $resultado=DB::table('equipo_incidencia')
                                ->select('equipo.id as idEquipo','equipo.descripcion as descripcionEquipo','empresas.id as idEmpresa','empresas.nombre as nombreEmpresa','equipo_incidencia.id as idInsidencia','equipo_incidencia.descripcion as descripIncidencia','equipo_incidencia.fecha_incidencia','equipo_incidencia.codigo as codigoEquipoIncidencia','tipo_incidencias.id as idTipoInsicencia','tipo_incidencias.description as descriptionTipoInsicencia')
                                ->join('equipo', 'equipo.id', '=', 'equipo_incidencia.id_equipo')
                                ->join('empresas', 'empresas.id', '=', 'equipo_incidencia.id_empresa')
                                ->join('tipo_incidencias', 'tipo_incidencias.id', '=', 'equipo_incidencia.id_incidencia')
                                ->where('equipo_incidencia.codigo', $codigo)->get();

         return response(['data' => $resultado]);
    }

    public function ActualizarIncidencial(Request $request)
    {      
        DB::table('equipo_incidencia')
            ->where('id', '=', $request->idCodigo)
            ->update([
                'codigo' => $request->codigo, 
                'id_equipo' => $request->id_equipo,
                'id_incidencia' =>$request->id_incidencia,
                'id_empresa' => $request->id_tienda,
                'descripcion' => $request->descripcion,
                'fecha_incidencia' => $request->fecha,
            ]);    
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

    public function listarIncidenciasPendientes()
    {
            
            //   $listar=db::table('problema')
            //     ->select('tiendas.nombre as tienda','problema.problema','tipo_incidencias.description as tipoIncidencia','equipo.id as idEquipo','tipo_equipos.descripcion as descripcionEquipo','empresas.id as idEmpresa','empresas.nombre as nombreEmpresa','equipo_incidencia.id as idInsidencia','equipo_incidencia.descripcion as descripIncidencia','equipo_incidencia.fecha_incidencia','equipo_incidencia.codigo as codigoEquipoIncidencia','tipo_incidencias.id as idTipoInsicencia','tipo_incidencias.description as descriptionTipoInsicencia')
            //     ->leftjoin('equipo','equipo.id','=','problema.id_equipo')
            //     ->join('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
            //     ->join('marcas','marcas.id','=','equipo.id_marca')
            //     ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
            //     ->join('tiendas','tiendas.id','=','equipo.id_tienda')
            //     ->join('empresas','empresas.id','=','tiendas.id_empresa')
            //     ->leftjoin('tipo_incidencias', 'tipo_incidencias.id', '=', 'equipo_incidencia.id_incidencia')
            //     ->orderBy('equipo_incidencia.id', 'desc')
            //     ->where('equipo_incidencia.estado','pendiente')
            //     ->get();
            
         
$listar=DB::table('categoria_tienda')
                    ->select('equipo_incidencia.id','tiendas.nombre as tienda','problema.problema','tipo_incidencias.description as tipoIncidencia','equipo.id as idEquipo','tipo_equipos.descripcion as descripcionEquipo','empresas.id as idEmpresa','empresas.nombre as nombreEmpresa','equipo_incidencia.id as idInsidencia','equipo_incidencia.descripcion as descripIncidencia','equipo_incidencia.fecha_incidencia','equipo_incidencia.codigo as codigoEquipoIncidencia','tipo_incidencias.id as idTipoInsicencia','tipo_incidencias.description as descriptionTipoInsicencia')
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
                    ->orderBy('equipo_incidencia.id', 'desc')
                    ->where('equipo_incidencia.estado','pendiente')
                ->get();

            return datatables()->of($listar)
            ->make(true); 
      
    }
    public function listarIncidenciasPreventivos()
    {
       
            //   $listar=db::table('tiendas')
            //             ->select('tiendas.nombre as tienda','empresas.id as idEmpresa','empresas.nombre as nombreEmpresa','preven.codigo as codigoPreventivo')
            //             ->join('empresas','empresas.id','=','tiendas.id_empresa')
            //             ->join('detalle_incidencia_preventivo as de_inc','de_inc.id_tienda','=','tiendas.id')
            //             ->join('incidencia_preventivos as preven','preven.id','=','de_inc.incidencia_preventivos')
            //             ->distinct()
            //             ->get();
            
            //   $listar=db::table('detalle_incidencia_preventivo as de_inc')
            //             ->select(DB::raw('MAX(empresas.descripcion) as descripEmpresa'),DB::raw('MAX(empresas.nombre) as nombreEmpresa'),DB::raw('MAX(preven.codigo) as codigoPreve'),DB::raw('MAX(preven.id) as id'),DB::raw('MAX(tiendas.nombre) as nombre '),DB::raw('MAX(tiendas.nombre) as nombre '))
            //             ->join('incidencia_preventivos as preven','preven.id','=','de_inc.incidencia_preventivos')
            //             ->join('tiendas','tiendas.id','=','de_inc.id_tienda')
            //             ->join('empresas','empresas.id','=','tiendas.id_empresa')
            //             ->groupBy('de_inc.incidencia_preventivos')
            //             ->get();
            
        
            
            //  $listar=db::table('detalle_incidencia_preventivo as de_inc')
            //             ->select(DB::raw('MAX(empresas.descripcion) as descripEmpresa'),DB::raw('MAX(empresas.nombre) as nombreEmpresa'),DB::raw('MAX(preven.codigo) as codigoPreve'),DB::raw('MAX(preven.id) as id'),DB::raw('MAX(tiendas.nombre) as nombre '),DB::raw('MAX(tiendas.nombre) as nombre '))
            //             ->join('incidencia_preventivos as preven','preven.id','=','de_inc.incidencia_preventivos')
            //             ->leftjoin('categoria_tienda','categoria_tienda.id','=','de_inc.id_categoria_tienda')
            //             ->join('tiendas','tiendas.id','=','de_inc.id_tienda')
            //             ->join('empresas','empresas.id','=','tiendas.id_empresa')
            //             ->groupBy('de_inc.incidencia_preventivos')
            //             ->get();
                        
            $listar=db::table('incidencia_preventivos as inc_pre')        
                        ->select('inc_pre.id','inc_pre.codigo','tipo_incidencias.description')
                        ->join('tipo_incidencias','inc_pre.id_tipo_incidencia','=','tipo_incidencias.id')
                        ->get();

            return datatables()->of($listar)
                                ->make(true); 
      
      
    }
    
    
    
    public function problema_listar()
    {
        

        $problema =DB::table('categoria_tienda')
                   ->select(DB::raw('CONCAT("PROBLEMA: ",problema.problema, ", EQUIPO: ",tipo_equipos.descripcion  ) AS problemades'), 'problema.id','problema.problema','problema.codigo','tipo_equipos.descripcion as categoria','equipo.descripcion as equipo','empresas.nombre as nombreEmpresa','tiendas.nombre as  nombreTienda')
                    ->join('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
                    ->join('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                     ->join('areas','areas.id','=','equipo.id_area')
                    ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('problema', 'equipo.id', '=', 'problema.id_equipo')
                    ->leftjoin('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
                    ->where('problema.estado','=',0)
                ->get();
       
      
        return datatables()->of($problema)
            ->make(true); 
    }
}
