@extends('admin.layout.master')


@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3>ORDEN DE SERVICIOS PREVENTIVO <small></small></h3>
              </div>
            </div>
           

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                       <a class="btn btn-success" href="{{ url('ordenServicio') }}">Orden de servicio</a>
                </div>
                 
                <div class="x_panel">
                  <div class="x_title">
                        <a href="{{('/ordenServicio/create')}}" class="btn btn-success "><i class="fa fa-plus-circle"> NUEVO   </i></a>
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
                    
                            <th>CODIGO</th>
                            <th>DECRIPCION</th>
                            <th>FECHA</th>
                            <th>PRIORIDAD</th>
                            <th>SUPERVISOR</th>
                            <th>ESTADO</th>
                            <th>ACCION</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                        @foreach($data as $key => $value)
                        <tr style="text-transform: uppercase;">
                             <td>{{$value['codigo']}}</td>
                             <td>
                                 {{$value['description']}}
                                 DETALLE:
                                   @foreach($value['detalle'] as $key => $values)<br>
                                        <hr>
                                        <strong>EMPRESA</strong>:{{$values->empresa}}<br>
                                        <strong>TIENDA</strong>:{{$values->tienda}}<br>
                                        <strong>PARTIDA</strong>:{{$values->partida}}
                                   @endforeach
                             </td>
                             <td>{{$value['fecha_incidencia']}}</td>
                             <td>{{$value['orden_prioridad']}}</td>
                             <td>{{$value['nombreSupervisor']}}</td>
                             <td>
                               @if($value['estado_prioridad']=='proceso')
                                         <button type="button" class="btn btn-round btn-warning">Proceso</button>
                                    @else
                                         <button type="button" class="btn btn-round btn-success">Pendiente</button>
                                    @endif
                             
                             </td>
                            <td>
                              <button type="button" class="btn btn-danger" onclick="imagen({{$value['idIncidenciaPreventivo']}})">
                                <span class="glyphicon glyphicon-remove"></span>
                              </button></td>
                           
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
       "order": [[ 0, "desc" ]],
         "language": {
                      "url": "{{ url('admin/idioma/spanish.json') }}"
                    },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      } );
    } );
  </script>
@endsection