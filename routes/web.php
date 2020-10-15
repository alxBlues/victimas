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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.page');

Auth::routes();



Route::middleware(['auth'])->group(function () {

  Route::get('/panel', 'HomeController@index')->name('home');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/gestion', 'HomeController@gestion')->name('gestion');

  Route::resource('atributos', 'AtributoController');

  Route::resource('grupos', 'GrupoController');

  Route::resource('variables', 'VariableController');

  Route::resource('planes', 'PlanController');
  Route::get('matriz/{plan}', 'PlanController@matriz')->name('planes.matriz');

  Route::get('ayuda', 'HomeController@ayuda')->name('ayuda');


  Route::resource('categorias', 'CategoriaController');
  Route::resource('entregables', 'EntregableController');
  Route::post('entregables', 'EntregableController@index');
  Route::post('entregables/store', 'EntregableController@store')->name('entregables.store');
  Route::get('entregables', 'EntregableController@index')->name('entregables.index');
  Route::post('entregables', 'EntregableController@index');

  // Ruta para el metodo getActividades en el controlador EstablecimientoController
  Route::get('variables/get/{id}/{tipo}', 'VariableController@getEntregables');

  Route::get('variables/{variable}/activar', 'VariableController@estado')->name('variables.estado');
  Route::get('variables/{variable}/accion', 'VariableController@verAccion')->name('variables.accion');


  //Roles
  Route::resource('roles', 'RoleController');

  //Users
  Route::resource('users', 'UserController');

  // Ruta para categorias del tipo verAcciones
  Route::get('/acciones', 'CategoriaController@indexAcciones')->name('categorias.indexAcciones');
  Route::get('/acciones/crear', 'CategoriaController@crearAcciones')->name('categorias.crearAcciones');
  Route::post('/acciones/guardar', 'CategoriaController@guardarAcciones')->name('categorias.guardarAcciones');
  Route::get('/acciones/{accion}', 'CategoriaController@verAcciones')->name('categorias.verAcciones');
  Route::get('/accioness/editar/{accion}', 'CategoriaController@editarAcciones')->name('categorias.editarAcciones');
  Route::put('/acciones/actualizar/{accion}', 'CategoriaController@actualizarAcciones')->name('categorias.actualizarAcciones');
  Route::delete('/acciones/eliminar/{accion}', 'CategoriaController@eliminarAcciones')->name('categorias.eliminarAcciones');
});


// CARACTERIZACION VICTIMAS
Route::middleware('auth')->group(function () {
  Route::get('/personas', 'PersonasController@index')->name('personas.index');
  //FOMULARIO DE BUSQUEDA DE PERSONAS
  Route::post('personas/buscar', 'PersonasController@search')->name('personas.search');
  //FORMULARIO DE CARACTERIZACION DE PERSONAS
  Route::get('/personas/registro', 'PersonasController@create')->name('personas.create');
  // VISTA DE LOS DATOS DE LA PERSONA
  Route::get('/personas/{personas}', 'PersonasController@show')->name('personas.show');
  //ALMACENAR LOS DATOS DE LAS PERSONAS
  Route::post('/personas/guardar', 'PersonasController@store')->name('personas.store');
  //EDITAR LOS DATOS DE LA PERSONA
  Route::get('/personas/editar/{personas}', 'PersonasController@edit')->name('personas.edit');
  // ACTUALIZAR LOS DATOS DE LA PERSONA
  Route::put('personas/actualizar/{personas}', 'PersonasController@update')->name('personas.update');
  // ELIMINAR PERSONAS DEL SISTEMA
  Route::get('personas/eliminar/{personas}', 'PersonasController@destroy')->name('personas.destroy');
});

// HECHOS VICTIMIZANTES

Route::middleware('auth')->group(function () {
  // VISTA PRINCIPAL DE LOS HECHOS VICTIMIZANTES
  Route::get('/hechos-victimizantes', 'HechoVictimizanteController@index')->name('hechos.index');
  // ALMACENAMIENTO DE LOS HECHOS
  Route::post('/hechos/guardar', 'HechoVictimizanteController@store')->name('hechos.store');
  // ACTUALIZACION DE LOS HECHOS
  Route::put('/hechos/actualizar/{hechoVictimizante}', 'HechoVictimizanteController@update')->name('hechos.update');
  // ELIMINACION DE DATOS
  Route::post('/hechos/eliminar/{hechoVictimizante}', 'HechoVictimizanteController@destroy')->name('hechos.destroy');
});

//TIPOS DE POBLACIÓN
Route::middleware('auth')->group(function () {
  // VISTA PRINCIPAL DEL TIPO DE POBLACION
  Route::get('/tipo-poblacion', 'TipoPoblacionController@index')->name('tipoP.index');
  // ALMACENAMIENTO DE LOS TIPOS
  Route::post('/tipo-poblacion/guardar', 'TipoPoblacionController@store')->name('tipoP.store');
  // ACTUALIZACION DE LOS TIPOS
  Route::put('/tipo-poblacion/actualizar/{tipoPoblacion}', 'TipoPoblacionController@update')->name('tipoP.update');
  // ELIMINACION DEL TIPO
  Route::post('/tipo-poblacion/eliminar/{tipoPoblacion}' . 'TipoPoblacionController@destroy')->name('tipoP.destroy');
});

// GENERO

Route::middleware('auth')->group(function () {
  // VISTA PRINCIPAL DEL GENERO
  Route::get('/genero', 'GeneroController@index')->name('genero.index');
  // ALMACENAMIENTO DE LOS GENEROS
  Route::post('/genero/guardar', 'GeneroController@store')->name('genero.store');
  // ACTUALIZACION DEL GENERO
  Route::put('/genero/actualizar/{genero}', 'GeneroController@update')->name('genero.update');
  // ELIMINACION DEL GENERO
  Route::post('/genero/eliminar/{genero}', 'GeneroController@destroy')->name('genero.destroy');
});

// ENFOQUE POBLACIONAL

Route::middleware('auth')->group(function () {
  // VISTA PRINCIPAL
  Route::get('/enfoque-poblacional', 'EnfoquePoblacionalController@index')->name('enfoqueP.index');
  // ALMACENAMIENTO
  Route::post('/enfoque-poblacional/guardar', 'EnfoquePoblacionalController@store')->name('enfoqueP.store');
  // ACTUALIZACION
  Route::put('/enfoque-poblacional/actualizar/{enfoque}', 'EnfoquePoblacionalController@update')->name('enfoqueP.update');
  // ELIMINACION
  Route::post('/enfoque-poblacional/eliminar/{enfoque}', 'EnfoquePoblacionalController@destroy')->name('enfoqueP.destroy');
});

// REGISTRO DE ATENCIONES
Route::middleware('auth')->group(function () {
  // VISTA PRINCIPAL
  Route::get('/atenciones/{persona}', 'AtencionController@index')->name('atencion.index');
  // CREAR ATENCIONES
  Route::get('/atenciones/crear/{persona}', 'AtencionController@create')->name('atencion.create');
  // ALMACENAR DATOS
  Route::post('/atenciones/guardar', 'AtencionController@store')->name('atencion.store');
  // MOSTRAR
  Route::get('/atencion/ver/{atencion}', 'AtencionController@show')->name('atencion.show');

  // EDITAR
  Route::get('/atenciones/editar/{atencion}', 'AtencionController@edit')->name('atencion.edit');
  // ACTUALIZAR
  Route::put('/atenciones/actualizar/{atencion}', 'AtencionController@update')->name('atencion.update');
  // ELIMINAR
  Route::post('/atenciones/eliminar/{atencion}', 'AtencionController@destroy')->name('atencion.destroy');
});

// REGISTRO DE ATENCION PSICOSOCIAL
Route::middleware('auth')->group(function () {
  // CREAR ATENCIONES
  Route::get('/atencion-psicosocial/crear/{persona}', 'AtencionPsicosocialController@create')->name('psicosocial.create');
  // MOSTRAR
  Route::get('/atencion-psicosocial/ver/{atencionPsicosocial}', 'AtencionPsicosocialController@show')->name('psicosocial.show');
  // GUARDAR
  Route::post('atencion-psicosocial/guardar', 'AtencionPsicosocialController@store')->name('psicosocial.store');
  // EDITAR
  Route::get('/atencion-psicosocial/editar/{atencionPsicosocial}', 'AtencionPsicosocialController@edit')->name('psicosocial.edit');
  // ACTUALIZAR
  Route::put('/atencion-psicosocial/actualizar', 'AtencionPsicosocialController@update')->name('psicosocial.update');
  // ELIMINAR
  Route::post('/atencion-psicosocial/eliminar/{atencionPsicosocial}', 'AtencionPsicosocialController@destroy')->name('psicosocial.destroy');
});

// REGISTRO DE BENEFICIARIOS
Route::middleware('auth')->group(function () {
  // CREAR
  Route::get('/beneficiarios/crear/{persona}', 'BeneficiarioController@create')->name('beneficiarios.create');
  // VER
  Route::get('/beneficiarios/ver/{beneficiario}', 'BeneficiarioController@show')->name('beneficiarios.show');
  // GUARDAR
  Route::post('/beneficiarios/guardar', 'BeneficiarioController@store')->name('beneficiarios.store');
  // EDITAR
  Route::get('/beneficiarios/editar/{beneficiario}', 'BeneficiarioController@edit')->name('beneficiarios.edit');
  // ACTUALIZAR
  Route::put('/beneficiarios/actualizar/{beneficiario}', 'BeneficiarioController@update')->name('beneficiarios.update');
  // ELIMINAR
  Route::post('/beneficiarios/eliminar/{beneficiario}', 'BeneficiarioController@destroy')->name('beneficiarios.destroy');
});


// REGISTRO DE AYUDAS ADMINISTRACION
Route::middleware('auth')->group(function () {
  // VER
  Route::get('/ajustes/gestionayudas/index', 'GestionayudasController@index')->name('gestionayudas.index');
  // GUARDAR
  Route::post('/ajustes/gestionayudas/guardar', 'GestionayudasController@store')->name('gestionayudas.store');
  // EDITAR
  Route::get('/ajustes/gestionayudas/editar/{gestionayuda}', 'GestionayudasController@edit')->name('gestionayudas.edit');
  // ACTUALIZAR
  Route::put('/ajustes/gestionayudas/actualizar/{gestionayuda}', 'GestionayudasController@update')->name('gestionayudas.update');
  // ELIMINAR
  Route::post('/ajustes/gestionayudas/eliminar/{gestionayuda}', 'GestionayudasController@destroy')->name('gestionayudas.destroy');
});

// REGISTRO DE BENEFICIARIOS
Route::middleware('auth')->group(function () {
  // VER
  Route::get('/atencion-al-usuario/ayudas/show/{id_victima}', 'AyudaVictimasController@show')->name('ayudavictimas.show');
  // GUARDAR
  Route::post('/atencion-al-usuario/ayudas/guardar', 'AyudaVictimasController@store')->name('ayudavictimas.store');
});

// Generar PAT en Excel
Route::get('/exportar', 'ExcelPatController@export');


// SEGUIMIENTO DE AYUDAS VICTIMAS
Route::middleware('auth')->group(function () {
  // VER
  Route::get('/atencion-al-usuario/seguimientoayudas/show/{id_victima}', 'SeguimientoAyudasController@show')->name('seguimientoayudavictimas.show');
  // GUARDAR
  Route::post('/atencion-al-usuario/seguimientoayudas/guardar', 'SeguimientoAyudasController@store')->name('seguimientoayudavictimas.store');
});


// ACIONES DE COMITE
Route::middleware('auth')->group(function () {
  // VISTA PRINCIPAL
  Route::get('/Comite/index', 'ComiteController@index')->name('comite.index');
  // VER
  Route::get('/Comite/show/{id_comite}', 'ComiteController@show')->name('comite.show');
  // BUSCAR VISTA
  Route::get('/Comite/Bucar', 'ComiteController@searchview')->name('comite.searchview');
  // BUSCAR
  Route::post('/Comite/Bucar', 'ComiteController@search')->name('comite.search');
  // GUARDAR
  Route::post('/Comite/guardar', 'ComiteController@store')->name('comite.store');
});

// ACIONES DE ATENCION JURIDICA
Route::middleware('auth')->group(function () {
  // GUARDAR
  Route::post('/atencionJuridica/guardar', 'AtencionJuridicaController@store')->name('atencionJuridica.store');
});

// ACIONES DE BITACORA
Route::middleware('auth')->group(function () {
  // GUARDAR
  Route::post('/bitacora/guardar', 'BitacoraController@store')->name('bitacora.store');
  // ACTUALIZAR
  Route::put('/bitacora/actualizar/{gestionayuda}', 'BitacoraController@update')->name('bitacora.update');
});



// ACIONES DE ACUERDO DE CONFIDENCIALIDAD Y ACTUALIZACION DE DATOS
Route::middleware('auth')->group(function () {
  // ACEPTAR ACUERDO DE CONFIDENCIALIDAD
  Route::post('/actualizardatos/acepConfidencialidad', 'HomeController@acepConfidencialidad')->name('actualizardatos.acepConfidencialidad');

  // ACTUALIZACION DATOS PERSONALES
  Route::post('/actualizardatos/datosPersonales', 'HomeController@actuDataUser')->name('actualizardatos.datosPersonales');

  // vista documento de conidencialidad
  Route::get('/actualizardatos/documentoConfidencialidad', 'HomeController@documentoConfidencialidad')->name('actualizardatos.documentoConfidencialidad');

  // descargar documento de conidencialidad
  Route::get('/descargar/documentoConfidencialidad', 'HomeController@descargarPdfConfidencialidad')->name('descargar.DC');

  // Cargar Acuerdo
  Route::put('/Acuerdo/cargar', 'AcuerdoConfidenController@store')->name('acuerdo.cargar');

  // Bucar y ver acerdos buscador
  Route::get('/Acuerdo/Buscar', 'AcuerdoConfidenController@index')->name('acuerdo.buscar');

  // Bucar y ver acerdos consulta
  Route::post('/Acuerdo/Buscar', 'AcuerdoConfidenController@buscarAcuerdo')->name('acuerdo.buscar.consulta');
});

// PERFIL DE USUARIO
Route::middleware('auth')->group(function () {
  // ACEPTAR ACUERDO DE CONFIDENCIALIDAD
  Route::get('/perfil', 'PerfilUsuarioController@index')->name('perfil.index');

  // ACTUALIZACION DATOS PERSONALES
  Route::put('/perfil/editar', 'PerfilUsuarioController@update')->name('perfil.editar');

  // CAMBIAR EL ESTADO
  Route::get('/perfil/cambiarEstado/{id}', 'PerfilUsuarioController@estadoUser')->name('perfil.estado');
});
