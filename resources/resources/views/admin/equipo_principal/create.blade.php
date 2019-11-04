
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
 <section class="content-header">

	<div class="form-group">
		  <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name"> 
		  	BUSCAR POR CÓDIGO
	      </label>
      
		   <div class="col-md-3 col-sm-3 col-xs-6">
		   
		     <input type="text" class="form-control"  id="codigoBuscar" placeholder="INGRESE CODIGO DE EQUIPO">
		  <br>
		  </div>
          <div class="col-md-3 col-sm-3 col-xs-6">
           
             <button class="btn btn-success" id="BuscarEquipo"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
          <br>
          </div>
	</div>
    </section>
		
          <div class="">
 					
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  @include('flash::message')
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

                       REGISTRAR EQUIPO 
                   
                  </div>
                  <div class="x_content">

                  	 

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">PRINCIPAL</a>
                        </li>
                        

                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
							 <div class="panel panel-info">
                                                <div class="panel-heading">SUBIR IMAGEN DE EQUIPO</div>
                                                <div class="panel-body">
                                                    
                                                   
                                                         {!! Form::open(['route' => 'equipo.save','id'=>'dropzone','class'=>'dropzone']) !!}
                                                              
                                                           {!! Form::close() !!}
                            
                                                </div>
                                                <div style="text-align: center;">
                                                    
                                                </div><br>
                                           
                                </div>
 					 	        	@include('admin.equipo_principal.registrar')
		                      
                        </div>
                        
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <p>2</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p> 3</p>
                        </div>
                    </div>
                    </div>

                    </div>

                </div>
              </div>

            </div>
          </div>
        </div>

@endsection



<div class="modal fade" id="tipoEquipo" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR TIPO EQUIPO</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="Listar_Tipo_Equipo">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                              </tr>
                          </thead>
                        </table>
                    </div>

                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="ModalArea" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR ÁREAS</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" style="text-transform: uppercase;" id="tabla_area">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                              </tr>
                          </thead>
                        </table>
                    </div>

                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
<div class="modal fade" id="Modalmarca" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR MARCAS</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" style="text-transform: uppercase;" id="tabla_marca">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                              </tr>
                          </thead>
                        </table>
                    </div>

                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="Modaltienda" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR TIENDA</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="tabla_tienda">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>EMPRESA</th>
                                <th>TIENDA</th>
                                <th>PARTIDA</th>
                                <th>UBICACIÓN</th>
                              </tr>
                          </thead>
                        </table>
                    </div>

                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="ModalUnidad" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR UNIDAD DE MEDIDA</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="tabla_unidad">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>UNIDAD</th>
                              </tr>
                          </thead>
                        </table>
                    </div>

                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@section('script')



  
<script>

//   Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#dropzone', {
            paramName: 'file',
            maxFilesize: 20, // MB
            autoProcessQueue: false,
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
            addRemoveLinks: true,
            dictRemoveFile: 'Remover foto',
            dictDefaultMessage: "Arrastre la fotos del equipo.",
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
        
$('#btnActualizar').attr("disabled", true);

function busquedaFunction(titulo,opcion) {
 	
    $('#busquedaTitulo').html(titulo);

    var opcion;
    var  trValue;
    if(opcion=='1')
    {
      opcion=1;
      var url='{{ route('listarEquipoCategoria') }}';
    }
    if(opcion=='2')
    {
      opcion=2;
      var url='{{ route('listarMarcas') }}';
    }
    if(opcion=='3')
    {
      opcion=3;
      var url='{{ route('listarTipos') }}';
     
    }
    if(opcion=='4')
    {
      opcion=4;
      var url='{{ route('listarPaises') }}';
    }
    if(opcion=='5')
    {
      opcion=5;
      var url='{{ route('listarEmpresas') }}';
    }
    
    var htmlListar;
    $("#tableListar").html('');
    $.ajax({
                 url:url,
                 type: 'POST',
                 data:{
                        "_token": "{{ csrf_token() }}",
                         "abbr":opcion,
                    },
                 dataType: 'JSON',
                  success: function(respuesta) {
                 

	                     if(opcion=='1')
	                     {
	 						
	 						$.each(respuesta.data,function(index,element)
	                            { 
	                              htmlListar=htmlListar + "<tr value='"+element.id+"'>"+ 
	                                                      "<td id='codigo'>"+element.codigo+" </td>"+
	                                                      "<td class='boton' style='cursor:pointer;'>"+element.descripcion+"</td>"+
	                                                    "</tr>";
	                            });

	                            $("#tableListar").html(htmlListar);
	                      
	                	 }

	                	 if(opcion=='2')
	                     {
	 						
	 						$.each(respuesta.data,function(index,element)
	                            { 
	                              htmlListar=htmlListar + "<tr value='"+element.id+"'>"+ 
	                                                      "<td id='codigo'>"+element.codigo+" </td>"+
	                                                      "<td class='boton' style='cursor:pointer;'>"+element.descripcion+"</td>"+
	                                                    "</tr>";
	                            });

	                            $("#tableListar").html(htmlListar);
	                      
	                	 }

						 if(opcion=='3')
		                	 {
		 						
		 					
		 						$.each(respuesta.data,function(index,element)
		                            { 
		                              htmlListar=htmlListar + "<tr value='"+element.id+"'>"+ 
		                                                      "<td id='codigo'>"+element.codigo+" </td>"+
		                                                      "<td class='boton' style='cursor:pointer;'>"+element.descripcion+"</td>"+
		                                                    "</tr>";
		                            });

		                            $("#tableListar").html(htmlListar);
		                      
		                	 }

		                    if(opcion=='4')
		                    {
		                        $.each(respuesta.data,function(index,element)
		                            { 
		                              htmlListar=htmlListar + "<tr value='"+element.id+"'>"+ 
		                                                      "<td id='codigo'>"+element.id+" </td>"+
		                                                      "<td class='boton' style='cursor:pointer;'>"+element.nombre+"</td>"+
		                                                    "</tr>";
		                            });

		                            $("#tableListar").html(htmlListar);
		                    }

		                    if(opcion=='5')
		                    {
		                        $.each(respuesta.data,function(index,element)
		                            { 
		                              htmlListar=htmlListar + "<tr value='"+element.id+"'>"+ 
		                                                      "<td id='codigo'>"+element.nombre+" </td>"+
		                                                      "<td class='boton' style='cursor:pointer;'>"+element.nombre+"</td>"+
		                                                    "</tr>";
		                            });

		                            $("#tableListar").html(htmlListar);
		                    }



	                	 $('#Busquedas').modal('show');


                    }
              });


             $(".table").on('click','tr',function(e){
                    e.preventDefault();
                    var trValue= $(this).attr('value');
                    var name= $(this).find("td:last-child").text();


                    if(opcion=='1')
                    {
                      
                      opcion=0;
                      $('#id_equipo_padre').val(trValue);
                      $('#equipo_padre').val(name);
                        
                    }
                    if(opcion=='2')
                    {
                      opcion=0;
                      
                      $('#id_marca').val(trValue);
                      $('#marca').val(name);
              
                    }
                    if(opcion=='3')
                    {
                     
                      opcion=0;
                      $('#id_tipo').val(trValue);
                      $('#tipo').val(name);
                   
                    }
                    if(opcion=='4')
                    {
                      opcion=0;
                      $('#id_ubicacion').val(trValue);
                      $('#ubicacion').val(name);
                    
                    }
                    if(opcion=='5')
                    {
                      opcion=0;
                      $('#id_empresa').val(trValue);
                      $('#empresa').val(name);
                    
                    }

                      $('#Busquedas').modal('hide');
                  
                }); 
      }
$(function() 
{

   $("#listarTipoEquipo").click(function()
        {
             
              $('#tipoEquipo').modal('show');
                var table=$('#Listar_Tipo_Equipo').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ route('listarEquipoCategoria') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'idequipo' },
                                { data: 'descripcion', name: 'descripcion' },
                             ]
                             
                    });
                    
                $('#Listar_Tipo_Equipo tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_equipo_padre").val(data['id']);
                    $("#equipo_padre").val(data['descripcion']);
                    
                $('#tipoEquipo').modal('hide');  
                } );
                                        
        });
        
        
        
         $("#listarArea").click(function()
        {
             
              $('#ModalArea').modal('show');
                var table=$('#tabla_area').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ route('area_listar') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'idequipo' },
                                { data: 'nombre', name: 'nombre' },
                             ]
                             
                    });
                    
                $('#tabla_area tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_area").val(data['id']);
                    $("#area").val(data['nombre']);
                    
                     $('#ModalArea').modal('hide');  
                } );
                                        
        });
        
         $("#listarUnidad").click(function()
        {
             
              $('#ModalUnidad').modal('show');
                var table=$('#tabla_unidad').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ route('unidad_listar') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'description', name: 'description' },
                             ]
                             
                    });
                    
                $('#tabla_unidad tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_unidad").val(data['id']);
                    $("#umedimens").val(data['description']);
                    
                $('#ModalUnidad').modal('hide');    
                } );
                                        
        });
    $("#listarMarca").click(function()
        {
            
             var id=$("#id_equipo_padre").val();
        
              $('#Modalmarca').modal('show');
                var table=$('#tabla_marca').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ route('listarMarcas') }}/"+id,
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'idequipo' },
                                { data: 'descripcion', name: 'descripcion' },
                             ]
                             
                    });
                    
                $('#tabla_marca tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    
                    $("#id_marca").val(data['id']);
                    $("#marca").val(data['descripcion']);
                    
                     $('#Modalmarca').modal('hide'); 
                } );
                                        
        });
        
            $("#id_tiendas").click(function()
        {
            
              $('#Modaltienda').modal('show');
                var table=$('#tabla_tienda').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('listarTiendasPartidad') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'nombreEmpresa', name: 'nombreEmpresa' },
                                { data: 'nombre', name: 'nombre' },
                                { data: 'descripcion', name: 'descripcion' },
                                { data: 'ubigeo', name: 'ubigeo' },
                                
                             ]
                             
                    });
                    
                $('#tabla_tienda tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_tienda").val(data['id']);
                    $("#tienda").val(data['nombre']);
                    
                      $('#Modaltienda').modal('hide');
                } );
                                        
        });
  
  
     $('#form_equipo').bootstrapValidator({
            container: '#messages',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
             submitHandler: function(validator, form, submitButton) {

                 
                  var formData = new FormData($("#form_equipo")[0]);
                     $.ajax({                        
                            url:'{{ route('CrearEquipoPrincipal') }}',
                             type: 'POST',           
                            // data: $("#form_equipo").serialize(), 
                             data:formData,
                             cache:false,
                             contentType: false,
                             processData: false,
                            success: function(data)             
                            {
                                  myDropzone.processQueue();
                                  $("#id").val(data.id);
                                   Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Se registro correctamente',
                                    showConfirmButton: false,
                                    timer: 1500
                                 })
                              

                            }
                  });
            },
            fields: {
                codigo: {
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
                
                 peso: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere serie'
                        }
                    }
                },
         
                 modelo: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere modelo'
                        }
                    }
                },
                 altura: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere codigo'
                        },

                       regexp: {
               
                         regexp: /^[0-9]+([,][0-9]+)?$/,
               
                         message: 'Solo se puede ingresar número'
               
                       }
                    }
                },
                peso_envio: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere codigo'
                        },

                       regexp: {
               
                         regexp: /^[0-9]+([,][0-9]+)?$/,
               
                         message: 'Solo se puede ingresar número'
               
                       }
                    }
                },
            
                largo: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere largo'
                        },

                       regexp: {
               
                         regexp: /^[0-9]+([,][0-9]+)?$/,
               
                         message: 'Solo se puede ingresar número'
               
                       }
                    }
                },

            }


        })

      

      
      $("#limpiarCaja" ).click(function() {
          // $("#form_equipo")[0].reset();
           location.reload();
        });

      $("#BuscarEquipo" ).click(function() {
            var codigo=$("#codigoBuscar").val();
             $.ajax({                        
                            url:'{{ route('BuscarEquipoPrincipal') }}',
                             type: 'POST',
                             data:{
                                    "_token": "{{ csrf_token() }}",
                                     "codigo":codigo,
                                },
                            success: function(respuesta)             
                            {
                                $.each(respuesta.data,function(index,element)
                                    { 
                                      
                                      $("#codigo").val(element.idequipo);

                                      $("#marca").val(element.codigo);
                                      $("#id_marca").val(element.id_marca);

                                      $("#descripcion").val(element.descripcion);

                                      $("#ubicacion").val(element.nombrePais);
                                      $("#id_ubicacion").val(element.id_pais);

                                      $("#empresa").val(element.nombreEmpresa);
                                      $("#id_empresa").val(element.id_empresa);

                                      $("#modelo").val(element.modelo);
                                      $("#peso").val(element.peso);
                                      $("#peso_envio").val(element.peso_envio);

                                      $("#altura").val(element.altura);
                                      $("#ancho").val(element.ancho);
                                      $("#largo").val(element.largo);

                                       $("#umedimens").val(element.umedimens);
                                       $("#cantidad").val(element.cantidad);
                                       $("#potencia").val(element.potencia);
                                       $("#id").val(element.id);
                                       $("#id_equipo_padre").val(element.id_equipo_padre)
                                       $("#equipo_padre").val(element.descripcionTipoEquipo)
                                       
                                    });
                                    $('#btnActualizar').attr("disabled", false);
                              
                            }
                  });
        });

      
       $("#btnActualizar" ).click(function() {
        $.ajax({                        
                            url:'{{ route('ActualizarEquipoPrincipal') }}',
                             type: 'POST',           
                            data: $("#form_equipo").serialize(), 
                            success: function(data)             
                            {
                                   Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Se actuzalizo correctamente su información',
                                showConfirmButton: false,
                                timer: 1500
                                 })
                              

                            }
        });   
    });   
});       

       
     
</script>

@endsection


