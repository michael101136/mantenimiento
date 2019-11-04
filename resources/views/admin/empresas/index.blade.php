
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
                    EMPRESA
                  </div>
                  <h1 class="pull-left"> <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('empresas.create') !!}">Crear</a></h1>
                  <div class="x_content">

                     @include('admin.empresas.table')
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>



  
  
  
  
  
  <div class="modal fade" id="modalBuscarUbigeo_empresa" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">UBIGEOS</h4>
        </div>
        <div class="modal-body">
       
                    <form method="POST"  name='add_ubigeo_empresa' id='add_ubigeo_empresa'>
                        {{ csrf_field() }}
                          <div class="form-group">
                            <input type="hidden" class="form-control" name="id_empresa" id="id_empresa">
                          </div>
                         
                         <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                     <div class="well" id="textUbigeo" style="text-transform: uppercase;">
                                    
                                     </div>
                                    <input type="hidden" id="id_ubigeo" name="id_ubigeo"  class="form-control col-md-7 col-xs-12" >
                            
                                </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                    	<button type="button" class="btn btn-info" id="listarUbigeo"><span class="fa fa-search-plus">BUSCAR UBIGEO</span></button>
                                    </div>
                        </div>
                        <div class="form-group">
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                     <button type="submit" id="btnUpload" name="btnUpload" class="btn btn-default">AGREGAR</button>
                             </div>
                        </div>
                    </form>
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_ubigeo_empresa">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>DISTRITO</th>
                                <th>PROVINCIA</th>
                                <th>DEPARTAMENTO</th>
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
  
  
  <div class="modal fade" id="modalBuscarUbigeo" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR UBIGEO</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_ubigeo">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>DISTRITO</th>
                                <th>PROVINCIA</th>
                                <th>DEPARTAMENTO</th>
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
  
 
@endsection


@section('script')
<script>





function ubigeo_empresa(id)
{
    $('#add_ubigeo_empresa')[0].reset();
   $("#id_empresa").val(id);
   $('#modalBuscarUbigeo_empresa').modal('show');
                var table=$('#table_listar_ubigeo_empresa').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('listar_ubigeoEmpresa') }}/"+id,
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'distrito', name: 'distrito' },
                                { data: 'provincia', name: 'provincia' },
                                { data: 'departamento', name: 'departamento' },
                             ]
                             
                    });
                    
               
}

$(document).ready(function() {
    
  $('#btnUpload').on('click', function(e){

                e.preventDefault();
                var data = $('#add_ubigeo_empresa').serialize();

                 $.ajax({
                  url:'{{ route('save.ubicacionTienda') }}',
                    type: 'POST',
                    data:data,
                     success: function(data) {
                       
                       ubigeo_empresa($("#id_empresa").val());
                            
                    }
                    
                });

        });
    
    
  
  $('#inicio').DataTable({
    "language": {
      "url": "/admin/idioma/Spanish.json"
    }
  });
  
  $("#listarUbigeo").click(function()
        {
             
              
              $('#modalBuscarUbigeo').modal('show');
                var table=$('#table_listar_ubigeo').DataTable({
                    "language": {
                      "url": "/admin/idioma/spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('ubigeo_listar') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'distrito', name: 'distrito' },
                                { data: 'provincia', name: 'provincia' },
                                { data: 'departamento', name: 'departamento' },
                             ]
                             
                    });
                    
                $('#table_listar_ubigeo tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $('#modalBuscarUbigeo').modal('hide');
                    $("#id_ubigeo").val(data['id']);
                    $("#textUbigeo").html(data['departamento']+' - '+data['provincia']+' - '+data['distrito']);
                    
                   
                } );
                                        
    
        
        });
        
       
  
});
</script>


@endsection


