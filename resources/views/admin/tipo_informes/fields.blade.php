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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipoInformes.index') !!}" class="btn btn-default">Cancelar</a>
</div>
