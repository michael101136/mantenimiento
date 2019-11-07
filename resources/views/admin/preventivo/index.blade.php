@extends('admin.layout.master')

</style>
<style type="text/css">
                .dropzone {
                    border:2px dashed #999999;
                    border-radius: 10px;
                }
                .dropzone .dz-default.dz-message {
                    height: 171px;
                    background-size: 132px 132px;
                    margin-top: -101.5px;
                    background-position-x:center;

                }
                .dropzone .dz-default.dz-message span {
                    display: block;
                    margin-top: 145px;
                    font-size: 20px;
                    text-align: center;
                }
            </style>
              
        </div>
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3>MANTENIMIENTO PREVENTIVO <small></small></h3>
              </div>
            </div>
           

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                
                 
                <div class="x_panel">
                  <div class="x_title">
                        <a href="{{('/crearticket')}}" class="btn btn-success "><i class="fa fa-plus-circle"> NUEVO   </i></a>
                        <a href="{{('/pdfProblemas')}}" class="btn btn-success "><i class="fa fa-plus-circle"> REPORTE   </i></a>
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
                    <table id="tabla_preventivo" class="table table-striped table-bordered">
                      <thead style="background-color: #5A738E;color:#FFFFFF;">
                        <tr>
                            <th>DECRIPCION</th>
                            <th>FECHA</th>
                            <th>ACCION</th>
        
                        </tr>
                      </thead>
                      <tbody>
                       
                        @foreach($data as $key => $value)
                        <tr style="text-transform: uppercase;">
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
                            <td>
                              <button type="button" class="btn btn-danger" onclick="eliminarPreventivo({{$value['idIncidenciaPreventivo']}},this)"><span class="glyphicon glyphicon-trash"></span></button>
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
   function eliminarPreventivo(id,t)
   {
       
      var bool=confirm("Seguro de eliminar el dato?");
        if(bool){
                 $.ajax({
                   url:'{{ route('EliminarPreventivo') }}/'+id,
                   type: 'GET',
                   success: function(data) 
                   {
                      var i = t.parentNode.parentNode.rowIndex;
                      document.getElementById("tabla_preventivo").deleteRow(i);
                       Swal.fire({
                                      position: 'top-end',
                                      type: 'success',
                                      title: 'Se elimino correctamente',
                                      showConfirmButton: false,
                                      timer: 1500
                                   })
                       
                   }
              });  
        }

   }
  
  </script>
@endsection