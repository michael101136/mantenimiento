

<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    @if($option==0)
         {!! Form::text('codigo', $codigo, ['class' => 'form-control','readonly' => 'true']) !!}
    @else
        {!! Form::text('codigo', null, ['class' => 'form-control','readonly' => 'true']) !!}
    @endif
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>
@if($option==0)
<div class="form-group col-sm-6">
    {!! Form::label('Direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-10">
         <div class="col-sm-10"> 
               <div class="well" id="textEmpresa" style="text-transform: uppercase;">
              
               </div>
         </div>
         <div class="col-sm-2"> 
             	<button type="button" class="btn btn-info" id="listarEmpresa">
                    <span class="fa fa-search-plus">BUSCAR EMPRESA</span>
              </button>
              <input type="hidden" id="id_empresa" name="id_empresa"  value="{{old('id_empresa')}}" class="form-control col-md-7 col-xs-12" >
         </div>
</div>
       
<div class="form-group col-sm-10">
    
         <div class="col-sm-10"> 
            <div class="well" id="textUbigeo" style="text-transform: uppercase;"></div>
         </div>
        <input type="hidden" id="id_ubigeo" name="id_ubigeo" value="{{old('id_ubigeo')}}"  class="form-control col-md-7 col-xs-12" >

        <div class="col-md-2">
          <button type="button" class="btn btn-info" id="listarUbigeo">
                <span class="fa fa-search-plus">BUSCAR UBICACIÓN</span>
          </button>
        </div>
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tiendas.index') !!}" class="btn btn-default">Cancelar</a>
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
                                <th>FECHA</th>
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
  <!-- modal departamento -->
   @include('admin.ubigeo.departamento')