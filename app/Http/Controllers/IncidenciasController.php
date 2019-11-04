<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Flash;
use Barryvdh\DomPDF\Facade as PDF; 

class IncidenciasController extends Controller
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
      
            $data=DB::table('categoria_tienda')
                    ->select('tipo_equipos.descripcion as tipoequipo','tipo_incidencias.description as tipoincidencia','equipo_incidencia.id as idIncidencia','equipo.id as idEquipo','equipo.descripcion as descripcionEquipo','empresas.id as idEmpresa','empresas.nombre as nombreEmpresa','equipo_incidencia.id as idInsidencia','problema.problema as descripIncidencia','equipo_incidencia.fecha_incidencia','equipo_incidencia.codigo as codigoEquipoIncidencia','tipo_incidencias.id as idTipoInsicencia','tipo_incidencias.description as descriptionTipoInsicencia','equipo_incidencia.estado as estado_equipo_insidencia','tiendas.nombre as tienda','equipo.serie', 'equipo.modelo','areas.nombre as area')
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
                ->get();
                         
        return view('admin.incidencias.index',['data' =>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    
     
    public function create()
    {
        $fechaA = Carbon::now('America/Lima');
        $date=$fechaA->format('Y-m-d');
        
        $max_codigo=DB::select(DB::raw('select * from equipo_incidencia where id = (select max(`id`) from equipo_incidencia)')); 
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
        $codigo=(int)$max+1;
      
        return view('admin.incidencias.create',['date'=>$date,'codigo'=> $codigo]);
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
        $data=DB::table('orden_servicio')->where('id_incidencia', '=', $id)->get();
        if(count($data)>0)
        {
           Flash::warning('NO ES  POSIBLE ELIMIAR LA INCIDENCIA, ESTA ASOCIADO A UNA ORDEN.');   
           
        }else
        {
           
            DB::table('equipo_incidencia')->where('id', '=', $id)->delete();
            Flash::error('SE ELIMINO CORRECTAMENTE.');
        }
      
       return redirect()->back();
    }
    
    public function pdfListarIncidencias()
    {
          $listar=DB::table('equipo_incidencia')
            ->select('equipo_incidencia.descripcion','equipo.descripcion as nombreequipo','tipo_incidencias.description as incidencias')
            ->join('tipo_incidencias','tipo_incidencias.id','=','equipo_incidencia.id_incidencia')
            ->join('equipo','equipo.id','=','equipo_incidencia.id_equipo')
            ->get();

     dd($listar);
        $pdf = PDF::loadView('admin.reportes.inicio.inicidencias',compact('listar'));
        return $pdf->stream('historialcompleto.pdf');   
    }
}
