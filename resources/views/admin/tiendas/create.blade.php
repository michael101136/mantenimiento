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
                    TIENDA
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
                            {!! Form::open(['route' => 'tiendas.store']) !!}
                                @include('admin.tiendas.fields')
                            {!! Form::close() !!}
                            </div>
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




    $(function() 
    {
     
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
                                { data: 'created_at', name: 'created_at' },
  
                             ]
                    });
                    
                $('#table_listar_empresa tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_empresa").val(data['id']);
                    $("#textEmpresa").html(data['nombre']);
                    $('#modalBuscarEmpresa').modal('hide');
                    // alert( 'You clicked on '+data['id']+'\'s row' );
                } );
        
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
