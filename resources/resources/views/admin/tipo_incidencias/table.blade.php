<div class="table-responsive">
    <table class="table" id="inicio">
        <thead>
            <tr>
                <th>Codigo</th>
        <th>Description</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tipoIncidencias as $tipoIncidencia)
            <tr>
                <td>{!! $tipoIncidencia->codigo !!}</td>
            <td>{!! $tipoIncidencia->description !!}</td>
                <td>
                    {!! Form::open(['route' => ['tipoIncidencias.destroy', $tipoIncidencia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('tipoIncidencias.show', [$tipoIncidencia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tipoIncidencias.edit', [$tipoIncidencia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
