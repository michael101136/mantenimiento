<form id="form_equipo" method="post"  class="form-horizontal form-label-left" enctype="multipart/form-data">
	{{ csrf_field() }}
    <div class="form-group">
         <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">CÓDIGO
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <input type="text" id="codigo"  name="codigo" value="{{$max}}" class="form-control col-md-7 col-xs-12" readonly>
            <input type="hidden" id="id"  name="id" class="form-control col-md-7 col-xs-12" >
        </div>
       
    </div>
    <div class="form-group">
        <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">TIPO EQUIPO
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input type="text" id="equipo_padre" name="equipo_padre"  class="form-control col-md-7 col-xs-12" readonly>
            <input type="hidden" id="id_equipo_padre" name="id_equipo_padre"  class="form-control col-md-7 col-xs-12" >
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarTipoEquipo"><span class="fa fa-search-plus"></span></button>
        </div>
    </div>

  	<div class="form-group">
        <label class="control-label col-md-1 col-sm-1 col-xs-1">MARCA
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="marca" name="marca" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
            <input type="hidden" id="id_marca" name="id_marca"  class="form-control col-md-7 col-xs-12" >
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarMarca"><span class="fa fa-search-plus"></span></button>
        </div>

    </div>

    <div class="form-group">
        <label class="control-label col-md-1 col-sm-1 col-xs-1">DESCRIPCIÓN
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="descripcion" name="descripcion" class="date-picker form-control col-md-7 col-xs-12"  type="text" >
        </div>
    </div>

 

    <div class="form-group">

        <label class="control-label col-md-1 col-sm-1 col-xs-1">TIENDA
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="tienda" name="tienda" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
            <input id="id_tienda" name="id_tienda" class="date-picker form-control col-md-7 col-xs-12"  type="hidden">
        </div>

		<div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="id_tiendas"><span class="fa fa-search-plus"></span></button>
        </div>

    </div>
     <div class="form-group">

        <label class="control-label col-md-1 col-sm-1 col-xs-1">ÁREA
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="area" name="area" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
            <input id="id_area" name="id_area" class="date-picker form-control col-md-7 col-xs-12"  type="hidden">
        </div>

		<div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarArea"><span class="fa fa-search-plus"></span></button>
        </div>

    </div>

    <div class="form-group">
         <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">MODELO
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <input type="text" id="modelo"  name="modelo"  class="form-control col-md-7 col-xs-12">
        </div>

 		<label class="control-label col-md-1 col-sm-1 col-xs-1">SERIE
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
          	<input type="text" name="peso" id="peso"  class="form-control col-md-7 col-xs-12">
        </div>
		<label class="control-label col-md-1 col-sm-1 col-xs-1">VOLTAJE
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
          	<input type="text" id="peso_envio" name="peso_envio"  class="form-control col-md-7 col-xs-12">
        </div>

    </div>
    <div class="form-group">
         <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">AMPERAJE
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <input type="text" id="altura" name="altura"  class="form-control col-md-7 col-xs-12">
        </div>

 		<label class="control-label col-md-1 col-sm-1 col-xs-1">TIPO DE GAS
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
          	<!--<input type="text" id="ancho" name="ancho"  class="form-control col-md-7 col-xs-12">-->
          	 <select class="form-control" id="ancho" name="ancho">
          	  <option value="NINGUNO">NINGUNO</option>
              <option value="GN">GN</option>
              <option value="GLP">GLP</option>
              <option value="OTROS">OTROS</option>
            </select>
        </div>
		<label class="control-label col-md-1 col-sm-1 col-xs-1">LARGO
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
          	<input type="text" id="largo" name="largo"  class="form-control col-md-7 col-xs-12">
        </div>

    </div>

    <div class="form-group">

        <label class="control-label col-md-1 col-sm-1 col-xs-1">UNIDAD DE MEDIDA
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="umedimens" name="umedimens" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
            <input id="id_unidad" name="id_unidad" class="date-picker form-control col-md-7 col-xs-12"  type="hidden">
        </div>

		<div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarUnidad"><span class="fa fa-search-plus"></span></button>
        </div>

    </div>

    <div class="form-group">
        <!-- <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">UNIDAD MEDIDA MEDICIÓN-->
        <!--</label>-->
        <!--<div class="col-md-3 col-sm-3 col-xs-6">-->
        <!--    <input type="text" id="umedimens" name="umedimens"  class="form-control col-md-7 col-xs-12">-->
        <!--</div>-->

 		<label class="control-label col-md-1 col-sm-1 col-xs-1">CANTIDAD
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
          	<input type="text" id="cantidad" name="cantidad"  class="form-control col-md-7 col-xs-12">
        </div>
		<label class="control-label col-md-1 col-sm-1 col-xs-1">POTENCIA
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
          	<input type="text" id="potencia" name="potencia"  class="form-control col-md-7 col-xs-12">
        </div>
        
        <!--<div class="col-md-3 col-sm-3 col-xs-6"><br><br>-->
        <!--     <input type="file" name="photo_name" id="photo_name" required=""> -->
        <!--</div>-->
    

    </div>
   
 <!--   <div class="ln_solid"></div>-->
 <!--   Centro de costo-->
	<!--<div class="ln_solid"></div>-->
	<!--<div class="form-group">-->
 <!--       <label class="control-label col-md-1 col-sm-1 col-xs-1">Piezas -->
 <!--       </label>-->
 <!--       <div class="col-md-3 col-sm-6 col-xs-12">-->
 <!--           <input id="pieza" class="date-picker form-control col-md-7 col-xs-12"  type="text">-->
 <!--       </div>-->
 <!--        <div class="col-md-3 col-sm-6 col-xs-12">-->
 <!--       	<button type="button" class="btn btn-info btn-xs" onclick="busquedaFunction('Piezas','6')"><span class="fa fa-search-plus"></span></button>-->
 <!--       </div>-->
 <!--   </div>-->
 <!--   <div class="form-group">-->
 <!--       <label class="control-label col-md-1 col-sm-1 col-xs-1">M. Obra -->
 <!--       </label>-->
 <!--       <div class="col-md-3 col-sm-6 col-xs-12">-->
 <!--           <input id="m_obra" name="m_obra" class="date-picker form-control col-md-7 col-xs-12"  type="text">-->
 <!--       </div>-->
 <!--       <div class="col-md-3 col-sm-6 col-xs-12">-->
 <!--       	<button type="button" class="btn btn-info btn-xs" onclick="busquedaFunction('M. Obra ','7')"><span class="fa fa-search-plus"></span></button>-->
 <!--       </div>-->
 <!--   </div>-->
	<!--<div class="form-group">-->
 <!--       <label class="control-label col-md-1 col-sm-1 col-xs-1">Costo Misc. -->
 <!--       </label>-->
 <!--       <div class="col-md-3 col-sm-6 col-xs-12">-->
 <!--           <input id="costo_mis" name="costo_mis" class="date-picker form-control col-md-7 col-xs-12"  type="text">-->
 <!--       </div>-->
 <!--       <div class="col-md-3 col-sm-6 col-xs-12">-->
 <!--       	<button type="button" class="btn btn-info btn-xs" onclick="busquedaFunction('Costo Misc.','8')"><span class="fa fa-search-plus"></span></button>-->
 <!--       </div>-->
 <!--   </div>-->

    <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button class="btn btn-danger" type="button" id="limpiarCaja">LIMPIAR</button>
        <button type="submit" class="btn btn-primary">GUARDAR</button>
        <button type="" class="btn btn-success" id="btnActualizar">ACTUALIZAR</button>
         <a href="/equipoPrincipal"  class="btn btn-danger" type="button">CANCELAR</a>
    </div>
    </div>

</form>



