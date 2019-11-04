<h4><center><u><strong>LISTADO DE PROBLEMAS</strong></u></center></h4>

<table border="1" style="font-size:12px;">

<tr>
<th>Cliente</th>
<th>Tienda</th>
<th>Empresa</th>
<th>Codigo</th>
<th>Problema</th>
<th>Equipo</th>
<th>Fecha</th>

</tr>

@foreach($listar as $item)
<tr>
    <td>{{$item->name}}</td>
    <td>{{$item->nombreTienda}}</td>
    <td>{{$item->nombreEmpresa}}</td>     
    <td>{{$item->codigo}}</td>
    <td>{{$item->problema}}</td>
    <td>{{$item->descripcion}}</td>
    <td>{{$item->fecharegistro}}</td>

</tr>  
@endforeach  
 
</table>


<script type="text/php">
if ( isset($pdf) ) { 
    $pdf->page_script('
        if ($PAGE_COUNT > 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 12;
            $pageText = "P谩gina " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 15;
            $x = 735;
            $pdf->text($x, $y, $pageText, $font, $size);
        } 
    ');
}

</script>
