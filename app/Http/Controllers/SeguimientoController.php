<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF; 
use Carbon\Carbon;
use Flash;
class SeguimientoController extends Controller
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
        
        $userEmpresa=db::table('empresas')
                  ->select('empresas.id')
                  ->join('users','users.id_empresa','=','empresas.id')
                  ->where('users.id',Auth::user()->id)
                  ->get();
        $idEmpresa;
        foreach($userEmpresa as $item)
        {
            $idEmpresa=$item->id;
        }
      
    //   dd(Auth::user()->id);
        if(Auth::user()->privilege=='visitante')
        {
           
        //   $data=db::table('problema')
        //           ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'equipo.estado_equipo','problema.id as idproblema','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area','equipo_incidencia.estado as estadoIncidencia','orden_servicio.estado as estadoOrden','personal_programacion.avance')
              
        //              ->join('equipo','equipo.id','=','problema.id_equipo')
        //              ->join('marcas','marcas.id','=','equipo.id_marca')
        //             ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
        //           ->join('tiendas','tiendas.id','=','equipo.id_tienda')
        //           ->join('empresas','empresas.id','=','tiendas.id_empresa')
        //             ->join('users','users.id_empresa','=','empresas.id')
        //             ->leftjoin('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
        //             ->leftjoin('orden_servicio','equipo_incidencia.id','=','orden_servicio.id_incidencia')
        //             ->leftjoin('programacions','programacions.id_orden','=','orden_servicio.id')
        //             ->leftjoin('personal_programacion','personal_programacion.id_programacion','=','programacions.id')
                    
        //             ->leftjoin('areas','areas.id','=','equipo.id_area')
                    
        //             ->where('empresas.id',$idEmpresa)
        //             ->get();
           
           
            $data=db::table('problema')
                ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'equipo.estado_equipo','problema.id as idproblema','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area','equipo_incidencia.estado as estadoIncidencia','orden_servicio.estado as estadoOrden','personal_programacion.avance')
                ->leftjoin('equipo','equipo.id','=','problema.id_equipo')
                ->join('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                ->join('categoria_tienda','categoria_tienda.id','=','equipo.id_categoria_tienda')
                ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
                 ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                ->join('empresas','empresas.id','=','tiendas.id_empresa')
                ->leftjoin('users','users.id_empresa','=','empresas.id')
                ->leftjoin('tipo_incidencias', 'tipo_incidencias.id', '=', 'equipo_incidencia.id_incidencia')
                ->leftjoin('orden_servicio','equipo_incidencia.id','=','orden_servicio.id_incidencia')
                ->leftjoin('programacions','programacions.id_orden','=','orden_servicio.id')
                ->leftjoin('personal_programacion','personal_programacion.id_programacion','=','programacions.id')
                ->leftjoin('areas','areas.id','=','equipo.id_area')
                ->orderBy('equipo_incidencia.id', 'desc')
                ->where('equipo_incidencia.estado','pendiente')
                 ->where('empresas.id',$idEmpresa)
                ->get();  
             
      
 

            return view('admin.seguimiento.index',['data'=>$data]);  
            

        }else
        {
            // $data=db::table('problema')
            //       ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'equipo.estado_equipo','problema.id as idproblema','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area','equipo_incidencia.estado as estadoIncidencia','orden_servicio.estado as estadoOrden','personal_programacion.avance')
            //     //   ->join('users','users.id','=','problema.id_usuario')
            //         ->join('equipo','equipo.id','=','problema.id_equipo')
            //         ->join('marcas','marcas.id','=','equipo.id_marca')
            //         ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
            //         ->join('tiendas','tiendas.id','=','equipo.id_tienda')
            //         ->join('empresas','empresas.id','=','tiendas.id_empresa')
            //         ->join('users','users.id_empresa','=','empresas.id')
            //         ->leftjoin('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
            //         ->leftjoin('orden_servicio','equipo_incidencia.id','=','orden_servicio.id_incidencia')
            //         ->leftjoin('programacions','programacions.id_orden','=','orden_servicio.id')
            //         ->leftjoin('personal_programacion','personal_programacion.id_programacion','=','programacions.id')
            //         ->leftjoin('areas','areas.id','=','equipo.id_area')
            //       ->get();
                  
            
            
            $data=db::table('problema')
                ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'equipo.estado_equipo','problema.id as idproblema','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area','equipo_incidencia.estado as estadoIncidencia','orden_servicio.estado as estadoOrden','personal_programacion.avance')
                ->leftjoin('equipo','equipo.id','=','problema.id_equipo')
                ->join('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                ->join('categoria_tienda','categoria_tienda.id','=','equipo.id_categoria_tienda')
                ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
                 ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                ->join('empresas','empresas.id','=','tiendas.id_empresa')
                ->leftjoin('users','users.id_empresa','=','empresas.id')
                ->leftjoin('tipo_incidencias', 'tipo_incidencias.id', '=', 'equipo_incidencia.id_incidencia')
                ->leftjoin('orden_servicio','equipo_incidencia.id','=','orden_servicio.id_incidencia')
                ->leftjoin('programacions','programacions.id_orden','=','orden_servicio.id')
                ->leftjoin('personal_programacion','personal_programacion.id_programacion','=','programacions.id')
                ->leftjoin('areas','areas.id','=','equipo.id_area')
                ->orderBy('equipo_incidencia.id', 'desc')
                ->where('equipo_incidencia.estado','pendiente')
                ->get();  
                
                // dd($data);
            return view('admin.seguimiento.index',['data'=>$data]); 
        }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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


    
    public function pdfListarSeguimiento()
    {
        
        $listar=DB::table('problema')
        ->select('problema.codigo','problema.problema','problema.fecharegistro','users.name')
        ->join('users','users.id','=','problema.id_usuario')
        ->get();
        
        
        $pdf = PDF::loadView('admin.reportes.fin.seguimiento',compact('listar'));
        return $pdf->stream('seguimiento.pdf');  
    }
    
    public function pdfDetalleSeguimiento($id)
    {
        
        $listar=db::table('problema')
                  ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'tipo_equipos.descripcion as equipo','equipo.serie','marcas.descripcion as marca','problema.id','problema.codigo','problema.problema','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area','equipo.tipogas','ubicacions.descripcion as direccion','equipo.modelo','equipo.voltaje','equipo.amperaje','imagen_problema.url as urlproblema')
   
                   ->join('equipo','equipo.id','=','problema.id_equipo')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                   ->join('tiendas','tiendas.id','=','equipo.id_tienda')
                   ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->leftjoin('ubicacions','ubicacions.id_tienda','=','tiendas.id')
                    ->leftjoin('imagen_problema','imagen_problema.id_problema','=','problema.id')
                    ->where('problema.id','=',$id)
                  ->paginate(1);
                  


          
                 
        $imagen=db::table('problema')
                  ->select('imagen_problema.url as urlproblema')
                      ->leftjoin('imagen_problema','imagen_problema.id_problema','=','problema.id')
                    ->where('problema.id','=',$id)
                  ->get();

        $pdf = PDF::loadView('admin.reportes.inicio.informe',compact('listar','imagen'));
        return $pdf->stream('detalleseguimiento.pdf');  
    }
    
    public function pdfDetalleSeguimientoProceso($id)
    {
     $listar=db::table('problema')
                  ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'tipo_equipos.descripcion as equipo','equipo.serie','marcas.descripcion as marca','problema.id','problema.codigo','problema.problema','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area','equipo.tipogas','ubicacions.descripcion as direccion','equipo.modelo','equipo.voltaje','equipo.amperaje','imagen_problema.url as urlproblema')
   
                   ->join('equipo','equipo.id','=','problema.id_equipo')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                   ->join('tiendas','tiendas.id','=','equipo.id_tienda')
                   ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->leftjoin('ubicacions','ubicacions.id_tienda','=','tiendas.id')
                    ->leftjoin('imagen_problema','imagen_problema.id_problema','=','problema.id')
                    ->where('problema.id','=',$id)
                  ->paginate(1);
                  
        
        $imagen=db::table('problema')
                  ->select('imagen_problema.url as urlproblema')
                      ->leftjoin('imagen_problema','imagen_problema.id_problema','=','problema.id')
                    ->where('problema.id','=',$id)
                  ->get();

        $tecnico=db::table('problema')
                  ->select('users.name')
                    ->leftjoin('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
                    ->leftjoin('orden_servicio','equipo_incidencia.id','=','orden_servicio.id_incidencia')
                    ->leftjoin('programacions','programacions.id_orden','=','orden_servicio.id')
                    ->leftjoin('personal_programacion','personal_programacion.id_programacion','=','programacions.id')
                    ->leftjoin('users','users.id','=','personal_programacion.id_users')
                    ->where('problema.id','=',$id)
                    ->get();
                  
        $reparacion=db::table('problema')
                  ->select('problema.problema','users.name','tipo_equipos.descripcion as equipo','marcas.descripcion as marca','equipo.modelo','equipo.serie','equipo.amperaje','equipo.voltaje','tipo_mantenimientos.descripcion as mantenimiento')
                    ->leftjoin('users','users.id','=','problema.id_usuario')
                     ->join('equipo','equipo.id','=','problema.id_equipo')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->leftjoin('equipo_incidencia','equipo_incidencia.id_problema','problema.id')
                    ->leftjoin('orden_servicio','orden_servicio.id_incidencia','equipo_incidencia.id')
                    ->leftjoin('tipo_mantenimientos','tipo_mantenimientos.id','=','orden_servicio.id_tipo_mantenimiento')
                    ->where('problema.id','=',$id)
                    ->get()[0];
        //  dd($cliente);            
        $pdf = PDF::loadView('admin.reportes.proceso.informe',compact('listar','imagen','tecnico','reparacion'));
        return $pdf->stream('detalleseguimiento.pdf');  
    }
    
    public function pdfDetalleSeguimientoFin($id)
    {
        
         $listar=db::table('problema')
                  ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'tipo_equipos.descripcion as equipo','equipo.serie','marcas.descripcion as marca','problema.id','problema.codigo','problema.problema','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area','equipo.tipogas','ubicacions.descripcion as direccion','equipo.modelo','equipo.voltaje','equipo.amperaje','imagen_problema.url as urlproblema')
   
                   ->join('equipo','equipo.id','=','problema.id_equipo')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                   ->join('tiendas','tiendas.id','=','equipo.id_tienda')
                   ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->leftjoin('ubicacions','ubicacions.id_tienda','=','tiendas.id')
                    ->leftjoin('imagen_problema','imagen_problema.id_problema','=','problema.id')
                    ->where('problema.id','=',$id)
                  ->paginate(1);
                 
        $imagen=db::table('problema')
                  ->select('imagen_problema.url as urlproblema')
                      ->leftjoin('imagen_problema','imagen_problema.id_problema','=','problema.id')
                    ->where('problema.id','=',$id)
                  ->get();

                        $tecnico=db::table('problema')
                  ->select('users.name')
                    ->leftjoin('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
                    ->leftjoin('orden_servicio','equipo_incidencia.id','=','orden_servicio.id_incidencia')
                    ->leftjoin('programacions','programacions.id_orden','=','orden_servicio.id')
                    ->leftjoin('personal_programacion','personal_programacion.id_programacion','=','programacions.id')
                    ->leftjoin('users','users.id','=','personal_programacion.id_users')
                    ->where('problema.id','=',$id)
                    ->get();
                    
              $reparacion=db::table('problema')
                  ->select('problema.problema','users.name','tipo_equipos.descripcion as equipo','marcas.descripcion as marca','equipo.modelo','equipo.serie','equipo.amperaje','equipo.voltaje','tipo_mantenimientos.descripcion as mantenimiento')
                    ->leftjoin('users','users.id','=','problema.id_usuario')
                     ->join('equipo','equipo.id','=','problema.id_equipo')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->leftjoin('equipo_incidencia','equipo_incidencia.id_problema','problema.id')
                    ->leftjoin('orden_servicio','orden_servicio.id_incidencia','equipo_incidencia.id')
                    ->leftjoin('tipo_mantenimientos','tipo_mantenimientos.id','=','orden_servicio.id_tipo_mantenimiento')
                    ->where('problema.id','=',$id)
                    ->get()[0];         
        
        
         $imagenculminado=db::table('problema')
                  ->select('imagen_programacion.url')
                     ->leftjoin('equipo','equipo.id','=','problema.id_equipo')
                    ->leftjoin('equipo_incidencia','equipo_incidencia.id_problema','problema.id')
                    ->leftjoin('orden_servicio','orden_servicio.id_incidencia','equipo_incidencia.id')
                    ->leftjoin('programacions','programacions.id_orden','=','orden_servicio.id')
                     ->leftjoin('imagen_programacion','imagen_programacion.id_programacion','=','programacions.id')
                    ->where('problema.id','=',$id)
                    ->get();     


        $pdf = PDF::loadView('admin.reportes.fin.informe',compact('listar','imagen','tecnico','reparacion'));
        return $pdf->stream('detalleseguimiento.pdf');  
    }
    
}
