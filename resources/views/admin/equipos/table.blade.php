<div class="table-responsive">
    <table class="table" id="inicio">
        <thead>
            <tr>
                <th>Nombre</th>
        <th>Codigo</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($equipos as $equipo)
            <tr>
                <td>{!! $equipo->nombre !!}</td>
            <td>{!! $equipo->codigo !!}</td>
                <td>
                    {!! Form::open(['route' => ['equipos.destroy', $equipo->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('equipos.show', [$equipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('equipos.edit', [$equipo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
