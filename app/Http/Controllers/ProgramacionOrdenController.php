<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\Helpers\publicFunction;
class ProgramacionOrdenController extends Controller
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
        $user = DB::table('users')
                    ->select('id','privilege','name')
                ->get();
        
        if(Auth::user()->privilege =='tecnico')
        {
          
         $data = DB::table('users')
                    ->select('personal_programacion.id','personal_programacion.avance','programacions.codigo','personal_programacion.estado','users.name','users.privilege','programacions.descripcion as desProgramacion','programacions.fechainicio','programacions.fechafin','orden_servicio.descripcion as descrOrden')
                    ->join('personal_programacion', 'users.id', '=', 'personal_programacion.id_users')
                    ->join('programacions', 'programacions.id', '=', 'personal_programacion.id_programacion')
                    ->join('orden_servicio', 'orden_servicio.id', '=', 'programacions.id_orden')
                    ->where('personal_programacion.id_users','=',Auth::user()->id)
                    ->get();
        
        }else
        {
            $data=DB::table('categoria_tienda')
                    ->select('personal_programacion.id','personal_programacion.avance','programacions.codigo','personal_programacion.estado','personal_programacion.id_users','programacions.descripcion as desProgramacion','programacions.fechainicio','programacions.fechafin','orden_servicio.descripcion as descrOrden','programacions.hora_inicio','programacions.hora_fin','programacions.hora_marcada_inicio','programacions.hora_marcada_fin','programacions.tiempoestimado','programacions.diaestimado')
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
                    ->join('programacions','orden_servicio.id','=','programacions.id_orden')
                    ->join('personal_programacion','programacions.id','=','personal_programacion.id_programacion')
                    ->join('tipo_mantenimientos', 'tipo_mantenimientos.id', '=', 'orden_servicio.id_tipo_mantenimiento') 
                    ->get();
            

            // $data = DB::table('users')
            //         ->select('personal_programacion.id','personal_programacion.avance','programacions.codigo','personal_programacion.estado','users.name','users.privilege','programacions.descripcion as desProgramacion','programacions.fechainicio','programacions.fechafin','orden_servicio.descripcion as descrOrden','programacions.hora_inicio','programacions.hora_fin','programacions.hora_marcada_inicio','programacions.hora_marcada_fin','programacions.tiempoestimado','programacions.diaestimado')
            //         ->join('personal_programacion', 'users.id', '=', 'personal_programacion.id_users')
            //         ->join('programacions', 'programacions.id', '=', 'personal_programacion.id_programacion')
            //         ->join('orden_servicio', 'orden_servicio.id', '=', 'programacions.id_orden')
            //         ->get();

            // dd($data);
          
        }
    
     
        return view('admin.programarOrden.index',['data'=> $data,'users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::where('privilege', 'tecnico')->get();
        
        $maxCodigo=publicFunction::maxCodigo('programacions');


        $fechaIncio = Carbon::now('America/Lima');
        $date=$fechaIncio->format('Y-m-d');
       
        
        return view('admin.programarOrden.create',['usuarios' =>$usuarios,'maxCodigo'=>$maxCodigo,'date'=> $date]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    public function  programacionCreate(request $request)
    {

       
       //valida
       
         $dato = DB::table('tipo_programacions')
                    ->where('codigo', '=', $request->tipo_programacion)
                    ->get();
        $id;
        foreach ($dato as $item) {
            $id=$item->id;
        }

       
                DB::table('programacions')->insert(
                    [
                     'id_orden' => $request->id,
                     'id_tipo_programacion' =>$id,
                     'codigo' => $request->codigo,
                     'descripcion'=> $request->descripcion,
                     'estado' => $request->estado,
                     'fechainicio' => $request->fecha_inicio,
                     'fechafin' => $request->fecha_fin,
                     'frecuencia' => $request->frecuencia,
                     'tiempoestimado' => $request->tm_estimado,
                     'diaestimado' => $request->dias_estimados,
                     'hora_inicio' => $request->hora_inicio,
                     'hora_fin' => $request->hora_fin,
                     'hora_marcada_inicio' => $request->hora_marcada_inicio,
                     'hora_marcada_fin' => $request->hora_marcada_fin,
                    ]
                );
                
      
        // if($request->tipo_programacion=='02')
        // {
        //         DB::table('programacions')->insert(
        //             [
        //              'id_orden' => $request->id,
        //              'id_tipo_programacion' =>$id,
        //              'codigo' => $request->codigo,
        //              'descripcion'=> $request->descripcion,
        //              'estado' => $request->estado,
        //              'fechainicio' => $request->fecha_inicio,
        //              'fechafin' => $request->fecha_fin,
        //              'frecuencia' => $request->frecuencia1,
        //              'tiempoestimado' => $request->tm_estimado,
        //              'diaestimado' => $request->dias_estimados,
        //              'hora_inicio' => $request->hora_inicio,
        //              'hora_fin' => $request->hora_fin,
        //              'hora_marcada_inicio' => $request->hora_marcada_inicio,
        //              'hora_marcada_fin' => $request->hora_marcada_fin,
        //             ]
        //         );
        // }
        // if($request->tipo_programacion=='03')
        // {
        //         DB::table('programacions')->insert(
        //             [
        //              'id_orden' => $request->id,
        //              'id_tipo_programacion' =>$id,
        //              'codigo' => $request->codigo,
        //              'descripcion'=> $request->descripcion,
        //              'estado' => $request->estado,
        //              'fechainicio' => $request->fecha_inicio,
        //              'fechafin' => $request->fecha_fin,
        //              'id_medidor' => $request->medidor_id,
        //              'tiempoestimado' => $request->tm_estimado,
        //              'diaestimado' => $request->dias_estimados,
        //              'hora_inicio' => $request->hora_inicio,
        //              'hora_fin' => $request->hora_fin,
        //              'hora_marcada_inicio' => $request->hora_marcada_inicio,
        //              'hora_marcada_fin' => $request->hora_marcada_fin,
        //             ]
        //         );
        // }
        // if($request->tipo_programacion=='04')
        // {
        //         DB::table('programacions')->insert(
        //             [
        //              'id_orden' => $request->id,
        //              'id_tipo_programacion' =>$id,
        //              'codigo' => $request->codigo,
        //              'descripcion'=> $request->descripcion,
        //              'estado' => $request->estado,
        //              'fechainicio' => $request->fecha_inicio,
        //              'fechafin' => $request->fecha_fin,
        //              'id_medidor' => $request->medidor_id_1,
        //              'tiempoestimado' => $request->tm_estimado,
        //              'diaestimado' => $request->dias_estimados,
        //              'frecuencia' => $request->frecuencia2,
        //              'lectura' => $request->lectura,
        //              'ultimavez' => $request->vez,
        //              'hora_inicio' => $request->hora_inicio,
        //              'hora_fin' => $request->hora_fin,
        //              'hora_marcada_inicio' => $request->hora_marcada_inicio,
        //              'hora_marcada_fin' => $request->hora_marcada_fin,
        //             ]
        //         );
        // }
        
        $id_programacion=DB::table('programacions')->max('id');

        $usuarios=$request->id_usuario_tecnico;
            for ($i=0;$i<count($usuarios);$i++)    
            {     
                $progra = DB::table('programacions')->where('id', '=', $id_programacion)->get();
                foreach($progra as $data)
                {
                    
                    DB::table('personal_programacion')->insert(
                                [
                                 'id_users' => $usuarios[$i],
                                 'id_programacion' =>$id_programacion,
                                 'id_tipo_programacion' => $id,
                                 'fecha_inicio'=> $request->fecha_inicio,
                                 'fecha_fin' => $request->fecha_fin,
                                 'hora_inicio' => '1',
                                 'hora_fin' => '89',
                                 'descripcion' => '',
                                 'estado' => '1',
                                 'avance' => '0',
                                ]
                            );
                    $personal_prog_id=DB::table('personal_programacion')->max('id');
                    
                    $progra_use = DB::table('personal_programacion')->where('id', '=', $personal_prog_id)->get();
                    
                    $progra = DB::table('programacions')->where('id', '=', $id_programacion)->get();
                    
                    $user_id;
                    foreach($progra_use as $data)
                    {
                        $user_id=$data->id_users;
                    }
                    
                    foreach($progra as $dataUserPro)
                    {
                        if($user_id==$usuarios[$i] && $dataUserPro->hora_inicio==$request->hora_inicio && $dataUserPro->hora_fin==$request->hora_fin &&
                        $dataUserPro->fechainicio==$request->fechainicio &&  $dataUserPro->fechafin==$request->fechafin  )
                        {
                            DB::table('personal_programacion')->where('id', $personal_prog_id)->delete();
                        }
                    }
                    
                }

            }


            DB::table('orden_servicio')
                	->where('id', '=', $request->id)
                	->update(
                    	    [
                    		'estado' => 'proceso',
                    	    ]
                    	);
            	
        return response(['id' => $id_programacion]);

        
    }

    function listarUsuarioProgramado(Request $request)
    {
       
        $data = DB::table('users')
        ->select('users.name','users.privilege','personal_programacion.fecha_inicio')
        ->join('personal_programacion', 'users.id', '=', 'personal_programacion.id_users')
        ->where('personal_programacion.id_programacion', $request->idProgramacion)
        ->get();
        return response(['data' =>  $data]);
    }

    function buscarProgramacion(Request $request)
    {


        $data = DB::table('programacions')
                ->select('*')
                ->where('programacions.codigo', $request->codigo)
                ->get();
        return response(['data' =>  $data]);


    }

    function cambiarProgramacion_user_Estado(Request $request)
    {
         DB::table('personal_programacion')
        	->where('id', '=', $request->id)
        	->update([
        		'estado' => '0',
        	]);
        return $request->id;
    }
    
    function Programacion_avance(Request $request)
    {
        $fechaA = Carbon::now('America/Lima');
        $date=$fechaA->format('Y-m-d');
        DB::table('avance')->insert(
                    [
                     'porcentaje' => $request->porcentaje,
                     'fecha' => $date,
                     'descripcion' => $request->descripcion,
                     'id_personal_programacion'=> $request->id_personal_programacion,
                    ]
                );
        
        $avance=DB::table('avance')
                ->select('porcentaje')
            	->where('id_personal_programacion', '=', $request->id_personal_programacion)
            	->get();
        $suma=0;
        foreach($avance as $item)
        {
            $suma=$suma+(int)$item->porcentaje;
        }
        
        DB::table('personal_programacion')
        	->where('id', '=', $request->id_personal_programacion)
        	->update([
        		'avance' => $suma,
        	]);
        
    }
    
    function Programacion_avance_listar_user(Request $request)
    {
        $avance=DB::table('avance')
                ->select('*')
            	->where('id_personal_programacion', '=', $request->id_personal_programacion)
            	->get(); 
       return response(['data' => $avance]);
    }
    
    
    public function storeImagen(Request $request)
            {
                
               
                
                $file = $request->file('file');
                $path =public_path().'/admin/programacion';
        
                $fileName = uniqid() . $file->getClientOriginalName();
        
                $file->move($path, $fileName);
        
               
        
                 DB::table('imagen_programacion')->insert([
                    'id_programacion' => $request->id,
                    'url' => '/admin/programacion'.'/'.$fileName
                
                ]);
                
             
                	
              
             
            }
        public function listarImagenes($id)
        {
            $data=DB::table('imagen_programacion')
            ->select('*')
            ->where('id_programacion','=',$id)
            ->get();
            
            return response()->json(['data'=>$data]);
        }
        
         public function EliminarImagenes_problema($id)
        {
                
    
                
                DB::table('imagen_programacion')->where('id', '=', $id)->delete();
                
                return response()->json(['data' => "Correcto"]);
    
        }
    
    
}
