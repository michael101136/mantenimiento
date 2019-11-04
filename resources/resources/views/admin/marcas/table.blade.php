<div class="table-responsive">
<table id="inicio" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Codigo</th>
                 <th>Equipo</th>
        <th>Marca</th>
       
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($marcas as $marca)
            <tr>
                <td>{!! $marca->codigo !!}</td>
                <td>{!! $marca->tipoequipo !!}</td>
            <td>{!! $marca->descripcion !!}</td>
                <td>
                    {!! Form::open(['route' => ['marcas.destroy', $marca->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('marcas.show', [$marca->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('marcas.edit', [$marca->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
