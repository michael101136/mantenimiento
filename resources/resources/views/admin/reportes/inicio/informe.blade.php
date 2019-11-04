<html>

<head>

</head>
<body>
    @foreach($listar as $item)
<div id="contenido">
  <div id="dato" >
       <img src="../../img/tecnicor.jpg" alt="..." class="img-circle profile_img" style="width:250px; margin-left:-205px;"> 
      </div>
  <div id="cabecera">
      <div id="subcabecera">TECNICOR S.A.</div>
      <!--<div>VII-MACREPOL CUSCO-APURÍMAC/SEC-AREREHUM</div>-->
      <div>N° 001  -<?php    $fecha= date ("Y"); echo $fecha;  ?>   </div>
  </div>
  <hr/>
  
  <div id="cabecera">
      <div>FORMATO 1</div>
      <!--<div>VII-MACREPOL CUSCO-APURÍMAC/SEC-AREREHUM</div>-->
      <div style="text-transform:uppercase;">INFORME DE MANTENIMIENTO DEL EQUIPO {{$item->equipo}} </div>
  </div>
  <hr/>
  <div  id="contentable">
   
   
    <table id="tabladata" WIDTH="90%">
     
     <tr>
         <td width="30%">EMPRESA</td>
         <td >  
         {{$item->empresa}}   
         </td>          
     </tr>       
     <tr>
         <td width="30%">TIENDA</td>
         <td > {{$item->tienda}}       
         </td>          
     </tr>
     <tr>
         <td width="30%">DIRECCIÓN</td>
         <td >           
         {{$item->direccion}}
         </td>          
     </tr>
     <tr>
         <td width="30%">AREA</td>
         <td >    
         {{$item->area}}
         </td>          
     </tr>
     <tr>
         <td width="30%">EQUIPO </td>
         <td >      {{$item->equipo}}   
         </td>          
     </tr>
     <tr>
         <td width="30%">SERIE </td>
         <td align="justify">  
   {{$item->serie}}   
         </td>          
     </tr>
        <tr>
         <td width="30%">MARCA </td>
         <td align="justify">  
            {{$item->marca}}   
         </td>          
     </tr>
        <tr>
         <td width="30%">MODELO </td>
         <td align="justify">      
         {{$item->modelo}}
         </td>          
     </tr>
   </tr>
        <tr>
         <td width="30%">VOLTAJE </td>
         <td align="justify">      
         {{$item->voltaje}}
         </td>          
     </tr>
      </tr>
        <tr>
         <td width="30%">AMPERAJE </td>
         <td align="justify">      
         {{$item->amperaje}}
         </td>          
     </tr>
     <tr>
         <td width="30%">TIPO GAS  </td>
         <td > 
     {{$item->tipogas}}
         </td>          
     </tr>
     <tr>
         <td width="30%">DESCRIPCION DEL PROBLEMA  </td>

         <td >  
         {{$item->problema}}
         </td>    
        
     </tr>
    <hr/> 
    </table>
     
     <table  id="tabladata1">
          <tr>
            <td> </td>
            <td ><span style="margin-left:230px;"> Imp: 
        <?php 
            /*$fecha= date ("d/m/Y");
            echo $fecha;*/
            
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    
            echo date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
            
  echo ",";
                      $hora = new DateTime("now", new DateTimeZone('America/Lima'));
                      echo $hora->format('H:i:s') . "\n";
                    
            //Salida: Viernes 24 de Febrero del 2012
        ?></span>  </td>
          </tr>
     </table>
      <div id="fechasistema">
      
      
      
      </div>
        @endforeach
   <br/>
        
        
         <br/>
        <table id="datosusuario" WIDTH="90%">
       
          <tr>
            <td width="3%">FECHA INFORME</td>
            <td><span style="margin-left:-150px;">: <?php echo date("d/m/Y");?></span> </td>
           
         
            <td rowspan="7">
             
             
             
             
            </td>
    
          </tr>
  
          <tr>
            <td>TÉCNICO </td>
            <td><span style="margin-left:-150px;">: _______________________________</span>  </td>
          </tr>
          <!-- <tr>
            <td>FECHA</td>
            <td>: <?php echo date("d/m/Y");?></td>
          </tr> -->
          <!-- <tr>
            <td>HORA</td>
            <td>: <?php 
                    $hora = new DateTime("now", new DateTimeZone('America/Lima'));
                    echo $hora->format('H:i:s') . "\n";
                    ?>  </td>
          </tr> -->
¿
         
            <tr>
                <td  style="color:#FF0000;font-size:10px;width:500px;" colspan=2>.</td>
            </tr>
        </table>  
         
    </div>


  
  
   
          <div id="cabecera1">ADJUNTA IMAGEN DE INICIO DEL PROCESO</div><br/>
          <table id="tabladata2" WIDTH="90%">
    
     <tr>
@foreach($imagen as $item)
  
        <td >  
            <img src="../../laravel/public{{$item->urlproblema}}" alt="..." class="img-circle profile_img" style="width:250px; margin-left:-205px;"> 
        </td>  
      @endforeach    
        </tr>       

    </table>
  
</html>

<style>
   
    #dato
    {
        color: #C00;
        margin-left: 642px;
        font-size: 12px;
         font-family: sans-serif;
    }
    #cabecera
    {
        text-align:center;
        font-weight: bold;
        /*text-decoration: underline;*/
        font-size: 13.5px;
        font-family: sans-serif;
    }
     #cabecera1
    {
        text-align:left;
        font-weight: bold;
        /*text-decoration: underline;*/
        font-size: 13.5px;
        font-family: sans-serif;
        margin-left:52px;
    }
    #subcabecera
    {
         font-size: 20px; 
          font-family: sans-serif;
    }
    #tabladata
    {
        width:93%;
        /* border: red 3px solid;     */
        margin-left:38px;
        text-transform: uppercase;
        font-size: 11.5px;
        line-height: 1; 
        font-family: sans-serif;
    }
    #tabladata1
    {
        width:100%;
        /* border: red 3px solid;     */
        margin-left:40px;
        text-transform: uppercase;
        font-size: 9.5px;
        font-family: sans-serif;
    }
    #tabladata2
    {
        width:100%;
        /* border: red 3px solid;     */
        margin-left:200px;
        text-transform: uppercase;
        font-size: 9.5px;
        font-family: sans-serif;
    }
    #contentable
    {
        width:100%;
          /* border: red 3px solid;  */
    }
    
    #fechasistema
    {
      margin-left:54px;
        font-size: 9.5px;
        text-transform: uppercase;
        font-weight: bold;
        font-family: sans-serif;
    }

    #datosusuario
    {
      /*margin-left:38px;*/
      /*font-size: 13px;*/
      /* border: red 3px solid;  */
        width:50%;
 
        margin-left:38px;
        text-transform: uppercase;
        font-size: 11.5px;
        font-family: sans-serif;
    }

    #fechahorasistema
    {
      /* margin-left: 465px; */
      margin-left:38px;
      font-size: 12px;
      text-decoration: overline;
      font-family: sans-serif;

    }
    hr {
      width:650px;
    }
</style>

