<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    @if($opcion==0)
   		 {!! Form::text('codigo', $max, ['class' => 'form-control','readonly' => 'true']) !!}
    @else
    	 {!! Form::text('codigo', null, ['class' => 'form-control','readonly' => 'true']) !!}
    @endif
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipoIncidencias.index') !!}" class="btn btn-default">Cancelar</a>
</div>
