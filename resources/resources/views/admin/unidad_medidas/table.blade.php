<div class="table-responsive">
<table id="inicio" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Codigo</th>
        <th>Description</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($unidadMedidas as $unidadMedida)
            <tr>
                <td>{!! $unidadMedida->codigo !!}</td>
            <td>{!! $unidadMedida->description !!}</td>
                <td>
                    {!! Form::open(['route' => ['unidadMedidas.destroy', $unidadMedida->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('unidadMedidas.show', [$unidadMedida->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('unidadMedidas.edit', [$unidadMedida->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
