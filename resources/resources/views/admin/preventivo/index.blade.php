@extends('admin.layout.master')
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
                        <a href="{{('/crearticket')}}" class="btn btn-success "><i class="fa fa-plus-circle"> NUEVOss   </i></a>
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
                    <table id="example" class="table table-striped table-bordered">
                      <thead style="background-color: #5A738E;color:#FFFFFF;">
                        <tr>
                    
                            <th>CODIGOs</th>
                            <th>DECRIPCION</th>
                            <th>FECHA</th>
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
                            <td><button type="button" class="btn btn-danger" onclick="imagen({{$value['idIncidenciaPreventivo']}})"><span class="glyphicon glyphicon-remove"></span></button></td>
                           
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
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">IMAGENES DEL PROBLEMA</h4>
                </div>
                <div class="modal-body">
                         {!! Form::open(['route' => 'problema.save','id'=>'dropzone','class'=>'dropzone']) !!}
                                  <input type="hidden"   name="id" id="id">
                        {!! Form::close() !!}
                        <button type="button" class="btn btn-success" id="btnUpload">GUARDAR IMAGEN</button>
                        
                <table class="table table-striped" id="tableImagenes">
                    <thead>
                      <tr>
                        <th>Imagen</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody id="sliderTabla">
                     
                     
                    </tbody>
                  </table>
                </div>
            
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
            dictDefaultMessage: "Arrastre las fotos del problema.",
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
        
      $('#btnUpload').on('click', function(e){

                myDropzone.processQueue();
              

        });
        
   function imagen(id)
   {
       $("#id").val(id);
       $('#myModal').modal('show');
       
        var htmlTours;
        var idMultimedia;
         $( "#sliderTabla" ).html('');
     $.ajax({
               url:'{{ route('listarImagenesProblema') }}/'+id,
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
   
   function eliminarImagem(id,trEliminar)
        {

                 $.ajax({
                             url:'{{ route('EliminarImagenes_problema') }}/'+id,
                             type: 'GET',
                             success: function(data) 
                             {
                                var i = trEliminar.parentNode.parentNode.rowIndex;
                                document.getElementById("tableImagenes").deleteRow(i);
                                 
                             }
                        });  
        }
   
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