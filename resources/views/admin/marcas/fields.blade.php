<!-- Codigo Field -->
<div class="form-group col-sm-6">
      {!! Form::label('codigo', 'Codigo:') !!}
      @if($opcion==0)
        {!! Form::text('codigo', $maxCodigo, ['class' => 'form-control','readonly' => 'true']) !!}
      @else
        {!! Form::text('codigo', null, ['class' => 'form-control','readonly' => 'true']) !!}
      @endif
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>



<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-6">
         <div class="well" id="textTipoEquipo" style="text-transform: uppercase;">
        
         </div>
          @if($opcion==1)
            <input type="hidden" id="id_tipo_equipo" value="{{$marca->id_tipo_equipo}}" name="id_tipo_equipo"  class="form-control col-md-7 col-xs-12" >
          @else
            <input type="hidden" id="id_tipo_equipo"  name="id_tipo_equipo"  class="form-control col-md-7 col-xs-12" >
         @endif

    </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarTipoEquipo"><span class="fa fa-search-plus">BUSCAR TIPO DE EQUIPO</span></button>
        </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('marcas.index') !!}" class="btn btn-default">Cancelar</a>
</div>

<div class="modal fade" id="modalBuscarTipoEquipo" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR TIPO EQUIPO</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_tipo_equipo">
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