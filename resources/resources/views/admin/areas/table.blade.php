<div class="table-responsive">
<table id="inicio" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
        <th>Codigo</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($areas as $area)
            <tr>
                <td>{!! $area->nombre !!}</td>
            <td>{!! $area->codigo !!}</td>
                <td>
                    {!! Form::open(['route' => ['areas.destroy', $area->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('areas.show', [$area->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('areas.edit', [$area->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
