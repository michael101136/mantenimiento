<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Flash;
use Illuminate\Support\Facades\Auth;
use App\Helpers\publicFunction;
class EquipoPrincipal extends Controller
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
        
      
   
        if(Auth::user()->privilege =='tecnico')
        {
            
            return redirect('programarOrdenServicio');
            
        }
        if(Auth::user()->privilege =='visitante')
        {
            
            return redirect('seguimiento');
            
        }
        
        $data=DB::table('categoria_tienda')
                   ->select('equipo.id', 'equipo.idequipo','equipo.url', 'equipo.modelo','equipo.descripcion','marcas.descripcion as descripcionMarca','tiendas.nombre as tienda','equipo.estado_equipo','tipo_equipos.descripcion as descripcionTipoEquipo','equipo.serie','empresas.nombre as empresa','categorias.descripcion as desPartida')
                    ->join('ubigeo_tienda','ubigeo_tienda.id','=','categoria_tienda.id_tienda')
                    ->join('equipo','categoria_tienda.id','=','equipo.id_categoria_tienda')
                    ->join('tiendas','tiendas.id','=','ubigeo_tienda.id_tienda')
                    ->join('categorias','categorias.id','=','categoria_tienda.id_categoria')
                    ->join('empresas','empresas.id','=','tiendas.id_empresa')
                    ->join('marcas','marcas.id','=','equipo.id_marca')
                    ->leftjoin('tipo_equipos', 'tipo_equipos.id', '=', 'marcas.id_tipo_equipo')
                ->get();
        
      

        return view('admin.equipo_principal.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $maxidEquipo=publicFunction::maxCodigo('equipo');
     
        return view('admin.equipo_principal.create',['max'=>$maxidEquipo]);
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
        
        $data=DB::table('equipo_incidencia')->where('id_equipo', '=', $id)->get();
        
        if(count($data)>0)
        {
           Flash::warning('NO ES  POSIBLE ELIMIAR EL EQUIPO, ESTA ASOCIADO A UNA INCIDENCIA.');   
           
        }else
        {
            DB::table('equipo')->where('id', '=', $id)->delete();
            Flash::error('El equipo de elimino correctamente.');
        }
      
        
        return redirect()->back();
    }
}
