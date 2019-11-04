<div class="table-responsive">
<table id="inicio" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Codigo</th>
        <th>Descripcion</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($ubicacions as $ubicacion)
            <tr>
                <td>{!! $ubicacion->codigo !!}</td>
            <td>{!! $ubicacion->descripcion !!}</td>
                <td>
                    {!! Form::open(['route' => ['ubicacions.destroy', $ubicacion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('ubicacions.show', [$ubicacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('ubicacions.edit', [$ubicacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
