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
                    MARCAS DE LOS TIPOS DE EQUIPOS
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
                            {!! Form::open(['route' => 'marcas.store']) !!}

                            @include('admin.marcas.fields')

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
     
        $("#listarTipoEquipo").click(function()
        {
             
              
              $('#modalBuscarTipoEquipo').modal('show');
                var table=$('#table_listar_tipo_equipo').DataTable({
                    "language": {
                      "url": "/admin/idioma/Spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('tipos_equipos_listar') }}",
                       columns: [
                                { data: 'id', name: 'id' },
                                { data: 'codigo', name: 'codigo' },
                                { data: 'descripcion', name: 'descripcion' },
  
                             ]
                    });
                    
                $('#table_listar_tipo_equipo tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_tipo_equipo").val(data['id']);
                    $("#textTipoEquipo").html(data['descripcion']);
                    $("#modalBuscarTipoEquipo").modal("hide");
                    // alert( 'You clicked on '+data['id']+'\'s row' );
                } );
        
        });
            
    });  
       
</script>

@endsection
