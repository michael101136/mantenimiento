@extends('admin.layout.master')

@section('content')

 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">


            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">

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
                    <p class="text-muted font-13 m-b-30">
                    </p>
                    @include('adminlte-templates::common.errors')
                    <div class="box-body">
                            <div class="row">
                            {!! Form::open(['route' => 'usuarios.store']) !!}

                                @include('admin.usuarios.fields')

                            {!! Form::close() !!}
                            </div>
                        </div>
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>


<div class="modal fade" id="modalBuscarEmpresa" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR EMPRESA</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_empresa">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>UBIGEO</th>
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
$(document).ready(function() {
    $("#empresaOcultar").fadeOut();
  $('#inicio').DataTable({
    "language": {
      "url": "/admin/idioma/Spanish.json"
    }
  });
});

$(function() 
    {
     $("#privilege").change(function(){
          var data=$("#privilege").val();
                if(data=='visitante')
                {
                    $("#empresaOcultar").fadeIn();
                }else
                {
                     $("#empresaOcultar").fadeOut();
                }
                
               
        });
        $("#listarEmpresa").click(function()
        {
             
              
              $('#modalBuscarEmpresa').modal('show');
                var table=$('#table_listar_empresa').DataTable({
                    "language": {
                      "url": "/admin/idioma/Spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('empresa_listar') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'nombre', name: 'nombre' },
                                { data: 'ubigeoEmpresa', name: 'ubigeoEmpresa' },
  
                             ]
                    });
                    
                $('#table_listar_empresa tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_empresa").val(data['id']);
                    $("#textEmpresa").html(data['nombre']);
                    
                    // alert( 'You clicked on '+data['id']+'\'s row' );
                } );
        
        });
            
    }); 
</script>


@endsection
