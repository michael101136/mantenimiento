<h4><center><u><strong>LISTADO DE EQUIPOS</strong></u></center></h4>

<table border="1" style="font-size:12px;">

<tr>
<th>Tipo equipo</th>
<th>Marcas</th>
<th>Descripcion</th>
<th>Modelo</th>
<th>Peso</th>
<th>Altura</th>
<th>Ancho</th>
<th>Largo</th>
</tr>

@foreach($listar as $item)
<tr>
    <td>{{$item->tipoequipo}}</td>
    <td>{{$item->marcas}}</td>
    <td>{{$item->descripcion}}</td>     
    <td>{{$item->modelo}}</td>
    <td>{{$item->peso}}</td>
    <td>{{$item->altura}}</td>
    <td>{{$item->ancho}}</td>
    <td>{{$item->largo}}</td>
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
