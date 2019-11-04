@extends('admin.layout.master')

@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3>ORDEN DE SERVICIO <small></small></h3>
              </div>
            </div>
           

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                
                  <div class="form-group">
                        <a class="btn btn-success" href="{{ url('ordenPreventivo') }}">Orden preventivo</a>
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
                    <div class="table-responsive"> 
                        <table id="example" class="table table-striped table-bordered">
                      <thead style="background-color: #5A738E;color:#FFFFFF; text-transform: uppercase;">
                        <tr>
                          <!--<th>Nº</th>-->
                          <th>Codigo</th>
                          <th>Empresa</th>
                          <th>Tienda</th>
                          <th>Equipo</th>
                          <th>Tipo incidencia</th>
                          <th>Problema</th>
                         
                          <th>Prioridad</th>
                          <th>Supervisor</th>
                      
                          <th>Estado</th>
                   
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($data as $item)
                            <tr style="text-transform: uppercase;">
                                <!--<td> {{$item->id}}</td>-->
                                <td> {{$item->codigo}}</td>
                                <td>{{$item->nombreEmpresa}}</td>
                                <td>{{$item->tienda}}</td>
                                <td>{{$item->tipoequipo}}</td>
                                 <td>{{$item->tipoincidencia}}</td>
                                <td>{{$item->problema}}</td>
                                <td>{{$item->prioridad}}</td>
                                <td>
                                    @foreach($usuarios as $itemp)

                                        @if($itemp->id==$item->id_usuario_supervisor)

                                             {{$itemp->name}}

                                        @endif

                                    @endforeach
                                   

                                </td>                          
                              
                                <td>
                                     
                                    @if($item->estado=='proceso')
                                         <button type="button" class="btn btn-round btn-warning">Proceso</button>
                                    @else
                                         <button type="button" class="btn btn-round btn-success">Pendiente</button>
                                    @endif
                                </td> 
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