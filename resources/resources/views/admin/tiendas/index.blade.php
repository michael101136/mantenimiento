
@extends('admin.layout.master')

@section('content')

 <div class="right_col" role="main">
 <section class="content-header">

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
TIENDAS
                  </div>
                  <h1 class="pull-left"> <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('tiendas.create') !!}">Crear</a></h1>
                  <div class="x_content">

                  @include('admin.tiendas.table')
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>

@endsection


<div class="modal fade" id="modalPartida_empresa" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">LISTADO DE PARTIDA</h4>
        </div>
        <div class="modal-body">
       
                    <form method="POST"  name='add_partida' id='add_partida'>
                        {{ csrf_field() }}
                          <div class="form-group">
                            <input type="hidden" class="form-control" name="id_empresa_1" id="id_empresa_1">
                          </div>
                         <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                     <div class="well" id="textpartida" style="text-transform: uppercase;">
                                    
                                     </div>
                                    <input type="hidden" id="id_partida" name="id_partida"  class="form-control col-md-7 col-xs-12" >
                            
                                </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    	<button type="button" class="btn btn-info" id="listarPartida"><span class="fa fa-search-plus">BUSCAR PARTIDA</span></button>
                                    </div>
                        </div>
                        <div class="form-group">
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                     <button type="submit" id="btnUpload1" name="btnUpload1" class="btn btn-default">AGREGAR</button>
                             </div>
                        </div>
                    </form>
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_categoria_empresa">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>TIENDA</th>
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
                                <th>CODIGO</th>
                                <th>DESCRIPCION</th>
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


function partida_tienda(id)
{
 
   $('#add_partida')[0].reset();
   $("#id_empresa_1").val(id);
   $('#modalPartida_empresa').modal('show');
   
                var table=$('#table_listar_categoria_empresa').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                      processing: true,
                      serverSide: true,
                      destroy: true,
                      ajax: "{{ url('listar_partida_Tienda') }}/"+id,
                      columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'nombre', name: 'nombre' },
                                { data: 'descripcion', name: 'descripcion' }
                             ]
                             
                    });
                    
               
}
$(document).ready(function() {
  $('#inicio').DataTable({
    "language": {
      "url": "/admin/idioma/spanish.json"
    }
  });
  
  $('#btnUpload1').on('click', function(e){

                e.preventDefault();
                var data = $('#add_partida').serialize();

                 $.ajax({
                  url:'{{ route('save.partida') }}',
                    type: 'POST',
                    data:data,
                     success: function(data) {
                       
                       partida_tienda($("#id_empresa_1").val());
                            
                    }
                    
                });

        });
        
    $("#listarPartida").click(function()
        {
             
              
              $('#modalBuscarPartida').modal('show');
                var table=$('#table_listar_partido').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('listar_partida_all') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'descripcion', name: 'descripcion' }
                             ]
                             
                    });
                    
                    $('#table_listar_partido tbody').on('click', 'tr', function () 
                    {
                        var data = table.row( this ).data();
                        $('#modalBuscarPartida').modal('hide');
                        $("#id_partida").val(data['id']);
                        $("#textpartida").html(data['descripcion']+' - '+data['codigo']);
                        
                       
                     } );
                                        
    
        
        });
});
</script>


@endsection


