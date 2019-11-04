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
                    REGISTRAR PROBLEMA
                   
                  </div>
                  <div class="x_content">

            {!! Form::open(['route' => 'problemas.store','id'=>'form_problema','class'=>'form-horizontal']) !!}



<div class="form-group">
     <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">CÓDIGO
    </label>
    <!--<input type="checkbox" id="preventivo" value="1" name="preventivo"> <label for="cbox2">Mantenimiento preventivo</label>-->
    <div class="col-md-6 col-sm-6 col-xs-6">
        <input type="text" id="codigo" name="codigo"  value="{{$maxCodigo}}" required="required" class="form-control col-md-7 col-xs-12" readonly>

    </div>


</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">EQUIPO
    </label>
    <div class="col-md-6 col-sm-6 col-xs-6">
         <div class="well" id="textEquipo" style="text-transform: uppercase;">
        
         </div>
        <input type="hidden" id="id_equipo"  value="{{old('id_equipo')}}" name="id_equipo"  class="form-control col-md-7 col-xs-12" >
{!! $errors->first('id_equipo','<span class=error>:message</span>') !!}
    </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarEquipo"><span class="fa fa-search-plus">BUSCAR EQUIPO</span></button>
        </div>
</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">PROBLEMA
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
       
       <textarea rows="3" cols="400" id="problema" name="problema" placeholder="Describa el equipo y su respectivo problema.">
                 {{old('problema')}}
        </textarea>
        {!! $errors->first('problema','<span class=error>:message</span>') !!}
    </div>
    
</div>

<!--<div class="form-group">-->
<!--    <label class="control-label col-md-1 col-sm-1 col-xs-1">EMPRESA-->
<!--    </label>-->
<!--    <div class="col-md-3 col-sm-6 col-xs-12">-->
       
<!--       <textarea rows="4" cols="200" id="empresa" name="empresa" placeholder="Ingrese nombre de su empresa">-->
       
<!--        </textarea>-->
<!--    </div>-->
    
<!--</div>-->



    
    
    
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
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR EQUIPO</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="listar_Usuario">
                          <thead>
                              <tr>
                                <th>CODIGO</th>
                                <th>EMPRESA</th>
                                <th>TIENDA</th>
                                 <th>ÁREA</th>
                                 <th>TIPO EQUIPO</th>
                                    <th>MARCA</th>
                                <th>SERIE</th>
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


    $(function() 
    {

        $("#listarEquipo").click(function()
        {
             
              
              $('#modalBuscarEquipo').modal('show');
                var table=$('#listar_Usuario').DataTable({
                    "language": {
                      "url": "/admin/idioma/Spanish.json"
                    },
                       processing: true,
                       serverSide: true,
                       destroy: true,
                       ajax: "{{ url('equipo_listar') }}",
                       columns: [
                                { data: 'idequipo', name: 'idequipo' },
                                { data: 'empresa', name: 'empresa' },
                                { data: 'tienda', name: 'tienda' },
                                { data: 'area', name: 'area' },
                                { data: 'tipoequipo', name: 'tipoequipo' },
                                 { data: 'marca', name: 'marca' },
                                { data: 'serie', name: 'serie' },
                             ]
                             
                    });
                    
                $('#listar_Usuario tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    $("#id_equipo").val(data['id']);
                    $("#textEquipo").html(data['tipoequipo']);
                   $('#modalBuscarEquipo').modal('hide');   
                    // alert( 'You clicked on '+data['id']+'\'s row' );
                } );
                                        
    
        
        });
        
 

         
        


            
    });  
       
</script>

@endsection


