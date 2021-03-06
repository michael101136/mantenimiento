
<!-- Codigo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('codigo', 'Codigo:') !!}
    
    @if($opcion=='1')
        {!! Form::text('codigo',null, ['class' => 'form-control','readonly' => 'true']) !!}
    @else
    {!! Form::text('codigo',$max, ['class' => 'form-control','readonly' => 'true']) !!}
    @endif
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('areas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
