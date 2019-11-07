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
                          <th>EQUIPO</th>
                        <th>AREA</th>
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
                        <td>{{ $item->descripcion}}</td>
                        <td>{{$item->area}}</td>
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
                            <div class='btn-group'>
                               <button type="button" class="btn btn-round btn-success" onclick="editar({{$item->id}});">edit</button>
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
          </div>
        </div>

@endsection


<div id="updateEquipo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACTUALIZAR EQUIPO</h4>
      </div>
      <div class="modal-body">
            @include('admin.equipo_principal.update')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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
                                <th>EMPRESA</th>
                                <th>TIENDA</th>
                                <th>DIRECCIÓN</th>
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

<div class="modal fade" id="modalBuscarPartida" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR PARTIDA </h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_partido">
                         <thead>
                              <tr>
                                <th>ID</th>
                                <th>EMPRESA</th>
                                <th>TIENDA</th>
                                <th>DIRECCIÓN</th>
                                <th>CODIGO</th>
                                <th>PARTIDA</th>

                              </tr>
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
                     setInterval( function () {
                        table.ajax.reload();
                    }, 30000 );
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
                                { data: 'nombreEmpresa', name: 'nombreEmpresa' },
                                { data: 'nombre', name: 'nombre' },
                                { data: 'direccion', name: 'direccion' },
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
        
        $("#buscar_partida").click(function()
        {
             
              
              $('#modalBuscarPartida').modal('show');
                var table=$('#table_listar_partido').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('listar_partida_all_empresa_tienda') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'nombreEmpresa', name: 'nombreEmpresa' },
                                { data: 'tiendaNombre', name: 'tiendaNombre' },
                                { data: 'direccion', name: 'direccion' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'descripcion', name: 'descripcion' }
                             ]
                             
                    });
                    
                    $('#table_listar_partido tbody').on('click', 'tr', function () 
                    {
                        var data = table.row( this ).data();
                        $('#modalBuscarPartida').modal('hide');
                        $("#id_partida").val(data['id']);
                        $("#partida").val(data['descripcion']+' - '+data['codigo']);
                        
                       
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


          $("#btnActualizar").click(function(event) {
               event.preventDefault();
              $.ajax({                        
                                  url:'{{ route('ActualizarEquipoPrincipal') }}',
                                   type: 'POST',           
                                  data: $("#form_equipo_update").serialize(), 
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



    } );

    function editar(id)
    {

             $.ajax({                        
                            url:'{{ route('BuscarEquipoPrincipal') }}',
                             type: 'POST',
                             data:{
                                    "_token": "{{ csrf_token() }}",
                                     "id":id,
                                },
                            success: function(respuesta)             
                            {
                                 $('#updateEquipo').modal('show');

                                $.each(respuesta.data,function(index,element)
                                    { 
                                      
                                      $("#codigo").val(element.idequipo);
                                      $("#id").val(element.id);

                                      $("#id_equipo_padre").val(element.id_equipo_padre);//tipo equipo
                                      $("#id_marca").val(element.id_marca);
                                      $("#descripcion").val(element.descripcion);
                                      $("#id_area").val(element.id_area);
                                      $("#modelo").val(element.modelo);
                                      $("#peso").val(element.serie);
                                      $("#peso_envio").val(element.voltaje);
                                      $("#amperaje").val(element.amperaje);
                                      $("#largo").val(element.largo);
                                      $("#id_unidad").val(element.id_unidad);
                                      $("#cantidad").val(element.cantidad);
                                      $("#potencia").val(element.potencia);
                                      $("#id_partida").val(element.id_categoria_tienda);
                                      $("#equipo_padre").val(element.descripcionTipo);//Tipo equipo
                                      $("#marca").val(element.marcaDescripcion);
                                      $("#tienda").val(element.nombreTienda);
                                      $("#id_tienda").val(element.id_tienda);
                                      $("#partida").val(element.partidaNombre);
                                      $("#area").val(element.areaNombre);
                                      $("#umedimens").val(element.nombreUnuidad);
                                      $("#tipogas option[value="+ element.tipogas +"]").attr("selected",true);
                                      // $("#tipogas").val(element.tipogas);
                                   
                                      // $("#marca").val(element.codigo);
                                      

                                      // $("#empresa").val(element.nombreEmpresa);
                                      // $("#id_empresa").val(element.id_empresa);

                                      // $("#modelo").val(element.modelo);
                                     
                                      // $("#peso_envio").val(element.peso_envio);

                                      // $("#altura").val(element.altura);
                                      // $("#ancho").val(element.ancho);
                                      

                                      //  $("#umedimens").val(element.umedimens);
                                      //  $("#cantidad").val(element.cantidad);
                                      //  $("#potencia").val(element.potencia);
                                      //  $("#id").val(element.id);
                                      //  $("#id_equipo_padre").val(element.id_equipo_padre)
                                      //  $("#equipo_padre").val(element.descripcionTipoEquipo)
                                       
                                    });
                                 
                              
                            }
                  });
   
    }
  </script>

@endsection