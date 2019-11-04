<form id="form_order_servicio" name="form_order_servicio" data-parsley-validate class="form-horizontal form-label-left">
{{ csrf_field() }}

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">SUPERVISOR  </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <select class="form-control" id="id_usuario_supervisor" name="id_usuario_supervisor">
            @foreach($usuario as $item)
                 <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
     <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">CODIGO
    </label>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <input type="text" id="codigo" name="codigo"  value="{{$maxCodigo}}" required="required" class="form-control col-md-7 col-xs-12" readonly>
        <input type="hidden" id="id" name="id"   class="form-control col-md-7 col-xs-12">
    </div>


</div>
<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">PRIORIDAD </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <select class="form-control" id="prioridad" name="prioridad">
          <option value="Baja">Baja</option>
          <option value="Media">Medio</option>
          <option value="Alta">Alta</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">INCIDENCIAS PENDIENTES
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id="incidencias" name="incidencias"  class="form-control col-md-7 col-xs-12" readonly>
        <input type="hidden" id="id_incidencia" name="id_incidencia"  class="form-control col-md-7 col-xs-12">
        <input type="hidden" id="id_incidencia_preventivo" name="id_incidencia_preventivo"  class="form-control col-md-7 col-xs-12">
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <button type="button" class="btn btn-info" onclick="incidencia()"><span class="fa fa-search-plus"></span></button>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1" for="last-name">TIPO MANTE.
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input type="text" id="tipo_mantenimiento" name="tipo_mantenimiento"  class="form-control col-md-7 col-xs-12" readonly>
        <input type="hidden" id="id_tipo_mantenimiento" name="id_tipo_mantenimiento"  class="form-control col-md-7 col-xs-12">
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <button type="button" class="btn btn-info" onclick="busquedaFunction('Tipo mantenimiento ','2')"><span class="fa fa-search-plus"></span></button>
    </div>
</div>


<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">ESTADO
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
    <select class="form-control" id="estado" name="estado">
      <option value="1">Habilitado</option>
      <option value="0">Deshabilitado</option>
    </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">FECHA ORDEN
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="datepicker" name="fecha" class="form-control">
    </div>
    
</div>

<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-1">DESCRIPCION
    </label>
    <div class="col-md-3 col-sm-6 col-xs-12">
       
       <textarea rows="4" cols="200" id="descripcion" name="descripcion">
       
        </textarea>
    </div>
    
</div>


<div class="form-group">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
  
     <button type="submit" class="btn btn-success">GUARDAR</button>
     <button type="" id="btnActualizar" class="btn btn-success">ACTUALIZAR</button>
     <a href="/ordenServicio"  class="btn btn-danger" type="button">CANCELAR</a>
   
</div>
</div>

</form>




