<div class="table-responsive">
    <table class="table" id="inicio">
        <thead>
            <tr>
                <th>Codigo</th>
        <th>Descripcion</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tipoEquipos as $tipoEquipo)
            <tr>
                <td>{!! $tipoEquipo->codigo !!}</td>
            <td>{!! $tipoEquipo->descripcion !!}</td>
                <td>
                    {!! Form::open(['route' => ['tipoEquipos.destroy', $tipoEquipo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('tipoEquipos.show', [$tipoEquipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tipoEquipos.edit', [$tipoEquipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
