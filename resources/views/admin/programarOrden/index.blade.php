@extends('admin.layout.master')

@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              <h3>PROGRAMAR ORDEN DE SERVICIO <small></small></h3>
              </div>
            </div>
           

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                
                 
                <div class="x_panel">
                  <div class="x_title">
                       @if(auth()->user()->hasRoles(['admin','supervisor']))
                  <a href="{{('/programarOrdenServicio/create')}}" class="btn btn-success "><i class="fa fa-plus-circle"> NUEVO    </i></a>
                  @endif
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
                  <div id="cargar"></div>
                    <table id="example" class="table table-striped table-bordered">
                      <thead style="background-color: #5A738E;color:#FFFFFF;">
                        <tr>
                          <!--<th>Nº</th>-->
                          <th>Codigo</th>
                          <th>Nombre</th>
                         
                          <th  class="col-sm-4">Fecha</th>
                          <th>Descripción</th>
                           <th>Avance</th>
                          <th>Orden</th>
                            @if(auth()->user()->hasRoles(['admin','supervisor']))
                                <th>Estado</th>
                          @endif
                          <th>IMAGEN</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($data as $item)
                            <tr>
                                <!--<td>{{ $item->id}}</td>-->
                                <td>{{ $item->codigo}}</td>
                                <td>
                                  @foreach($users as $iten)
                                    
                                    @if($iten->id==$item->id_users)
                                       {{ $iten->privilege}} <br>{{ $iten->name}}
                                    @endif

                                  @endforeach
                                </td>
                                <td>
                                    Tiempo Total: {{ $item->diaestimado}} Dias : {{ $item->tiempoestimado}} Horas<br>
                                    Fecha Inicio:  {{ $item->fechainicio}}<br>
                                    Fecha Fin : {{ $item->fechafin}}<br>
                                    Hora: {{ $item->hora_inicio}} {{ $item->hora_marcada_inicio}}  - {{ $item->hora_fin}} {{ $item->hora_marcada_fin}}
                                </td>                          
                                <td>{{ $item->desProgramacion}}</td>
                                <td>
                                    
                                   
                                      <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                      aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                         {{$item->avance}} %
                                      </div>
                                 
                                   
                                </td>
                                <td>{{ $item->descrOrden}}</td>
                                
                                @if(auth()->user()->hasRoles(['admin','supervisor']))
                                    <td>
                                        @if($item->estado=='1')
                                             <button type="button" id="accionEstado{{$item->id }}" name="accionEstado" onClick="accionEstado({{ $item->id }},this.id);" class="btn btn-warning"><div>Proceso</div></button>
                                        @else
                                             <button type="button" class="btn btn-success">Terminado</button>
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <button type="button" class="btn btn-success" onclick="imagen({{$item->id}})"><span class="glyphicon glyphicon-camera"></span></button></td>
                                <td>
                                
                                    <div class='btn-group'>
                                       
                                        <a href="#" id="accion{{$item->id }}" onClick="accionAvance({{ $item->id }},this.id);" class='btn btn-default btn-xs'>Avance</a>
                                    </div>
                                  
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
          
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">IMAGENES DEL TRABAJO FINAL</h4>
                </div>
                <div class="modal-body">
                         {!! Form::open(['route' => 'programacion.save','id'=>'dropzone','class'=>'dropzone']) !!}
                                  <input type="hidden"   name="id" id="id">
                        {!! Form::close() !!}
                        <button type="button" class="btn btn-success" id="btnUpload">GUARDAR IMAGEN</button>
                        
                <table class="table table-striped" id="tableImagenes">
                    <thead>
                      <tr>
                        <th>IMAGEN</th>
                        <th>ACCIÓN</th>
                      </tr>
                    </thead>
                    <tbody id="sliderTabla">
                     
                     
                     </tbody>
                  </table>
                </div>
            
              </div>
              
            </div>
          </div>
        </div>

        <div class="modal fade" id="avanceModal" role="dialog">
            <div class="modal-dialog modal-lg">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">AVANCE DE ACTIVIDAD</h4>
                </div>
                <div class="modal-body">
                 
                 <form class="form-horizontal" id="form_avance">
                     {{ csrf_field() }}
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="email">Pocentaje:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="porcentaje" placeholder="porcentaje " name="porcentaje">
                           <input type="hidden" class="form-control"  id="id_personal_programacion"  name="id_personal_programacion">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="pwd">Descripción:</label>
                          <div class="col-sm-10">          
                            
                            <textarea id="descripcion" required="required" class="form-control" name="descripcion"></textarea>
                            
                          </div>
                        </div>
                        
                        <div class="form-group">        
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Guardar</button>
                          </div>
                        </div>
                      </form>
                 
                  <table id="inicioDatable" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Descripción</th>
                          <th>Fecha</th> 
                          <th>Avance</th> 
                        </tr>
                      </thead>
                      <tbody id="tableListar" name="tableListar">
                       
                        
                      </tbody>
                    </table>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
              
      </div>

        

@endsection


@section('script')
   <script>
   
    Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#dropzone', {
            paramName: 'file',
            maxFilesize: 20, // MB
            autoProcessQueue: false,
            maxFiles: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
            addRemoveLinks: true,
            dictRemoveFile: 'Remover foto',
            dictDefaultMessage: "Arrastre las imagenes del trabajo.",
            init: function() {
                this.on("success", function(file, response) {
                    var a = document.createElement('span');
                    a.className = "thumb-url btn btn-primary";
                    a.innerHTML = "copy url";
                    file.previewTemplate.appendChild(a);
                });
                 this.on("queuecomplete", function() { 
                   this.options.autoProcessQueue = false; 
                   window.setTimeout('location.reload()', 3000);
                  }); 

                  this.on("processing", function() { 
                   this.options.autoProcessQueue = true; 
                   
                  }); 


            }
        });
        
function imagen(id)
   {
       $("#id").val(id);
       $('#myModal').modal('show');
       
       
       var htmlTours;
        var idMultimedia;
         $( "#sliderTabla" ).html('');
     $.ajax({
               url:'{{ route('listarImagenesProgramacion') }}/'+id,
                   type: 'GET',
               success: function(data) 
               {

                 $.each(data.data,function(index,element)
                    { 
                       htmlTours=htmlTours + "<tr>"+ 
                                                 "<td>  <img  style='height: 50px;' src='/laravel/public"+element.url+"'> </td>"+
                                                 "<td> <a  onclick='eliminarImagem("+element.id+",this)' class='btn btn-danger btn-ls'> <i class='fa fa-trash'></i></a>"+  
                                             "</td>"+
                                             "<tr>";
                        idMultimedia =element.multimedia_id;
                    });

                   $("#idMultimedia").val(id);

                   $("#sliderTabla").append(htmlTours);

               }
            });
      
                      
       
   }

      $('#btnUpload').on('click', function(e){

                myDropzone.processQueue();
              

        });
        
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
    function accionEstado(id,event)
    {
       
      $('#cargar').html('<div class="preloader"></div>');
       
           $.ajax({                        
                    url:'{{ route('cambiarProgramacion_user_Estado') }}',
                     type: 'POST',           
                      data:{
                        "_token": "{{ csrf_token() }}",
                         "id":id,
                    },
                    success: function(data)             
                    {
                         $('#cargar').html('');
                         $('#'+event).removeClass('btn-warning');
                         $('#'+event).addClass('btn btn-success');
                         $('#'+event).text("Terminado");
                    }
                          
                        
              });
 
    }
      
    function accionAvance(id,event)
    {
            $('#avanceModal').modal('show'); // abrir
            $("#id_personal_programacion").val(id);
             var htmlListar;
            $("#tableListar").html('');
             $.ajax({                        
                            url:'{{ route('Programacion_avance_listar_user') }}',
                            type: 'POST',           
                            data:{
                                    "_token": "{{ csrf_token() }}",
                                     "id_personal_programacion":id,
                                },
                            success: function(respuesta)             
                            {
                               
                             $.each(respuesta.data,function(index,element)
	                            { 
	                              htmlListar=htmlListar + "<tr>"+ 
	                                                      "<td>"+element.descripcion+" </td>"+
	                                                      "<td>"+element.fecha+"</td>"+
	                                                      "<td>"+
    	                                                      "<div class='progress'>"+
                                                                    "<div class='progress-bar bg-green' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width:100%;'>"+
                                                                    "</div>"+
                                                                "</div>"+element.porcentaje+" % "+
                                                                
	                                                      "</td>"+
	                                                    "</tr>";
	                            });
	                            $("#tableListar").html(htmlListar);
                              
                            }
                  });
    }
    
    function eliminarImagem(id,trEliminar)
        {

                 $.ajax({
                             url:'{{ route('EliminarImagenes_programacion') }}/'+id,
                             type: 'GET',
                             success: function(data) 
                             {
                                var i = trEliminar.parentNode.parentNode.rowIndex;
                                document.getElementById("tableImagenes").deleteRow(i);
                                 
                             }
                        });  
        }
  
      
    $(function() 
    {
  
     $('#form_avance').bootstrapValidator({
            container: '#messages',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
             submitHandler: function(validator, form, submitButton) {
                  $('#cargar').html('<div class="preloader"></div>');
                   $.ajax({                        
                            url:'{{ route('Programacion_avance') }}',
                             type: 'POST',           
                            data: $("#form_avance").serialize(), 
                            success: function(data)             
                            {
                                $('#cargar').html('');
                                    Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Se registro correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                 })
                              location.reload();
                              
                            }
                  });
                  
                   
            },
            fields: {
                porcentaje: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere codigo'
                        },
                       regexp: {
               
                         regexp: /^[0-9]+$/,
               
                         message: 'Solo se puede ingresar número'
               
                       }
                    }
                },
                
                 descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere descripcion'
                        }
                    }
                }
              
              
            }
        });
 });
    
    
  </script>
@endsection