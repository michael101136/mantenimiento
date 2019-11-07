@extends('admin.layout.master')

@section('content')

 <div class="right_col" role="main">
 <section class="content-header">
	<div class="form-group">
		 
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
                    GENERAR TICKET ATENCIÓN
                   
                  </div>
                  <div class="x_content">

            {!! Form::open(['route' => 'ticket.store','id'=>'form_problema','class'=>'form-horizontal']) !!}



<div class="form-group">
     <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">CÓDIGO
    </label>
    <input type="checkbox" id="preventivo" value="1" name="preventivo" checked> <label for="cbox2">Mantenimiento preventivo</label>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <input type="text" id="codigo" name="codigo"  value="{{$maxCodigo}}" required="required" class="form-control col-md-7 col-xs-12" readonly>

    </div>


</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">TIENDAS
    </label>
    <div class="col-md-6 col-sm-6 col-xs-6">
         <div class="well" id="textTienda" style="text-transform: uppercase;">
        
         </div>
        <input type="hidden" id="id_tienda"  value="{{old('id_tienda')}}" name="id_tienda"  class="form-control col-md-7 col-xs-12" >
{!! $errors->first('id_equipo','<span class=error>:message</span>') !!}
    </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarEquipo"><span class="fa fa-search-plus">BUSCAR TIENDA</span></button>
        </div>
</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">TIPOS DE INCIDENCIA
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id="equipo_incidencia" name="equipo_incidencia" class="form-control col-md-7 col-xs-12" readonly>
        <input id="id_incidencia" name="id_incidencia" class="form-control col-md-7 col-xs-12" type="hidden">
         
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <button type="button" class="btn btn-info" onclick="busquedaFunction('Incidencias ','1')"><span class="fa fa-search-plus"></span></button>
    </div>
</div>
    
</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">FECHA REGISTRO
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="fecharegistro" value="{{$fecha}}" name="fecharegistro" class="form-control"  readonly>
    </div>
    
    
    
<div class="form-group">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    <button type="submit" class="btn btn-success">GUARDAR</button>
    <a href="listarproblemas"  class="btn btn-primary" type="button">CANCELAR</a>

</div>
</div>

    {!! Form::close() !!}


                    </div>

                </div>
              </div>

            </div>
          </div>
        </div>

@endsection


<div class="modal fade" id="modalBuscarEquipo" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR TIENDA</h4>
        </div>
        <div class="modal-body">
            <div class="container">
                <form class="form-horizontal" role="form">
                  
                  <div class="form-group">
                    
                    <div class="col-lg-12">
                          <label for="sel1">Empresa</label>
                          <select class="form-control" id="id_empresa">
                              <option value="1"> Seleccione la empresa</option>
                              @foreach($empresa as $item)
                                <option value="{{$item->id}}"> {{$item->nombre}}</option>
                              @endforeach
                          </select>
                    </div>
                   
                  </div>
                </form>
            </div>
   
            <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="listar_Usuario">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>TIENDA</th>
                                <th>DIRECCIÓN</th>
                                <th>DEPARTAMENTO</th>
                                <th>PROVINCIA</th>
                                <th>PARTIDA</th>
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
  

  <div class="modal fade" id="Busquedas" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">Busqueda</h4>
        </div>
        <div class="modal-body">
       
                    <table id="inicioDatable" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Descripcion</th> 
                        </tr>
                      </thead>
                      <tbody id="tableListar" name="tableListar">
                       
                        
                      </tbody>
                    </table>
                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@section('script')



  
<script>



function busquedaFunction(titulo,opcion) {
 	
    $('#busquedaTitulo').html(titulo);

    if(opcion=='1')
    {
      var url='{{ route('listarIncidencias') }}';
    }

    
    
    var opcionUrl;
    var htmlListar;
    $("#tableListar").html('');
   $('#cargar').html('<div class="preloader"></div>');
    $.ajax({
                 url:url,
                 type: 'POST',
                 data:{
                        "_token": "{{ csrf_token() }}",
                         "abbr":opcion,
                    },
                 dataType: 'JSON',
                 success: function(respuesta) {
                 
                    if(opcion=='1' )
                    {
                        $.each(respuesta.data,function(index,element)
                            { 
                              htmlListar=htmlListar + "<tr value='"+element.id+"'>"+ 
                                                      "<td id='codigo'>"+element.codigo+" </td>"+
                                                      "<td class='boton' style='cursor:pointer;'>"+element.description+"</td>"+
                                                    "</tr>";
                            });

                            $("#tableListar").html(htmlListar);
                    }
                    
                    
                    
                     $('#cargar').html('');
                  }

              });
    

             $('#Busquedas').modal('show');
             
           

             $(".table").on('click','tr',function(e){
                    e.preventDefault();
                    var  trValue= $(this).attr('value');
                    var name= $(this).find("td:last-child").text();
             
                    if(opcion=='1')
                    {
                      opcion=0;
                      $('#equipo_incidencia').val(name);
                      $('#id_incidencia').val(trValue);
                      $('#Busquedas').modal('hide');
                    }
                    
                  
                  
                }); 
      }
      
    $(function() 
    {
        var problema = [];
        var textoNombre='';
        $("#listarEquipo").click(function()
        {
             
              $('#modalBuscarEquipo').modal('show');
        
        });
        
       
        
        function listarEmpresa(id_ubigeo)
        {
           
            var empresa = $("#id_empresa");
            empresa.find('option').remove();
            
            var tienda = $("#id_tienda");
            tienda.find('option').remove();
            
            empresa.append('<option> Seleccione una empresa</option>');
            $.ajax({
                   type:'GET',
                   url:'/listar_Empresa/'+id_ubigeo,
                   success:function(data){
                    
                     $(data.data).each(function(i, v){
                        empresa.append('<option value="' + v.id + '">' + v.nombre + '</option>');
                    })

                      
                   }
        
                });
        }
        
        $("#id_empresa").change(function()
        {
           
           var id_empresa=$("#id_empresa").val();
          
            var table=$('#listar_Usuario').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                     select: {
                            style: 'multi'
                        },
                      processing: true,
                      serverSide: true,
                      destroy: true,
                      ajax: '/listar_tienda/'+id_empresa,
                      columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'tienda', name: 'tienda' },
                                { data: 'direccion', name: 'direccion' },
                                { data: 'departamento', name: 'departamento' },
                                { data: 'provincia', name: 'provincia' },
                                { data: 'partida', name: 'partida' },
                             ]
                             
                    });
                  table.ajax.reload();  
                $('#listar_Usuario tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    
                    problema.push(data['id']);
                    $("#id_tienda").val(problema);
                    
                    textoNombre=textoNombre+" - "+data['tienda']+" - "+data['direccion'];
                    
                    $("#textTienda").html(textoNombre);
               
                } );
            
          
        
                
        });
        
       
        
            
    });  
       
</script>

@endsection


