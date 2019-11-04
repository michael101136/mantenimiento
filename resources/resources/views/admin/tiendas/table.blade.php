<div class="table-responsive">
    <table class="table table-striped" id="inicio">
        <thead style="background-color: #5A738E;color:#FFFFFF; text-transform: uppercase;">
            <tr>
                <th>Codigo</th>
                <th>Empresa</th>
                <th>Tienda</th>
                <th>Ubicación</th>
                <th colspan="1">Action</th>
            </tr>
        </thead>
        <tbody style="text-transform: uppercase;">
        @foreach($tiendas as $tienda)
            <tr>
                <td>{!! $tienda->codigo !!}</td>
                 <td>{!! $tienda->empresaNombre !!}</td>
            <td>{!! $tienda->nombre !!}</td>
            <td>{!! $tienda->ubicacion !!}</td>
            
                <td>
                    {!! Form::open(['route' => ['tiendas.destroy', $tienda->id], 'method' => 'delete']) !!}
                   
                        <a href="{!! route('tiendas.show', [$tienda->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tiendas.edit', [$tienda->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        <a href='#' class="btn btn-info btn-xs" onclick="partida_tienda('{{$tienda->id}}')">PARTIDA</a>
                  
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
