
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

<!-- modal departamento -->
@include('admin.ubigeo.departamentoTienda')

@section('script')
<script>

function eliminarTiendaUbigeo(id)
{
  eliminar=confirm("¿Deseas eliminar este registro?");
  if(eliminar)
  {
       $.ajax({
                  url:'eliminar_tienda_ubicacion/'+id,
                    type: 'get',
                     success: function(data) {
                               location.reload();  
                    }
                    
              });

  }else
  {
    alert("El registro no se elimino");
  }
}
 function ubigeo(id)
            {
                
                        $("#id_tienda").val(id);
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
                              $("#id_ubigeo").val(data['id']);
                              $("#textUbigeo").val(data['departamento']+' - '+data['provincia']+' - '+data['distrito']);

                              
                          
                          } );
                                                                    
                 
            }

       $('#btnUpload1').on('click', function(e){

                e.preventDefault();
                var data = $('#add_ubicacion_tienda').serialize();
                 $.ajax({
                  url:'{{ route('save.ubicacionTienda') }}',
                    type: 'POST',
                    data:data,
                     success: function(data) {
                               location.reload();  
                    }
                    
                });

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
                        $("#partida").val(data['descripcion']+' - '+data['codigo']);
                        
                       
                     } );
                                        
    
        
        });

       $(document).ready(function() {
             
                $('#inicio').DataTable({
                  "language": {
                    "url": "/admin/idioma/spanish.json"
                  }
              });
          });


</script>


@endsection


