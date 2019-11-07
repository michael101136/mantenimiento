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

    
    
    
    public function EliminarPreventivo($id)
    {
            

            DB::table('detalle_incidencia_preventivo')->where('incidencia_preventivos', '=', $id)->delete();    
            DB::table('incidencia_preventivos')->where('id', '=', $id)->delete();
            
            return response()->json(['data' => "Correcto"]);

    }
    
    
    
    
}
