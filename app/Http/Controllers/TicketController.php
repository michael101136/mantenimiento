<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF; 
use Carbon\Carbon;
use Flash;
use App\Http\Requests\createProblemaRequest;
class TicketController extends Controller
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
        
    //   dd(Auth::user()->id);
        if(Auth::user()->privilege=='visitante')
        {
           
           $data=db::table('problema')
                  ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'problema.id','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area')
                  ->join('users','users.id','=','problema.id_usuario')
                   ->join('equipo','equipo.id','=','problema.id_equipo')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                   ->join('tiendas','tiendas.id','=','equipo.id_tienda')
                   ->leftjoin('empresas','empresas.id','=','tiendas.id_empresa')
                    ->leftjoin('areas','areas.id','=','equipo.id_area')
                    ->where('problema.id_usuario',Auth::user()->id)
                    ->orderBy('problema.id','desc')
                  ->get();
       

            return view('admin.preventivo.index',['data'=>$data]);  
            

        }else
        {
           
    //   $data=DB::table('categoria_tienda')
    //                 ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'problema.id','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area')
    //                 ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
    //                 ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
    //                 ->join('empresas','empresas.id','=','tiendas.id_empresa')
    //                 ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
    //                 ->join('marcas','marcas.id','=','equipo.id_marca')
    //                 ->join('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
    //                 ->leftjoin('areas','areas.id','=','equipo.id_area')
    //                 ->join('problema', 'equipo.id', '=', 'problema.id_equipo')
    //                 ->leftjoin('equipo_incidencia', 'problema.id', '=', 'equipo_incidencia.id_problema')
    //                 ->join('users','users.id','=','problema.id_usuario')
    //                 ->orderBy('problema.id','desc')
    //                 ->get();
    
            //  $data=DB::table('categoria_tienda')
            //             ->select('incidencia_preventivos.id','tiendas.nombre as tienda','empresas.nombre as empresa','incidencia_preventivos.codigo','incidencia_preventivos.estado','categorias.descripcion as partida')
            //             ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
            //             ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
            //             ->join('empresas','empresas.id','=','tiendas.id_empresa')
            //             ->join('detalle_incidencia_preventivo','categoria_tienda.id','=','detalle_incidencia_preventivo.id_categoria_tienda')
            //             ->join('incidencia_preventivos','incidencia_preventivos.id','=','detalle_incidencia_preventivo.incidencia_preventivos')
            //             ->get();
            
            
           
            $data=DB::table('incidencia_preventivos')
                            ->select('*','incidencia_preventivos.id as idIncidenciaPreventivo')
                            ->join('tipo_incidencias','tipo_incidencias.id','=','incidencia_preventivos.id_tipo_incidencia')
                            ->get();
            $arrayPreventivo=[];
            foreach($data as $key => $value)
            {
                 
                 $arrayPreventivo[]=[

                        'idIncidenciaPreventivo' => $value->idIncidenciaPreventivo,
                        'description' => $value->description,
                        'codigo' => $value->codigo,
                        'fecha_incidencia' => $value->fecha_incidencia,
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
            
          
            return view('admin.preventivo.index',['data'=>$arrayPreventivo]); 
        }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          
        $max_codigo=DB::select(DB::raw('select * from problema where id = (select max(`id`) from problema)')); 
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
      
        $fechaA = Carbon::now('America/Lima');
        $date=$fechaA->format('Y-m-d');

        $empresa=DB::table('empresas')
                      ->select('id','nombre')
                      ->get();
        return view('admin.preventivo.create',['maxCodigo'=>$maxCodigo,'fecha'=>$date,'empresa'=>$empresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = Auth::user();
       
        $id_tienda = explode(",", $request->id_tienda);
       
       
			
        if($request->preventivo==1)
        {
            $max_codigo=DB::select(DB::raw('select * from problema where id = (select max(`id`) from problema)')); 
            $max;
                foreach($max_codigo as $data)
                {
                    $max=$data->codigo;
                }
        
                 DB::table('incidencia_preventivos')->insert(
                  [
                      'codigo'               => (int)($max)+1,
                      'fecha_incidencia'     => $request->fecharegistro,
                      'descripcion'          =>'',
                      'id_tipo_incidencia'   =>$request->id_incidencia,
                      'estado'               =>1,
                  ]);
           
             $id_incidencia=DB::select(DB::raw('select * from incidencia_preventivos where id = (select max(`id`) from incidencia_preventivos)')); 
             
             $id_inciden;
             foreach($id_incidencia as $incidencia)
             {
                 $id_inciden=$incidencia->id;
             }
	  
             for($i=0; $i<count($id_tienda); $i++)
             {
                 
                  DB::table('detalle_incidencia_preventivo')->insert(
                  [
                      
                      'incidencia_preventivos'  => $id_inciden,
                      'id_categoria_tienda'     => $id_tienda[$i],
                  ]);
             }
    
             
              return redirect('/ordenServicio');
           
        }else
        {
             
              
              DB::table('problema')->insert(
              [
                  'codigo' => $request->codigo,
                  'problema' => $request->problema,
                  'fecharegistro' => $request->fecharegistro,
                  'id_usuario'=>$user->id,
                  'id_equipo'=>$request->id_equipo,
                  'estado'=>0,
              ]);

            Flash::success('Se guardó correctamente su problema.');
            return redirect('/listarproblemas');

        }
        
       
    }
    
    public function storeImagen(Request $request)
            {
                
               
                
                $file = $request->file('file');
                $path =public_path().'/admin/problema';
        
                $fileName = uniqid() . $file->getClientOriginalName();
        
                $file->move($path, $fileName);
        
               
        
                 DB::table('imagen_problema')->insert([
                    'id_problema' => $request->id,
                    'url' => '/admin/problema'.'/'.$fileName
                
                ]);
                
             
                	
              
             
            } 
    public function ordenServicioCreate(Request $request)
    {

        // $user = Auth::user();

        // DB::table('orden_servicio')->insert(
        //         [

        //         'codigo' => $request->codigo, 
        //         'prioridad' => $request->prioridad,
        //         'id_incidencia' =>$request->id_incidencia,
        //         'id_tipo_mantenimiento' => $request->id_tipo_mantenimiento,
        //         'estado' => $request->estado,
        //         'fecha' => $request->fecha,
        //         'descripcion'=>$request->descripcion,
        //         'id_usuario'=>$user->id,
        //         'id_usuario_supervisor'=>$request->id_usuario_supervisor
        //         ]
        //     );
        
        //     DB::table('equipo_incidencia')
        //     	->where('id', '=', $request->id_incidencia)
        //     	->update([
        //     		'estado' => 'proceso',
        //     	]);
       
        // $id=DB::table('orden_servicio')->max('id'); 

        // return response(['id' => $id]);
    }

    public function BuscarOrdenServicios(Request $request)
    {

        $codigo=$request->codigo;

        $resultado=DB::table('orden_servicio')
                                ->select('orden_servicio.id','orden_servicio.estado','orden_servicio.fecha','orden_servicio.descripcion','orden_servicio.codigo', 'orden_servicio.codigo','orden_servicio.prioridad','equipo_incidencia.id as idIncidencia','equipo_incidencia.descripcion as incidenciaDes','tipo_mantenimientos.id as idMante','tipo_mantenimientos.descripcion as manteDes','orden_servicio.id_usuario_supervisor as id_usuario_supervisor')
                                ->join('tipo_mantenimientos', 'tipo_mantenimientos.id', '=', 'orden_servicio.id_tipo_mantenimiento')
                                ->join('equipo_incidencia', 'equipo_incidencia.id', '=', 'orden_servicio.id_incidencia')
                                ->join('users', 'users.id', '=', 'orden_servicio.id_usuario')
                                ->where('orden_servicio.codigo', $codigo)->get();

         return response(['data' => $resultado]);
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
    
    public function pdflistarproblemas()
    {
        
        $listar=DB::table('problema')
        ->select('problema.codigo','problema.problema','problema.fecharegistro','users.name')
        ->join('users','users.id','=','problema.id_usuario')
        ->get();
        
        
        $pdf = PDF::loadView('admin.reportes.inicio.problemas',compact('listar'));
        return $pdf->stream('problemas.pdf');  
    }
    
    public function listarImagenes($id)
    {
        $data=DB::table('imagen_problema')
        ->select('*')
        ->where('id_problema','=',$id)
        ->get();
        
        return response()->json(['data'=>$data]);
    }
    
    public function EliminarImagenes_problema($id)
    {
            

            
            DB::table('imagen_problema')->where('id', '=', $id)->delete();
            
            return response()->json(['data' => "Correcto"]);

    }
    
    
    
    
}
