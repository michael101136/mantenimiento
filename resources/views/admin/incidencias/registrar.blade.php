<form id="incidencia_equipo" data-parsley-validate class="form-horizontal form-label-left">
{{ csrf_field() }}
<div class="form-group">
     <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">CODIGO
    </label>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <input type="text" id="codigo" name="codigo" required="required" value="{{$codigo}}" class="form-control col-md-7 col-xs-12" readonly>
        <input type="hidden" id="idCodigo" name="idCodigo" required="required" class="form-control col-md-7 col-xs-12">
    </div>

</div>
<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">TIPOS DE INCIDENCIA
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id="equipo_incidencia" name="equipo_incidencia" class="form-control col-md-7 col-xs-12" readonly>
        <input id="id_incidencia" name="id_incidencia" class="form-control col-md-7 col-xs-12" type="hidden">
         
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <button type="button" class="btn btn-info" onclick="busquedaFunction('Incidencias ','1')"><span class="fa fa-search-plus"></span></button>
    </div>
</div>
<div class="form-group">
     <label class="control-label col-md-1 col-sm-1 col-xs-1">
        PROBLEMA
    </label>
    <div class="col-md-6 col-sm-6 col-xs-6">
         <div class="well" id="textProblema" style="text-transform: uppercase;">
        
         </div>
        <input type="hidden" id="id_problema" name="id_problema"  class="form-control col-md-7 col-xs-12" >

    </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<button type="button" class="btn btn-info" id="listarProblema"><span class="fa fa-search-plus"></span></button>
        </div>
</div>
<!--<div class="form-group">-->
<!--    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">Equipo-->
<!--    </label>-->
<!--    <div class="col-md-3 col-sm-6 col-xs-12">-->
      
<!--        <input type="text" id="equipo_padre" name="equipo_padre" class="form-control col-md-7 col-xs-12" readonly>-->
<!--        <input type="hidden" id="id_equipo" name="id_equipo" class="form-control col-md-7 col-xs-12">-->
<!--    </div>-->
<!--    <div class="col-md-3 col-sm-6 col-xs-12">-->
<!--        <button type="button" class="btn btn-info btn-xs" onclick="busquedaFunction('Equipo','2')"><span class="fa fa-search-plus"></span></button>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="form-group">-->
<!--    <label class="control-label col-md-1 col-sm-1 col-xs-1">Tienda-->
<!--    </label>-->
<!--    <div class="col-md-3 col-sm-6 col-xs-12">-->
<!--       <input id="id_tienda" name="id_tienda" class="date-picker form-control col-md-7 col-xs-12"  type="hidden" >-->
<!--        <input id="tienda" name="tienda" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly>-->
<!--    </div>-->
<!--     <div class="col-md-3 col-sm-6 col-xs-12">-->
<!--        <button type="button" class="btn btn-info btn-xs" onclick="busquedaFunction('Tienda o empresa','3')"><span class="fa fa-search-plus"></span></button>-->
<!--    </div>-->
<!--</div>-->
<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">
        OBSERV.
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <textarea id="descripcion" name="descripcion" class="md-textarea form-control" rows="3"></textarea>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">
        FECHA
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="fecha" name="fecha" value="{!! $date !!}" class="form-control" readonly>
    </div>
    
</div>


<div class="form-group">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

    <button class="btn btn-danger" type="button" id="limpiarCaja">LIMPIAR</button>
    <button type="submit" class="btn btn-success" id="create_incidencia" name="create_incidencia">GUARDAR</button>
    <button type="" class="btn btn-success" id="btnActualizar">ACTUALIZAR</button>
    <a href="/incidencias"  class="btn btn-danger" type="button">CANCELAR</a>
</div>
</div>

</form>


<div class="modal fade" id="modalBuscarProblema" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR PROBLEMA</h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_problema">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>EMPRESA</th>
                                <th>TIENDA</th>
                                <th>EQUIPO</th>
                                <th>PROBLEMA</th>
                                
                              </tr>
                          </thead>
                        </table>
                    </div>

                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

