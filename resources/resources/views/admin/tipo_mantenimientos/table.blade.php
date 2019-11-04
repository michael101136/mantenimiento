<div class="table-responsive">
    <table id="inicio" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Codigo</th>
        <th>Descripcion</th>
        <th>Siglas</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tipoMantenimientos as $tipoMantenimiento)
            <tr>
                <td>{!! $tipoMantenimiento->codigo !!}</td>
            <td>{!! $tipoMantenimiento->descripcion !!}</td>
            <td>{!! $tipoMantenimiento->siglas !!}</td>
                <td>
                    {!! Form::open(['route' => ['tipoMantenimientos.destroy', $tipoMantenimiento->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('tipoMantenimientos.show', [$tipoMantenimiento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tipoMantenimientos.edit', [$tipoMantenimiento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
