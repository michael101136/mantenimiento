@extends('admin.layout.master')

@section('content')

 <div class="right_col" role="main">
 <section class="content-header">
	<div class="form-group">
		 
		   <div class="col-md-6 col-sm-3 col-xs-6">
		       
          
		  </div>

       <div class="col-md-6 col-sm-3 col-xs-6">
          
          <div class="col-md-6 col-sm-3 col-xs-6">
             <input type="text" class="form-control" id="codigo_programacion" name="codigo_programacion" placeholder="Buscar programacion" >
           </div>
          <div class="col-md-6 col-sm-3 col-xs-6">
                <button id="btn_buscar_programacion" name="btn_buscar_programacion" class="btn btn-success" >Buscar</button>
           </div>

      </div>
	</div>

    </section>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                <div class="x_content">

                  	 

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Principal</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <button id="id_ordenServicio" name="id_ordenServicio" class="btn btn-success" >BUSCAR ORDEN</button>
                           </div>
 					 		@include('admin.programarOrden.registrar')
		                      
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <p>2</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p> 3</p>
                        </div>
                    </div>
                    </div>

                    </div>

                </div>
              </div>

            </div>
        </div>

@endsection


<div class="modal fade" id="Busquedas" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">Busqueda</h4>
        </div>
        <div class="modal-body">
       
                    <table id="inicioDatable" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Descripcion</th> 
                        </tr>
                      </thead>
                      <tbody id="tableListar" name="tableListar">
                       
                        
                      </tbody>
                    </table>
                  </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="ModalOrdenServicios" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="busquedaTitulo" name="busquedaTitulo">BUSCAR ORDEN</h4>
        </div>
        <div class="modal-body">
                    <select class="form-control" id="preventivo" name="preventivo">
                          <option value="otros">Otros</option>
                          <option value="preventivo" >Preventivo</option>
                    </select><br>
                    <div class="container" id="contenedor_preventivo">
                        <table class="table table-striped table-bordered table-condensed" id="Listar_orden">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>EMPRESA</th>
                                <th>TIENDA</th>
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
@section('script')


<script>

</script>

@endsection


