<div class="table-responsive">
    <table class="table" id="inicio">
        <thead>
            <tr>
                <th>Razonsoc</th>
        <th>Ruc</th>
        <th>User Create</th>
        <th>Web</th>
        <th>Estado</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($logiProveedores as $logiProveedores)
            <tr>
                <td>{!! $logiProveedores->razonsoc !!}</td>
            <td>{!! $logiProveedores->ruc !!}</td>
            <td>{!! $logiProveedores->user_create !!}</td>
            <td>{!! $logiProveedores->web !!}</td>
            <td>{!! $logiProveedores->estado !!}</td>
                <td>
                    {!! Form::open(['route' => ['logiProveedores.destroy', $logiProveedores->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('logiProveedores.show', [$logiProveedores->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('logiProveedores.edit', [$logiProveedores->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
