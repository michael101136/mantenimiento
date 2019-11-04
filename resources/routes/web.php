<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/inicio', function () {
//     return view('welcome');
// });
Route:: POST('/images-save', 
[
	'uses' => 'EquipoController@storeImagen',
	'as' => 'equipo.save'
]);

Route:: POST('/problema-save', 
[
	'uses' => 'ProblemaController@storeImagen',
	'as' => 'problema.save'
]);
Route::get('image/listar_problemas/{id?}', [ 'uses' => 'ProblemaController@listarImagenes' ])->name('listarImagenesProblema');

Route::get('image/delete_problema/{id?}',[ 'uses' => 'ProblemaController@EliminarImagenes_problema' ])->name('EliminarImagenes_problema');

Route:: POST('/programacion-save', 
[
	'uses' => 'ProgramacionOrdenController@storeImagen',
	'as' => 'programacion.save'
]);
Route::get('image/listar_imagen_programacion/{id?}', [ 'uses' => 'ProgramacionOrdenController@listarImagenes' ])->name('listarImagenesProgramacion');
Route::get('image/delete_imagen_programacion/{id?}',[ 'uses' => 'ProgramacionOrdenController@EliminarImagenes_problema' ])->name('EliminarImagenes_programacion');



Route::get('/','ControllerInicio@inicio');
Route::get('/inicio','ControllerInicio@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pdf', 'HomeController@pdf')->name('pdf');

Route::resource('ponentes', 'PonenteController');
Route::get('mis-ponentes','PonenteController@getPonentes');
Route::post('guardar-ponentes','PonenteController@guardar');

Route::resource('nuevos', 'nuevoController');

Route::resource('usuarios', 'UsuarioController');
Route::get('users-list', 'UsuarioController@usersList'); 
Route::resource('tipoMantenimientos', 'tipo_mantenimientoController');
Route::resource('areas', 'AreaController');

Route::post('CrearEquipoPrincipal/', [ 'uses' => 'EquipoController@CrearEquipoPrincipal' ])->name('CrearEquipoPrincipal');
Route::post('BuscarEquipoPrincipal/', [ 'uses' => 'EquipoController@BuscarEquipoPrincipal' ])->name('BuscarEquipoPrincipal');
Route::post('ActualizarEquipoPrincipal/', [ 'uses' => 'EquipoController@ActualizarEquipoPrincipal' ])->name('ActualizarEquipoPrincipal');
Route::post('listarEquipos/', [ 'uses' => 'EquipoController@listarEquipos' ])->name('listarEquipos');
Route::resource('equipos', 'EquipoController');
Route::get('equipo_listar', 'EquipoController@equipo_listar'); 

Route::GET('listarMarcas/{id?}', [ 'uses' => 'MarcaController@listarMarcas' ])->name('listarMarcas');
Route::resource('marcas', 'MarcaController');

Route::resource('unidadMedidas', 'Unidad_medidaController');

Route::resource('tipoEquipos', 'Tipo_equipoController');
Route::get('listarEquipoCategoria', [ 'uses' => 'Tipo_equipoController@listarEquipoCategoria' ])->name('listarEquipoCategoria');

Route::resource('ubicacions', 'UbicacionController');
Route::resource('tipoInformes', 'Tipo_informeController');
Route::resource('categorias', 'CategoriaController');

//Seguimiento

Route::resource('seguimiento','SeguimientoController');
//fin seguimiento

//Equipo proceso
Route::resource('equipoPrincipal', 'EquipoPrincipal');
//Fin equipo proceso

Route::post('listarEmpresas/', [ 'uses' => 'EmpresaController@listarEmpresas' ])->name('listarEmpresas');
Route::resource('empresas', 'EmpresaController');
Route::get('/listar_Empresa/{id_ubigeo?}', 'EmpresaController@listar_Empresa'); 
Route::get('/listar_partida', 'EmpresaController@listado_categorias_partida'); 
Route::get('/listar_ubigeoEmpresa/{id_empresa}', 'EmpresaController@listar_ubigeoEmpresa'); 

Route::get('/listar_partida_Tienda/{id_tienda}', 'TiendaController@listar_partida_Tienda'); 
Route::get('/listar_partida_all', 'EmpresaController@listar_partida_all'); 
Route:: POST('/saveUbigeo', 
[
	'uses' => 'EmpresaController@saveUbigeoEmpresa',
	'as' => 'save.ubigeo'
]);
Route:: POST('/savePartida', 
[
	'uses' => 'EmpresaController@savePartida',
	'as' => 'save.partida'
]);



Route::get('area_listar', [ 'uses' => 'AreaController@area_listar' ])->name('area_listar');

Route::get('unidad_listar', [ 'uses' => 'Unidad_medidaController@unidad_listar' ])->name('unidad_listar');


Route::get('ubigeo_listar', 'EmpresaController@ubigeo_listar'); 

Route::get('empresa_listar', 'TiendaController@empresa_listar'); 

Route::get('tipos_equipos_listar','MarcaController@tipos_equipos_listar');

Route::get('problema_listar','Equipo_incidenciaController@problema_listar');


Route::resource('logiProveedores', 'Logi_ProveedoresController');

Route::resource('paises', 'PaisesController');

Route::post('listarPaises/', [ 'uses' => 'PaisesController@listarPaises' ])->name('listarPaises');
Route::resource('frecuencias', 'FrecuenciaController');

Route::post('listarTipos/', [ 'uses' => 'TipoController@listarTipos' ])->name('listarTipos');




//ORDEN DE SERVICIOS PREVNTIVO
Route::get('ordenPreventivo','OrdenServicioController@listarPreventivo');
//FIN 
//PROCESO DE INCIDENCIAS

Route::resource('incidencias', 'IncidenciasController');

Route::get('BuscarOrdenServicios/buscar', [ 'uses' => 'OrdenServicioController@BuscarOrdenServicios' ])->name('BuscarOrdenServicios');
Route::get('BuscarOrdenServicios','OrdenServicioController@BuscarOrdenServicios');

Route::post('ordenServicio/create', [ 'uses' => 'OrdenServicioController@ordenServicioCreate' ])->name('ordenServicioCreate');
Route::post('ordenServicio/actualizar', [ 'uses' => 'OrdenServicioController@ordenServicioActualizar' ])->name('ordenServicioActualizar');
Route::resource('ordenServicio','OrdenServicioController');

Route::resource('programarOrdenServicio','ProgramacionOrdenController');
Route::post('programacion/create', [ 'uses' => 'ProgramacionOrdenController@programacionCreate' ])->name('programacionCreate');
//FIN

Route::resource('tipos', 'TipoController');

Route::post('listarIncidencias/', [ 'uses' => 'TipoIncidenciaController@listarIncidencias' ])->name('listarIncidencias');
Route::resource('tipoIncidencias', 'TipoIncidenciaController');
Route::get('listarIncidenciasPendientes/', [ 'uses' => 'Equipo_incidenciaController@listarIncidenciasPendientes' ])->name('listarIncidenciasPendientes');
Route::get('listarIncidenciasPreventivos/', [ 'uses' => 'Equipo_incidenciaController@listarIncidenciasPreventivos' ])->name('listarIncidenciasPreventivos');

Route::post('listarTipoMantenimiento/', ['uses' =>'OrdenServicioController@listarTipoMantenimiento'])->name('listarTipoMantenimiento');

Route::get('listarIncidenciasPreventivosProgramacion/', [ 'uses' => 'OrdenServicioController@listarIncidenciasPreventivosProgramacion' ])->name('listarIncidenciasPreventivosProgramacion');


Route::get('listarTiendas','TiendaController@listarTiendas');
Route::get('listarTiendasPartidad','TiendaController@listarTiendasPartidad');
Route::get('/listar_tienda/{id_empresa?}', 'TiendaController@listar_tienda'); 

Route::post('crearIncidencia/', [ 'uses' => 'Equipo_incidenciaController@crearIncidencia' ])->name('crearIncidencia_equipo');
Route::post('BuscarIncidencia/', [ 'uses' => 'Equipo_incidenciaController@BuscarIncidencia' ])->name('BuscarIncidencia');
Route::post('ActualizarIncidencia/', [ 'uses' => 'Equipo_incidenciaController@ActualizarIncidencial' ])->name('ActualizarIncidencia');
Route::resource('equipo_incidenciaController', 'Equipo_incidenciaController');

Route::get('/listarproblemas', [ 'uses' => 'ProblemaController@index' ])->name('listarproblemas');
Route::get('/crearproblemas', [ 'uses' => 'ProblemaController@create' ])->name('crearproblemas');

//Mantenimiento preventivo
Route::get('/listarticket', [ 'uses' => 'TicketController@index' ])->name('listarticket');
Route::get('/crearticket', [ 'uses' => 'TicketController@create' ])->name('crearticket');
Route::resource('ticket','TicketController');
//Fin mantenimiento preventivo

Route::resource('problemas','ProblemaController');

Route::resource('tipoIncidencias', 'TipoIncidenciaController');

Route::resource('medidors', 'MedidorController');
Route::post('listarMedidor/',['uses' =>'MedidorController@listarMedidor'])->name('listarMedidor');


Route::resource('tiendas', 'TiendaController');

Route::resource('tipoProgramacions', 'Tipo_programacionController');

//programacion_usuario
Route::post('listarUsuarioProgramacion/',['uses' =>'ProgramacionOrdenController@listarUsuarioProgramado'])->name('listarUsuarioProgramado');
Route::post('buscarProgramacion/',['uses' =>'ProgramacionOrdenController@buscarProgramacion'])->name('buscarProgramacion');
Route::post('cambiarProgramacion_user_Estado/',['uses' =>'ProgramacionOrdenController@cambiarProgramacion_user_Estado'])->name('cambiarProgramacion_user_Estado');
Route::post('Programacion_avance/',['uses' =>'ProgramacionOrdenController@Programacion_avance'])->name('Programacion_avance');
Route::post('Programacion_avance_listar_user/',['uses' =>'ProgramacionOrdenController@Programacion_avance_listar_user'])->name('Programacion_avance_listar_user');

//REPORTES

Route::get('/pdfEquipo', 'EquipoController@pdfListarEquipo')->name('pdfEquipo');
Route::get('/pdfProblemas', 'ProblemaController@pdflistarproblemas')->name('pdfProblemas');
Route::get('/pdfIncidencias', 'IncidenciasController@pdfListarIncidencias')->name('pdfIncidencias');
Route::get('/pdfSeguimiento', 'SeguimientoController@pdfListarSeguimiento')->name('pdfSeguimiento');
// Route::get('/detalleSeguimiento', 'SeguimientoController@pdfDetalleSeguimiento')->name('detalleSeguimiento');
Route::get('/detalleSeguimiento/{id?}','SeguimientoController@pdfDetalleSeguimiento')->name('detalleSeguimiento');
Route::get('/detalleSeguimientoProceso/{id?}','SeguimientoController@pdfDetalleSeguimientoProceso')->name('detalleSeguimientoProceso');

Route::get('/detalleSeguimientoFin/{id?}','SeguimientoController@pdfDetalleSeguimientoFin')->name('detalleSeguimientoFin');
