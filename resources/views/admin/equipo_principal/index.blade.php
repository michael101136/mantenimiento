@extends('admin.layout.master')

@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>EQUIPOS<small></small></h3>
              </div>
            </div>
           

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                
                  @include('flash::message')
                <div class="x_panel">
                  <div class="x_title">
                  <a href="{{('/equipoPrincipal/create')}}" class="btn btn-success "><i class="fa fa-plus-circle"> NUEVO    </i></a>
                  <a href="{{('/pdfEquipo')}}" class="btn btn-success "><i class="fa fa-plus-circle"> REPORTE   </i></a>
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
                    <table id="example" class="table table-striped table-bordered table-responsive">
                      <thead style="background-color: #5A738E;color:#FFFFFF;">
                        <tr>
                          <!--<th>Nº</th>-->
                          <th>CÓDIGO</th>
                          <th>EMPRESA</th>
                          <th>TIENDA</th>
                          <th>PARTIDA</th>
                          <th>TIPO EQUIPO</th>
                          <th>SERIE</th>
                          <th>MODELO</th>
                          <th>MARCA</th>
                          <th>IMAGEN</th>
                          <th>ESTADO</th>
                          <th>ACCIÓN</th>
                        </tr>
                      </thead>
                      <tbody>
                   @foreach($data as $item)
                      <tr style="text-transform: uppercase;">
                      <!--<td>{{ $item->id}}</td>-->
                        <td>{{ $item->idequipo}}</td>
                          <td>{{ $item->empresa}}</td>
                       <td>{{ $item->tienda}}</td>
                       <td>{{ $item->desPartida}}</td>
                        <td>{{$item->descripcionTipoEquipo}}</td>
                          <td>{{ $item->serie}}</td>
                       <td>{{ $item->modelo}}</td>
                            <td>{{ $item->descripcionMarca}}</td>
                      
                        <!--<td></td>-->
                      
                        
                         <td>
                           <img src="/laravel/public{{ $item->url}}" style="height: 60px;">
                            
                        </td>
                        <td>
                            @if($item->estado_equipo=='Inicio')
                                <button type="button" class="btn btn-round btn-danger">Inicio</button>
                            @else
                                <button type="button" class="btn btn-round btn-warning">Proceso</button>
                            @endif
                            
                        </td>
                        <td>
                           {!! Form::open(['route' => ['equipoPrincipal.destroy', $item->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <!--<a href="{!! route('equipoPrincipal.edit', [$item->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>-->
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Esta seguro de eliminar?')"]) !!}
                            </div>
                        {!! Form::close() !!}

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