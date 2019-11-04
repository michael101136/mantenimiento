<form id="form_programacion" name="form_programacion" data-parsley-validate class="form-horizontal form-label-left">
{{ csrf_field() }}
<div class="form-group">
     <div class="col-md-9 col-sm-3 col-xs-6">
         <input type="text" id="titulo" name="titulo" class="form-control col-md-4 col-xs-12" placeholder="ORDEN DE SERVICIO" readonly><br><br>
    </div>
</div> 
<div class="form-group">
     <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">Código
    </label>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <input type="text" id="codigo" name="codigo" value="{{$maxCodigo}}" class="form-control col-md-7 col-xs-12" readonly>
        <input type="hidden" id="id" name="id" class="form-control col-md-7 col-xs-12">
    </div>

    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Descripción    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="descripcion" name="descripcion"  class="form-control col-md-7 col-xs-12">
    </div>
</div>

<hr/>

<div class="form-group">    
    
     
     <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">
        Dias estimados para terminar
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="number" id="dias_estimados" name="dias_estimados"  class="form-control col-md-7 col-xs-12">
    </div>
    
     <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">
         Horas Estimadas
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id="tm_estimado" name="tm_estimado"  class="form-control col-md-7 col-xs-12">
    </div>

    


    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Técnicos
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
             <select class="form-control" id="id_usuario_tecnico" name="id_usuario_tecnico[]" multiple>
                @foreach($usuarios as $item)
                     <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
    </div>

</div>
<div class="form-group">
   

    <div class="form-group">
        <label class="control-label col-md-1 col-sm-1 col-xs-1">
            Estado
        </label>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <select class="form-control" id="estado" name="estado">
              <option value="1" >Habilitado</option>
              <option value="0">Deshabilitado</option>
            </select>
        </div>

         <label class="control-label col-md-1 col-sm-1 col-xs-1">Fecha inicio
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="fecha_inicio" name="fecha_inicio" class="date-picker form-control col-md-7 col-xs-12" value="{{$date}}" type="date">
        </div>

        <label class="control-label col-md-1 col-sm-1 col-xs-1">Fecha fin
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <input id="fecha_fin" name="fecha_fin" class="date-picker form-control col-md-7 col-xs-12"  type="date" readonly>
        </div>

    </div>

    
</div>
<div class="form-group">
   

    <div class="form-group">
        

         <label class="control-label col-md-2 col-sm-1 col-xs-1">Hora Inicio
        </label>
        <div class="col-md-2">
            <input id="hora_inicio" name="hora_inicio" class="date-picker form-control col-md-7 col-xs-12"  type="number">
            
        </div>
        
        <div class="col-md-2">
            <input id="hora_marcada_inicio" name="hora_marcada_inicio" class="form-control col-md-7"  type="text" placeholder="am">
            
        </div>
        
        <label class="control-label col-md-2 col-sm-1 col-xs-1">Hora Fin
        </label>
        <div class="col-md-2">
            <input id="hora_fin" name="hora_fin" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
        </div>
        
          <div class="col-md-2">
            <input id="hora_inicio" name="hora_marcada_fin" class="form-control col-md-7"  type="text" placeholder="am">
            
        </div>

    </div>

    
        

</div>


<div class="panel panel-default">
  <div class="panel-heading">Método de programación</div>
  <div class="panel-body">
 <div class="form-group">


        <div class="col-md-3 col-sm-3 col-xs-12">

            <label><input type="radio" id="tipo_programacion" name="tipo_programacion" value="01" checked="checked"> Última vez que se programó</label><br>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <label><input type="radio" id="tipo_programacion" name="tipo_programacion" value="02"> Última vez que se terminó</label><br>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <label><input type="radio" id="tipo_programacion" name="tipo_programacion" value="03"> Vencimiento de lectura</label><br>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <label><input type="radio" id="tipo_programacion" name="tipo_programacion" value="04"> Por promedio de lecturao</label><br>
        </div>
    </div>
    <!-- <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content01" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Última programación</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content02" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Última terminada</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content03" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Vencimiento de lectura</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content04" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Promedio Lecturas</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content01" aria-labelledby="home-tab">
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Frecuencia</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="frecuencia" name="frecuencia"  class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                                                        
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content02" aria-labelledby="profile-tab">
                           <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Frecuencia</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="frecuencia1" name="frecuencia1"  class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content03" aria-labelledby="profile-tab">
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Medidor</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="medidor" name="medidor"  class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="medidor_id" name="medidor_id"  class="form-control col-md-7 col-xs-12">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <button type="button" class="btn btn-info btn-xs" onclick="busquedaMedidor('Medidor','1')"><span class="fa fa-search-plus"></span></button>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content04" aria-labelledby="profile-tab">
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Medidor</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="medidor1" name="medidor1"  class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="medidor_id_1" name="medidor_id_1"  class="form-control col-md-7 col-xs-12">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <button type="button" class="btn btn-info btn-xs" onclick="busquedaMedidor('Medidor','1')"><span class="fa fa-search-plus"></span></button>
                                </div>

                                
                            </div>
                            
                          
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Lectura</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="lectura" name="lectura"  class="form-control col-md-7 col-xs-12" placeholder="lectura de los ultimos dias">
                                </div>


                                 <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Última vez</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="vez" name="vez"  class="form-control col-md-7 col-xs-12">
                                </div>

                                <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Frecuencia</label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" id="frecuencia2" name="frecuencia2"  class="form-control col-md-2 col-xs-12">
                                </div>


                            </div>
                          
                            
                           
                        </div>
                    </div>
        </div>
    </div>
 -->
    
  </div>
</div>






<div class="form-group">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    <button class="btn btn-primary" type="button">Cancel</button>
    <button type="submit" class="btn btn-success">Guardar</button>
</div>
</div>

</form>

<div class="panel panel-default">
  <div class="panel-heading">PROMACIÓN</div>

      <div class="panel-body">
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre y apellido</th>
            <th>Cargo</th>
            <th>Fecha</th>
         
          </tr>
        </thead>
        <tbody id="tableListarPersonal">
        
        </tbody>
      </table>

        
      </div>

</div>

@section('script')
  
<script>



$("#preventivo").change(function() {
  
  
    if($('#preventivo').val()=='preventivo')
    {
 
         $("#Listar_orden").html('');
          
          var html= "<table class='table table-striped table-bordered table-condensed' id='listar_preventivo'>"+
                                  "<thead>"+
                                      "<tr>"+
                                        "<th>ID</th>"+
                                        "<th>CODIGO</th>"+
                                        "<th>INCIDENCIA</th>"+
                                        "<th>DESCRIPCIÓN</th>"+
                                      "</tr>"+
                                  "</thead>"+
                                "</table>";
         
          $("#contenedor_preventivo").html(html);
          
          
              $('#ModalOrdenServicios').modal('show');
                
                    var table=$('#listar_preventivo').DataTable({
                        "language": {
                          "url": "/admin/idioma/spanish.json"
                        },
                           processing: true,
                           serverSide: true,
                           destroy: true,
                           ajax: "{{ url('listarIncidenciasPreventivosProgramacion') }}",
                           columns: 
                                 [
                                    { data: 'id', name: 'id' },
                                    { data: 'codigo', name: 'codigo' },
                                    { data: 'description', name: 'description' },
                                    { data: 'descripcionOrden', name: 'descripcionOrden' }
                                 ]
                                 
                        });
                        
                         $('#listar_preventivo tbody').on('click', 'tr', function () {
                                var data = table.row( this ).data();
                                $('#').val('');
                                $("#id").val(data['id']);
                                $("#titulo").val(data['description']);
                              
                                
                                $('#ModalOrdenServicios').modal('hide');   
                                // alert( 'You clicked on '+data['id']+'\'s row' );
                            } );
    }else
    {
      
       incidencia();
    }
          
});
function incidencia()
{
  $("#contenedor_preventivo").html('');
         
          var html= "<table class='table table-striped table-bordered table-condensed' id='Listar_orden'>"+
                                  "<thead>"+
                                      "<tr>"+
                                        "<th>ID</th>"+
                                        "<th>CODIGO</th>"+
                                        "<th>EMPRESA</th>"+
                                        "<th>TIENDA</th>"+
                                        "<th>PROBLEMA</th>"+
                                      "</tr>"+
                                  "</thead>"+
                                "</table>";
         
          $("#contenedor_preventivo").html(html);

          $('#ModalOrdenServicios').modal('show');
                var table=$('#Listar_orden').DataTable({
                    "language": {
                      "url": "{{ url('admin/idioma/spanish.json') }}"
                    },
                      processing: true,
                      serverSide: true,
                      destroy: true,
                      ajax: "{{ url('BuscarOrdenServicios') }}",
                      columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'nombreEmpresa', name: 'nombreEmpresa' },
                                { data: 'nombreTienda', name: 'nombreTienda' },
                                { data: 'problemades', name: 'problemades' },
                             ]
                             
                    });
                    
                $('#Listar_orden tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id").val('');
                    $("#id").val(data['id']);
                    $("#titulo").val(data['problemades']);
                    
                      $('#ModalOrdenServicios').modal('hide');
                } );
}

 $(function() 
{
          var dias=$("#dias_estimados").val();
    	  var fechaIncio=$("#fecha_inicio").val();
    	  var new_date = moment(fechaIncio, "YYYY-MM-DD").add(dias, 'days');
          $("#fecha_fin").val(new_date.format("YYYY-MM-DD"));

$("#dias_estimados").blur(function(){
          var dias=$("#dias_estimados").val();
    	  var fechaIncio=$("#fecha_inicio").val();
    	  var new_date = moment(fechaIncio, "YYYY-MM-DD").add(dias, 'days');
          $("#fecha_fin").val(new_date.format("YYYY-MM-DD"));
	});
$("#fecha_inicio").blur(function(){
          var dias=$("#dias_estimados").val();
    	  var fechaIncio=$("#fecha_inicio").val();
    	  var new_date = moment(fechaIncio, "YYYY-MM-DD").add(dias, 'days');
          $("#fecha_fin").val(new_date.format("YYYY-MM-DD"));
	});
	
$("#hora_inicio").blur(function(){
    
          var horaEstimada=$("#tm_estimado").val();
    	  var diaSiguiente=parseInt(horaEstimada)+parseInt($("#hora_inicio").val());
          $("#hora_fin").val(diaSiguiente);
          
	});
   
   
         
     $("#id_ordenServicio").click(function()
        {
            
              $('#ModalOrdenServicios').modal('show');
                var table=$('#Listar_orden').DataTable({
                    "language": {
                      "url": "{{ url('admin/idioma/spanish.json') }}"
                    },
                      processing: true,
                      serverSide: true,
                      destroy: true,
                      ajax: "{{ url('BuscarOrdenServicios') }}",
                      columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'nombreEmpresa', name: 'nombreEmpresa' },
                                { data: 'nombreTienda', name: 'nombreTienda' },
                                { data: 'problemades', name: 'problemades' },
                             ]
                             
                    });
                    
                $('#Listar_orden tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id").val(data['id']);
                    $("#titulo").val(data['problemades']);
                    
                      $('#ModalOrdenServicios').modal('hide');
                } );
                                        
        });
})
function listadoPersonal(id)
{
  var htmlListar1;
   $("#tableListarPersonal").html('');
    $.ajax({
                 url:'{{ route('listarUsuarioProgramado') }}',
                 type: 'POST',
                 data:{
                        "_token": "{{ csrf_token() }}",
                         "idProgramacion":id,
                    },
                 dataType: 'JSON',
                  success: function(respuesta) {

                        $.each(respuesta.data,function(index,element)
                            { 
                              htmlListar1=htmlListar1 + "<tr>"+ 
                                                      "<td>"+element.name+" </td>"+
                                                      "<td>"+element.privilege+"</td>"+
                                                       "<td>"+element.fecha_inicio+"</td>"+
                                                    "</tr>";
                            });

                            $("#tableListarPersonal").html(htmlListar1);
                 
                  
                      
                  }
              });

}


    $(function() 
    {
        
      

           $('#form_programacion').bootstrapValidator({
            container: '#messages',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
             submitHandler: function(validator, form, submitButton) 
             {

                   $.ajax({                        
                           url:'{{ route('programacionCreate') }}',
                           type: 'POST',           
                           data: $("#form_programacion").serialize(), 
                           success: function(data)             
                           {
                              
                              // $("#id").val(data.id);
                                 Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Se registro correctamente su programación',
                                    showConfirmButton: false,
                                    timer: 1500
                                 })
                              listadoPersonal(data.id);
                              
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
                 descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere descripcion'
                        }
                    }
                },
                tm_estimado: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere tm estimado'
                        }
                    }
                },
                id_usuario_tecnico: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere tecnicos'
                        }
                    }
                },
                estado: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere estado'
                        }
                    }
                },
                fecha_inicio: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere fecha inicio'
                        }
                    }
                },
                fecha_fin: {
                    validators: {
                        notEmpty: {
                            message: 'Requiere fecha fin'
                        }
                    }
                },


            }


        });

        $("#btn_buscar_programacion" ).click(function() {
            var codigo=$("#codigo_programacion").val();

             $.ajax({                        
                            url:'{{ route('buscarProgramacion') }}',
                             type: 'POST',
                             data:{
                                    "_token": "{{ csrf_token() }}",
                                     "codigo":codigo,
                                },
                            success: function(respuesta)             
                            {
                                  console.log(respuesta);
                                  $.each(respuesta.data,function(index,element)
                                      { 
                                        
                                         listadoPersonal(element.id);
                                       
                                          
                                     });
                              
                             }
                  });

        });



            
    });  
       
</script>

@endsection

