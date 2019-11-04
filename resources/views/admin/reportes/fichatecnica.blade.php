<h4><center><u><strong>CANTIDAD DE PERSONAS QUE SALIERON DE COMISIONES POR UNIDAD</strong></u></center></h4>

<table border="1" style="font-size:12px;">

<tr>
<th>C贸digo</th>
<th>Unidad</th>
<th>Cantidad</th>
</tr>

<tr>
   
</tr>  
 
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
