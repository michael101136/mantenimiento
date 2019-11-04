<div class="table-responsive">
    <table class="table" id="tipoProgramacions-table">
        <thead>
            <tr>
                <th>Codigo</th>
        <th>Descripcion</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tipoProgramacions as $tipoProgramacion)
            <tr>
                <td>{!! $tipoProgramacion->codigo !!}</td>
            <td>{!! $tipoProgramacion->descripcion !!}</td>
                <td>
                    {!! Form::open(['route' => ['tipoProgramacions.destroy', $tipoProgramacion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('tipoProgramacions.show', [$tipoProgramacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tipoProgramacions.edit', [$tipoProgramacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
