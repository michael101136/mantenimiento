<div class="table-responsive">
    <table class="table" id="inicio">
        <thead style="background-color: #5A738E;color:#FFFFFF; text-transform: uppercase;">
            <tr>
            <th>Nombre</th>
            <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody style=" text-transform: uppercase;">
        @foreach($empresas as $empresa)
            <tr>
                <td>{!! $empresa->nombre !!}</td>
                <td>
                    {!! Form::open(['route' => ['empresas.destroy', $empresa->id], 'method' => 'delete']) !!}
                    <div class='container'>
                        <a href="{!! route('empresas.show', [$empresa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('empresas.edit', [$empresa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                         <a href='#' class="btn btn-success btn-xs" onclick="ubigeo_empresa('{{$empresa->id}}')">UBICACION</a>
                    </div>
                    {!! Form::close() !!}
                   
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
