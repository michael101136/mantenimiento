<!-- Razonsoc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('razonsoc', 'Razonsoc:') !!}
    {!! Form::text('razonsoc', null, ['class' => 'form-control']) !!}
</div>

<!-- Ruc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ruc', 'Ruc:') !!}
    {!! Form::text('ruc', null, ['class' => 'form-control']) !!}
</div>

<!-- User Create Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_create', 'User Create:') !!}
    {!! Form::text('user_create', null, ['class' => 'form-control']) !!}
</div>

<!-- Web Field -->
<div class="form-group col-sm-6">
    {!! Form::label('web', 'Web:') !!}
    {!! Form::text('web', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado', 'Estado:') !!}
    {!! Form::text('estado', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('logiProveedores.index') !!}" class="btn btn-default">Cancelar</a>
</div>
