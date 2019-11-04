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
        @foreach($medidors as $medidor)
            <tr>
                <td>{!! $medidor->codigo !!}</td>
            <td>{!! $medidor->descripcion !!}</td>
                <td>
                    {!! Form::open(['route' => ['medidors.destroy', $medidor->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('medidors.show', [$medidor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('medidors.edit', [$medidor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
