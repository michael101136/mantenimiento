@extends('admin.layout.master')

@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3>SEGUIMIENTO <small></small></h3>
              </div>
            </div>
           

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                
                 
                <div class="x_panel">
                  <div class="x_title">
                       
                        <a href="{{('/pdfSeguimiento')}}" class="btn btn-success "><i class="fa fa-plus-circle"> REPORTE   </i></a>
                    <h2><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @include('flash::message')
                  <div class="table-responsive">  
                    <table id="example" class="table table-striped table-bordered">
                      <thead style="background-color: #5A738E;color:#FFFFFF;">
                        <tr>
                    <th>ID</th>
                            <th>CODIGO</th>
                            <th>EMPRESA</th>
                            <th>TIENDA</th>
                                <th>ÁREA</th>
                            <th>CLIENTE</th>
                            <th>EQUIPO</th>
                            <th>PROBLEMA</th>
                            <th>FECHA REGISTRO</th>
                            <th>ESTADO</th>
                         <th></th>
               
                   
                        </tr>
                      </thead>
                      <tbody>
                       
                        @foreach($data as $item)
                        <tr style="text-transform: uppercase;">
                             <td>{{$item->idproblema}}</td>
                            
                            <td>{{$item->codigo}}</td>
                            <td>{{$item->empresa}}</td>
                            <td>{{$item->tienda}}</td>
                            <td>{{$item->area}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->equipo}}</td>
                            <td>{{$item->problema}}</td>
                            <td>{{$item->fecharegistro}}</td>
                            <td>
                                 @if($item->estadoIncidencia==null)
                                    <button type="button" class="btn btn-round btn-danger" style="text-transform: uppercase;"> {{$item->estado_equipo}}</button>
                                 @else
                                    @if($item->avance==null)
                                         <button type="button" class="btn btn-round  btn-info" style="text-transform: uppercase;"> {{$item->estadoIncidencia}}</button>
                                    @else
                                          <button type="button" class="btn btn-round btn-success" style="text-transform: uppercase;"> Finlizado</button>
                                    @endif
                                 @endif
                            
                            </td>
                          <td> 
                                 @if($item->estadoIncidencia==null)
                                      <a href="{{route('detalleSeguimiento',$item->idproblema)}}" class="btn btn-default btn-xs btn-primary" target="_blank"><i class="fa fa-file-pdf-o"> </i></a>
                                 @else
                                    @if($item->avance==null)
                                         <a href="{{route('detalleSeguimientoProceso',$item->idproblema)}}" class="btn btn-default btn-xs btn-danger" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                    @else
                                            <a href="{{route('detalleSeguimientoFin',$item->idproblema)}}" class="btn btn-default btn-xs btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                    @endif
                                 @endif
                                 
                       
                         
                        
                          
                          
                          </td>
                           
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>

@endsection


@section('script')
   <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      } );
    } );
  </script>
@endsection