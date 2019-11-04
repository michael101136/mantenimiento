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
class ProblemaController extends Controller
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
        
      
        if(Auth::user()->privilege=='visitante')
        {
           
         $data=DB::table('categoria_tienda')
            ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'problema.id','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area')
            ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
            ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
            ->join('empresas','empresas.id','=','tiendas.id_empresa')
            ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
            ->join('marcas','marcas.id','=','equipo.id_marca')
            ->join('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
            ->leftjoin('areas','areas.id','=','equipo.id_area')
            ->join('problema', 'equipo.id', '=', 'problema.id_equipo')
            ->join('users','users.id','=','problema.id_usuario')
            ->where('problema.id_usuario',Auth::user()->id)
            ->orderBy('problema.id','desc')
            ->get();
          
     

            return view('admin.problema.index',['data'=>$data]);  
            

        }else
        {
          
          $data =DB::table('categoria_tienda')
                   ->select(DB::raw('CONCAT(tipo_equipos.descripcion, ", serie ", equipo.serie, ", marca ", marcas.descripcion) AS equipo'),'problema.id','problema.codigo','problema.problema','users.name','problema.fecharegistro','tiendas.nombre as tienda','empresas.nombre as empresa','areas.nombre as area')
                    ->join('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
                    ->join('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                     ->join('areas','areas.id','=','equipo.id_area')
                    ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->leftjoin('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
                    ->join('problema', 'equipo.id', '=', 'problema.id_equipo')
                    ->join('users','users.id','=','problema.id_usuario')
                    ->orderBy('problema.id','desc')
                ->get();
             
             
            return view('admin.problema.index',['data'=>$data]); 
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
      
        
        return view('admin.problema.create',['maxCodigo'=>$maxCodigo,'fecha'=>$date]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createProblemaRequest $request)
    {
         $user = Auth::user();

        if($request->preventivo==1)
        {
            DB::table('problema')->insert(
              [
                  
                  'codigo' => $request->codigo,
                  'problema' => $request->problema,
                  'fecharegistro' => $request->fecharegistro,
                  'id_usuario'=>$user->id,
                  'id_equipo'=>$request->id_equipo,
                  'estado'=>1,
                 
              ]);

            $id_problema=DB::table('problema')->max('id');

            $max_codigo=DB::table('equipo_incidencia')->max('codigo');
            //tabla equipo incidencia
             DB::table('equipo_incidencia')->insert(
                [

                'codigo' => (int)($max_codigo)+1, 
                'id_equipo' => '',
                'id_incidencia' =>'',
                'id_empresa' => '',
                'descripcion' => 'Sin incidencia',
                'fecha_incidencia' => $request->fecharegistro,
                'estado' => 'proceso',
                'id_problema' =>  $id_problema,  
                ]
            );
             
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
        
        // $listar=DB::table('problema')
        // ->select('problema.codigo','problema.problema','problema.fecharegistro','users.name','tipo_equipos.descripcion','empresas.nombre as nombreEmpresa','tiendas.nombre as nombreTienda')
        // ->leftjoin('equipo','equipo.id','=','problema.id_equipo')
        // ->join('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
        // ->join('marcas','marcas.id','=','equipo.id_marca')
        // ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
        // ->join('tiendas','tiendas.id','=','equipo.id_tienda')
        // ->join('empresas','empresas.id','=','tiendas.id_empresa')
        // ->join('users','users.id','=','problema.id_usuario')
        // ->get();
        
         $listar=db::table('problema')
                 ->select('problema.codigo','problema.problema','problema.fecharegistro','users.name','tipo_equipos.descripcion','empresas.nombre as nombreEmpresa','tiendas.nombre as nombreTienda')
                ->leftjoin('equipo','equipo.id','=','problema.id_equipo')
                ->join('equipo_incidencia','equipo_incidencia.id_problema','=','problema.id')
                ->join('marcas','marcas.id','=','equipo.id_marca')
                ->join('tipo_equipos','tipo_equipos.id','=','marcas.id_tipo_equipo')
                ->join('categoria_tienda','categoria_tienda.id','=','equipo.id_categoria_tienda')
                ->join('tiendas','tiendas.id','=','categoria_tienda.id_tienda')
                 ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                ->join('empresas','empresas.id','=','tiendas.id_empresa')
                ->leftjoin('areas','areas.id','=','equipo.id_area')
                ->join('users','users.id','=','problema.id_usuario')
                ->orderBy('equipo_incidencia.id', 'desc')
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
