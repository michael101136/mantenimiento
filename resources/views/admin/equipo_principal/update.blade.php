<form id="form_equipo_update" method="post"  class="form-horizontal form-label-left" enctype="multipart/form-data">
	{{ csrf_field() }}
    <div class="form-group">
         <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">CÓDIGO
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <input type="text" id="codigo"  name="codigo"  class="form-control col-md-7 col-xs-12" readonly>
            <input type="text" id="id"  name="id" class="form-control col-md-7 col-xs-12" >
        </div>

        <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">TIPO EQUIPO
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input type="text" id="equipo_padre" name="equipo_padre"  class="form-control col-md-7 col-xs-12" readonly>
            <input type="text" id="id_equipo_padre" name="id_equipo_padre"  class="form-control col-md-7 col-xs-12" >
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
            <input type="text" id="id_marca" name="id_marca"  class="form-control col-md-7 col-xs-12" readonly>
        </div>
        <div class="col-md-1 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarMarca" readonly><span class="fa fa-search-plus"></span></button>
        </div>

        <label class="control-label col-md-1 col-sm-1 col-xs-1">TIENDA
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="tienda" name="tienda" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
            <input id="id_tienda" name="id_tienda" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <button type="button" class="btn btn-info" id="id_tiendas"><span class="fa fa-search-plus"></span></button>
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

        <label class="control-label col-md-1 col-sm-1 col-xs-1">PARTIDA
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="partida" name="partida" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
            <input id="id_partida" name="id_partida" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
        </div>

        <div class="col-md-1 col-sm-6 col-xs-12">
            <button type="button" class="btn btn-info" id="buscar_partida"><span class="fa fa-search-plus"></span></button>
        </div>

         <label class="control-label col-md-1 col-sm-1 col-xs-1">ÁREA
        </label>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input id="area" name="area" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
            <input id="id_area" name="id_area" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
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
            <input type="text" id="amperaje" name="amperaje"  class="form-control col-md-7 col-xs-12">
        </div>

 		<label class="control-label col-md-1 col-sm-1 col-xs-1">TIPO DE GAS
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
          	<!--<input type="text" id="ancho" name="ancho"  class="form-control col-md-7 col-xs-12">-->
          	 <select class="form-control" id="tipogas" name="tipogas">
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
            <input id="id_unidad" name="id_unidad" class="date-picker form-control col-md-7 col-xs-12"  type="text">
        </div>

		<div class="col-md-1 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarUnidad"><span class="fa fa-search-plus"></span></button>
        </div>

        <label class="control-label col-md-1 col-sm-1 col-xs-1">CANTIDAD
        </label>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <input type="text" id="cantidad" name="cantidad"  class="form-control col-md-7 col-xs-12">
        </div>
        <label class="control-label col-md-1 col-sm-1 col-xs-1">POTENCIA
        </label>
        <div class="col-md-2 col-sm-3 col-xs-6">
            <input type="text" id="potencia" name="potencia"  class="form-control col-md-7 col-xs-12">
        </div>
        

    </div>

  
   

    <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="text-align: center;">
                 <button type="" class="btn btn-success" id="btnActualizar">ACTUALIZAR</button>
            </div>
    </div>

</form>