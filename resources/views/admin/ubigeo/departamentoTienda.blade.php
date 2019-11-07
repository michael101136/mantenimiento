<div class="modal fade" id="modalBuscarUbigeo" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR UBIGEO</h4>
        </div>
        <div class="modal-body">
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_ubigeo">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>DISTRITO</th>
                                <th>PROVINCIA</th>
                                <th>DEPARTAMENTO</th>
                              </tr>
                          </thead>
                        </table>
                    </div>
                    <form method="POST"  name='add_ubicacion_tienda' id='add_ubicacion_tienda'>
                        {{ csrf_field() }}
                          <div class="form-group">
                            <input type="hidden" class="form-control" name="id_ubigeo" id="id_ubigeo">
                            <input type="hidden" class="form-control" name="id_tienda" id="id_tienda">
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                                     
                                    <input type="text" id="textUbigeo" name="textUbigeo"  class="form-control col-md-7 col-xs-12" readonly>
                            <br><br><br>
                          </div>
                         <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Dirección</label>
                                <div class="col-md-12 col-sm-6 col-xs-6">
                                     
                                    <input type="text" id="direccion" name="direccion"  class="form-control col-md-7 col-xs-12" >
                            
                                </div>

                                
                                    
                        </div><br><br><br><br><br><br><br>
                        <div class="form-group">

                            <label class="control-label col-md-1 col-sm-1 col-xs-1">PARTIDA
                            </label>
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <input id="partida" name="partida" class="date-picker form-control col-md-7 col-xs-12"  type="text" readonly>
                                <input id="id_partida" name="id_partida" class="date-picker form-control col-md-7 col-xs-12"  type="hidden">
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <button type="button" class="btn btn-info" id="buscar_partida"><span class="fa fa-search-plus"></span></button>
                            </div>

                        </div><br><br><br>
                        <div class="form-group">
                             <div class="col-md-3 col-sm-6 col-xs-12">
                                     <button type="submit" id="btnUpload1" name="btnUpload1" class="btn btn-default">AGREGAR</button>
                             </div>
                        </div>
                    </form>
                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalBuscarPartida" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR PARTIDA </h4>
        </div>
        <div class="modal-body">
       
                    <div class="container">
                        <table class="table table-striped table-bordered table-condensed" id="table_listar_partido">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>DESCRIPCION</th>
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