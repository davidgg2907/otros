<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

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

Route::post('/login', 'LoginController@index');

Route::get('/logout', function (){
    Auth::logout();
    Session::flush();
    return redirect('/');
});

Route::get('/generator', 'GeneratorController@index');

Route::post('/generator/add', 'GeneratorController@add');

Route::post('/generator/getKeyValue', 'GeneratorController@getKeyValue');

Route::post('/generator/getFields', 'GeneratorController@getFields');

// BO : Users
Route::post("/admin/users/deleteAll", "admin\UsersController@deleteAll")->middleware('auth');
Route::get("/admin/users", "admin\UsersController@index")->middleware('auth');
Route::get("/admin/users/add", "admin\UsersController@getAdd")->middleware('auth');
Route::post("/admin/users/add", "admin\UsersController@postAdd")->middleware('auth');
Route::get("/admin/users/edit/{id}", "admin\UsersController@getEdit")->middleware('auth');
Route::get("/admin/users/status/{field}/{id}", "admin\UsersController@status")->middleware('auth');
Route::get("/admin/users/export/{type}", "admin\UsersController@getExport")->middleware('auth');
Route::post("/admin/users/edit", "admin\UsersController@postEdit")->middleware('auth');
Route::post("/admin/users/delete", "admin\UsersController@delete")->middleware('auth');
Route::get("/admin/users/view/{id}", "admin\UsersController@view")->middleware('auth');
Route::get("/admin/users/baja/{id}", "admin\UsersController@baja")->middleware('auth');
Route::get("/admin/users/alta/{id}", "admin\UsersController@alta")->middleware('auth');

Route::get("/admin/users/perfil", "admin\UsersController@getPerfil")->middleware('auth');
Route::post("/admin/users/perfil", "admin\UsersController@postPerfil")->middleware('auth');
//  EO : Users

// BO : Roles
Route::post("/admin/roles/deleteAll", "admin\RolesController@deleteAll")->middleware('auth');
Route::get("/admin/roles", "admin\RolesController@index")->middleware('auth');
Route::get("/admin/roles/add", "admin\RolesController@getAdd")->middleware('auth');
Route::post("/admin/roles/add", "admin\RolesController@postAdd")->middleware('auth');
Route::get("/admin/roles/edit/{id}", "admin\RolesController@getEdit")->middleware('auth');
Route::get("/admin/roles/status/{field}/{id}", "admin\RolesController@status")->middleware('auth');
Route::get("/admin/roles/export/{type}", "admin\RolesController@getExport")->middleware('auth');
Route::post("/admin/roles/edit", "admin\RolesController@postEdit")->middleware('auth');
Route::post("/admin/roles/delete", "admin\RolesController@delete")->middleware('auth');
Route::get("/admin/roles/view/{id}", "admin\RolesController@view")->middleware('auth');
Route::get("/admin/roles/baja/{id}", "admin\RolesController@baja")->middleware('auth');
Route::get("/admin/roles/alta/{id}", "admin\RolesController@view")->middleware('auth');
  //  EO : Roles



// BO : Configuracion
Route::post("/admin/configuracion/deleteAll", "admin\ConfiguracionController@deleteAll")->middleware('auth');
Route::get("/admin/configuracion", "admin\ConfiguracionController@index")->middleware('auth');
Route::get("/admin/configuracion/add", "admin\ConfiguracionController@getAdd")->middleware('auth');
Route::post("/admin/configuracion/add", "admin\ConfiguracionController@postAdd")->middleware('auth');
Route::get("/admin/configuracion/edit/{id}", "admin\ConfiguracionController@getEdit")->middleware('auth');
Route::get("/admin/configuracion/status/{field}/{id}", "admin\ConfiguracionController@status")->middleware('auth');
Route::get("/admin/configuracion/export/{type}", "admin\ConfiguracionController@getExport")->middleware('auth');
Route::post("/admin/configuracion/edit", "admin\ConfiguracionController@postEdit")->middleware('auth');
Route::post("/admin/configuracion/delete", "admin\ConfiguracionController@delete")->middleware('auth');
Route::get("/admin/configuracion/view/{id}", "admin\ConfiguracionController@view")->middleware('auth');
Route::get("/admin/configuracion/baja/{id}", "admin\ConfiguracionController@baja")->middleware('auth');
Route::get("/admin/configuracion/alta/{id}", "admin\ConfiguracionController@alta")->middleware('auth');
Route::get("/admin/configuracion/ajax/{id}", "admin\ConfiguracionController@getAjax")->middleware('auth');
  //  EO : Configuracion



		// BO : Medicos
	  Route::post("/admin/medicos/deleteAll", "admin\MedicosController@deleteAll")->middleware('auth');
	  Route::get("/admin/medicos", "admin\MedicosController@index")->middleware('auth');
		Route::get("/admin/medicos/add", "admin\MedicosController@getAdd")->middleware('auth');
		Route::post("/admin/medicos/add", "admin\MedicosController@postAdd")->middleware('auth');
		Route::get("/admin/medicos/edit/{id}", "admin\MedicosController@getEdit")->middleware('auth');
		Route::get("/admin/medicos/status/{field}/{id}", "admin\MedicosController@status")->middleware('auth');
		Route::get("/admin/medicos/export/{type}", "admin\MedicosController@getExport")->middleware('auth');
		Route::post("/admin/medicos/edit", "admin\MedicosController@postEdit")->middleware('auth');
		Route::post("/admin/medicos/delete", "admin\MedicosController@delete")->middleware('auth');
		Route::get("/admin/medicos/view/{id}", "admin\MedicosController@view")->middleware('auth');
		Route::get("/admin/medicos/baja/{id}", "admin\MedicosController@baja")->middleware('auth');
		Route::get("/admin/medicos/alta/{id}", "admin\MedicosController@alta")->middleware('auth');
		Route::get("/admin/medicos/ajax/{id}", "admin\MedicosController@getAjax")->middleware('auth');
    Route::get("/admin/medicos/search/", "admin\MedicosController@getSearch")->middleware('auth');
    //  EO : Medicos



		// BO : Citas
	  Route::post("/admin/citas/deleteAll", "admin\CitasController@deleteAll")->middleware('auth');
	  Route::get("/admin/citas", "admin\CitasController@index")->middleware('auth');
		Route::get("/admin/citas/add", "admin\CitasController@getAdd")->middleware('auth');
		Route::post("/admin/citas/add", "admin\CitasController@postAdd")->middleware('auth');
		Route::get("/admin/citas/edit/{id}", "admin\CitasController@getEdit")->middleware('auth');
		Route::get("/admin/citas/status/{field}/{id}", "admin\CitasController@status")->middleware('auth');
		Route::get("/admin/citas/export/{type}", "admin\CitasController@getExport")->middleware('auth');
		Route::post("/admin/citas/edit", "admin\CitasController@postEdit")->middleware('auth');
		Route::post("/admin/citas/delete", "admin\CitasController@delete")->middleware('auth');
		Route::get("/admin/citas/view/{id}", "admin\CitasController@view")->middleware('auth');
		Route::get("/admin/citas/baja/{id}", "admin\CitasController@baja")->middleware('auth');
		Route::get("/admin/citas/alta/{id}", "admin\CitasController@alta")->middleware('auth');
		Route::get("/admin/citas/ajax/{id}", "admin\CitasController@getAjax")->middleware('auth');
	    //  EO : Citas



		// BO : Consultorios
	  Route::post("/admin/consultorios/deleteAll", "admin\ConsultoriosController@deleteAll")->middleware('auth');
	  Route::get("/admin/consultorios", "admin\ConsultoriosController@index")->middleware('auth');
		Route::get("/admin/consultorios/add", "admin\ConsultoriosController@getAdd")->middleware('auth');
		Route::post("/admin/consultorios/add", "admin\ConsultoriosController@postAdd")->middleware('auth');
		Route::get("/admin/consultorios/edit/{id}", "admin\ConsultoriosController@getEdit")->middleware('auth');
		Route::get("/admin/consultorios/status/{field}/{id}", "admin\ConsultoriosController@status")->middleware('auth');
		Route::get("/admin/consultorios/export/{type}", "admin\ConsultoriosController@getExport")->middleware('auth');
		Route::post("/admin/consultorios/edit", "admin\ConsultoriosController@postEdit")->middleware('auth');
		Route::post("/admin/consultorios/delete", "admin\ConsultoriosController@delete")->middleware('auth');
		Route::get("/admin/consultorios/view/{id}", "admin\ConsultoriosController@view")->middleware('auth');
		Route::get("/admin/consultorios/baja/{id}", "admin\ConsultoriosController@baja")->middleware('auth');
		Route::get("/admin/consultorios/alta/{id}", "admin\ConsultoriosController@alta")->middleware('auth');
		Route::get("/admin/consultorios/ajax/{id}", "admin\ConsultoriosController@getAjax")->middleware('auth');
	    //  EO : Consultorios



		// BO : Cuartos
	  Route::post("/admin/cuartos/deleteAll", "admin\CuartosController@deleteAll")->middleware('auth');
	  Route::get("/admin/cuartos", "admin\CuartosController@index")->middleware('auth');
		Route::get("/admin/cuartos/add", "admin\CuartosController@getAdd")->middleware('auth');
		Route::post("/admin/cuartos/add", "admin\CuartosController@postAdd")->middleware('auth');
		Route::get("/admin/cuartos/edit/{id}", "admin\CuartosController@getEdit")->middleware('auth');
		Route::get("/admin/cuartos/status/{field}/{id}", "admin\CuartosController@status")->middleware('auth');
		Route::get("/admin/cuartos/export/{type}", "admin\CuartosController@getExport")->middleware('auth');
		Route::post("/admin/cuartos/edit", "admin\CuartosController@postEdit")->middleware('auth');
		Route::post("/admin/cuartos/delete", "admin\CuartosController@delete")->middleware('auth');
		Route::get("/admin/cuartos/view/{id}", "admin\CuartosController@view")->middleware('auth');
		Route::get("/admin/cuartos/baja/{id}", "admin\CuartosController@baja")->middleware('auth');
		Route::get("/admin/cuartos/alta/{id}", "admin\CuartosController@alta")->middleware('auth');
		Route::get("/admin/cuartos/ajax/{id}", "admin\CuartosController@getAjax")->middleware('auth');
	    //  EO : Cuartos



		// BO : Enfermeria
	  Route::post("/admin/enfermeria/deleteAll", "admin\EnfermeriaController@deleteAll")->middleware('auth');
	  Route::get("/admin/enfermeria", "admin\EnfermeriaController@index")->middleware('auth');
		Route::get("/admin/enfermeria/add", "admin\EnfermeriaController@getAdd")->middleware('auth');
		Route::post("/admin/enfermeria/add", "admin\EnfermeriaController@postAdd")->middleware('auth');
		Route::get("/admin/enfermeria/edit/{id}", "admin\EnfermeriaController@getEdit")->middleware('auth');
		Route::get("/admin/enfermeria/status/{field}/{id}", "admin\EnfermeriaController@status")->middleware('auth');
		Route::get("/admin/enfermeria/export/{type}", "admin\EnfermeriaController@getExport")->middleware('auth');
		Route::post("/admin/enfermeria/edit", "admin\EnfermeriaController@postEdit")->middleware('auth');
		Route::post("/admin/enfermeria/delete", "admin\EnfermeriaController@delete")->middleware('auth');
		Route::get("/admin/enfermeria/view/{id}", "admin\EnfermeriaController@view")->middleware('auth');
		Route::get("/admin/enfermeria/baja/{id}", "admin\EnfermeriaController@baja")->middleware('auth');
		Route::get("/admin/enfermeria/alta/{id}", "admin\EnfermeriaController@alta")->middleware('auth');
		Route::get("/admin/enfermeria/ajax/{id}", "admin\EnfermeriaController@getAjax")->middleware('auth');

    Route::get("/admin/enfermeria/search/", "admin\EnfermeriaController@getSearch")->middleware('auth');
    //  EO : Enfermeria



		// BO : Hospitalizacion
	  Route::post("/admin/hospitalizacion/deleteAll", "admin\HospitalizacionController@deleteAll")->middleware('auth');
	  Route::get("/admin/hospitalizacion", "admin\HospitalizacionController@index")->middleware('auth');
		Route::get("/admin/hospitalizacion/add", "admin\HospitalizacionController@getAdd")->middleware('auth');
		Route::post("/admin/hospitalizacion/add", "admin\HospitalizacionController@postAdd")->middleware('auth');
		Route::get("/admin/hospitalizacion/edit/{id}", "admin\HospitalizacionController@getEdit")->middleware('auth');
		Route::get("/admin/hospitalizacion/status/{field}/{id}", "admin\HospitalizacionController@status")->middleware('auth');
		Route::get("/admin/hospitalizacion/export/{type}", "admin\HospitalizacionController@getExport")->middleware('auth');
		Route::post("/admin/hospitalizacion/edit", "admin\HospitalizacionController@postEdit")->middleware('auth');
		Route::post("/admin/hospitalizacion/delete", "admin\HospitalizacionController@delete")->middleware('auth');
		Route::get("/admin/hospitalizacion/view/{id}", "admin\HospitalizacionController@view")->middleware('auth');
		Route::get("/admin/hospitalizacion/baja/{id}", "admin\HospitalizacionController@baja")->middleware('auth');
		Route::get("/admin/hospitalizacion/alta/{id}", "admin\HospitalizacionController@alta")->middleware('auth');
		Route::get("/admin/hospitalizacion/ajax/{id}", "admin\HospitalizacionController@getAjax")->middleware('auth');

    Route::get("/admin/hospitalizacion/servicios/{id}", "admin\HospitalizacionController@getServicios")->middleware('auth');
    Route::get("/admin/hospitalizacion/servicios/baja/{id}", "admin\HospitalizacionController@bajaServicio")->middleware('auth');
    Route::post("/admin/hospitalizacion/servicios", "admin\HospitalizacionController@postServicios")->middleware('auth');

    Route::get("/admin/hospitalizacion/abonar/{id}", "admin\HospitalizacionController@postAbonar")->middleware('auth');
    Route::get("/admin/hospitalizacion/fechas/", "admin\HospitalizacionController@getFechas")->middleware('auth');
	    //  EO : Hospitalizacion



		// BO : Pacientes
	  Route::post("/admin/pacientes/deleteAll", "admin\PacientesController@deleteAll")->middleware('auth');
	  Route::get("/admin/pacientes", "admin\PacientesController@index")->middleware('auth');
		Route::get("/admin/pacientes/add", "admin\PacientesController@getAdd")->middleware('auth');
		Route::post("/admin/pacientes/add", "admin\PacientesController@postAdd")->middleware('auth');
		Route::get("/admin/pacientes/edit/{id}", "admin\PacientesController@getEdit")->middleware('auth');
		Route::get("/admin/pacientes/status/{field}/{id}", "admin\PacientesController@status")->middleware('auth');
		Route::get("/admin/pacientes/export/{type}", "admin\PacientesController@getExport")->middleware('auth');
		Route::post("/admin/pacientes/edit", "admin\PacientesController@postEdit")->middleware('auth');
		Route::post("/admin/pacientes/delete", "admin\PacientesController@delete")->middleware('auth');
		Route::get("/admin/pacientes/view/{id}", "admin\PacientesController@view")->middleware('auth');
    Route::get("/admin/pacientes/expediente/{id}", "admin\PacientesController@getExpediente")->middleware('auth');
		Route::get("/admin/pacientes/baja/{id}", "admin\PacientesController@baja")->middleware('auth');
		Route::get("/admin/pacientes/alta/{id}", "admin\PacientesController@alta")->middleware('auth');
		Route::get("/admin/pacientes/ajax/{id}", "admin\PacientesController@getAjax")->middleware('auth');
    Route::get("/admin/pacientes/signos/{id}", "admin\PacientesController@getSignosVitales")->middleware('auth');

    Route::get("/admin/paciente/historial/micro/{id}", "admin\PacientesController@getMicroExpediente")->middleware('auth');
    Route::get("/admin/pacientes/ficha/{id}", "admin\PacientesController@getFicha")->middleware('auth');
	  Route::get("/admin/pacientes/search/", "admin\PacientesController@getSearch")->middleware('auth');
    Route::get("/admin/pacientes/laboratorio/ficha/{id}", "admin\PacientesController@getLaboratorioFicha")->middleware('auth');
    //  EO : Pacientes

		// BO : Signos_vitales
	  Route::post("/admin/signos_vitales/deleteAll", "admin\Signos_vitalesController@deleteAll")->middleware('auth');
	  Route::get("/admin/signos_vitales", "admin\Signos_vitalesController@index")->middleware('auth');
		Route::get("/admin/signos_vitales/add", "admin\Signos_vitalesController@getAdd")->middleware('auth');
		Route::post("/admin/signos_vitales/add", "admin\Signos_vitalesController@postAdd")->middleware('auth');
		Route::get("/admin/signos_vitales/edit/{id}", "admin\Signos_vitalesController@getEdit")->middleware('auth');
		Route::get("/admin/signos_vitales/status/{field}/{id}", "admin\Signos_vitalesController@status")->middleware('auth');
		Route::get("/admin/signos_vitales/export/{type}", "admin\Signos_vitalesController@getExport")->middleware('auth');
		Route::post("/admin/signos_vitales/edit", "admin\Signos_vitalesController@postEdit")->middleware('auth');
		Route::post("/admin/signos_vitales/delete", "admin\Signos_vitalesController@delete")->middleware('auth');
		Route::get("/admin/signos_vitales/view/{id}", "admin\Signos_vitalesController@view")->middleware('auth');
		Route::get("/admin/signos_vitales/baja/{id}", "admin\Signos_vitalesController@baja")->middleware('auth');
		Route::get("/admin/signos_vitales/alta/{id}", "admin\Signos_vitalesController@alta")->middleware('auth');
		Route::get("/admin/signos_vitales/ajax/{id}", "admin\Signos_vitalesController@getAjax")->middleware('auth');
	    //  EO : Signos_vitales



		// BO : Valoracion_clinica
	  Route::post("/admin/valoracion_clinica/deleteAll", "admin\Valoracion_clinicaController@deleteAll")->middleware('auth');
	  Route::get("/admin/valoracion_clinica", "admin\Valoracion_clinicaController@index")->middleware('auth');
		Route::get("/admin/valoracion_clinica/add", "admin\Valoracion_clinicaController@getAdd")->middleware('auth');
		Route::post("/admin/valoracion_clinica/add", "admin\Valoracion_clinicaController@postAdd")->middleware('auth');
		Route::get("/admin/valoracion_clinica/edit/{id}", "admin\Valoracion_clinicaController@getEdit")->middleware('auth');
		Route::get("/admin/valoracion_clinica/status/{field}/{id}", "admin\Valoracion_clinicaController@status")->middleware('auth');
		Route::get("/admin/valoracion_clinica/export/{type}", "admin\Valoracion_clinicaController@getExport")->middleware('auth');
		Route::post("/admin/valoracion_clinica/edit", "admin\Valoracion_clinicaController@postEdit")->middleware('auth');
		Route::post("/admin/valoracion_clinica/delete", "admin\Valoracion_clinicaController@delete")->middleware('auth');
		Route::get("/admin/valoracion_clinica/view/{id}", "admin\Valoracion_clinicaController@view")->middleware('auth');
		Route::get("/admin/valoracion_clinica/baja/{id}", "admin\Valoracion_clinicaController@baja")->middleware('auth');
		Route::get("/admin/valoracion_clinica/alta/{id}", "admin\Valoracion_clinicaController@alta")->middleware('auth');
		Route::get("/admin/valoracion_clinica/ajax/{id}", "admin\Valoracion_clinicaController@getAjax")->middleware('auth');
	    //  EO : Valoracion_clinica



		// BO : Medicamentos
	  Route::post("/admin/medicamentos/deleteAll", "admin\MedicamentosController@deleteAll")->middleware('auth');
	  Route::get("/admin/medicamentos", "admin\MedicamentosController@index")->middleware('auth');
		Route::get("/admin/medicamentos/add", "admin\MedicamentosController@getAdd")->middleware('auth');
		Route::post("/admin/medicamentos/add", "admin\MedicamentosController@postAdd")->middleware('auth');
		Route::get("/admin/medicamentos/edit/{id}", "admin\MedicamentosController@getEdit")->middleware('auth');
		Route::get("/admin/medicamentos/status/{field}/{id}", "admin\MedicamentosController@status")->middleware('auth');
		Route::get("/admin/medicamentos/export/{type}", "admin\MedicamentosController@getExport")->middleware('auth');
		Route::post("/admin/medicamentos/edit", "admin\MedicamentosController@postEdit")->middleware('auth');
		Route::post("/admin/medicamentos/delete", "admin\MedicamentosController@delete")->middleware('auth');
		Route::get("/admin/medicamentos/view/{id}", "admin\MedicamentosController@view")->middleware('auth');
		Route::get("/admin/medicamentos/baja/{id}", "admin\MedicamentosController@baja")->middleware('auth');
		Route::get("/admin/medicamentos/alta/{id}", "admin\MedicamentosController@alta")->middleware('auth');
		Route::get("/admin/medicamentos/ajax/{id}", "admin\MedicamentosController@getAjax")->middleware('auth');
	    //  EO : Medicamentos



		// BO : Insumos
	  Route::post("/admin/insumos/deleteAll", "admin\InsumosController@deleteAll")->middleware('auth');
	  Route::get("/admin/insumos", "admin\InsumosController@index")->middleware('auth');
		Route::get("/admin/insumos/add", "admin\InsumosController@getAdd")->middleware('auth');
		Route::post("/admin/insumos/add", "admin\InsumosController@postAdd")->middleware('auth');
		Route::get("/admin/insumos/edit/{id}", "admin\InsumosController@getEdit")->middleware('auth');
		Route::get("/admin/insumos/status/{field}/{id}", "admin\InsumosController@status")->middleware('auth');
		Route::get("/admin/insumos/export/{type}", "admin\InsumosController@getExport")->middleware('auth');
		Route::post("/admin/insumos/edit", "admin\InsumosController@postEdit")->middleware('auth');
		Route::post("/admin/insumos/delete", "admin\InsumosController@delete")->middleware('auth');
		Route::get("/admin/insumos/view/{id}", "admin\InsumosController@view")->middleware('auth');
		Route::get("/admin/insumos/baja/{id}", "admin\InsumosController@baja")->middleware('auth');
		Route::get("/admin/insumos/alta/{id}", "admin\InsumosController@alta")->middleware('auth');
		Route::get("/admin/insumos/ajax/{id}", "admin\InsumosController@getAjax")->middleware('auth');
	    //  EO : Insumos



		// BO : Recetas
	  Route::post("/admin/recetas/deleteAll", "admin\RecetasController@deleteAll")->middleware('auth');
	  Route::get("/admin/recetas", "admin\RecetasController@index")->middleware('auth');
		Route::get("/admin/recetas/add", "admin\RecetasController@getAdd")->middleware('auth');
		Route::post("/admin/recetas/add", "admin\RecetasController@postAdd")->middleware('auth');
		Route::get("/admin/recetas/edit/{id}", "admin\RecetasController@getEdit")->middleware('auth');
		Route::get("/admin/recetas/status/{field}/{id}", "admin\RecetasController@status")->middleware('auth');
		Route::get("/admin/recetas/export/{type}", "admin\RecetasController@getExport")->middleware('auth');
		Route::post("/admin/recetas/edit", "admin\RecetasController@postEdit")->middleware('auth');
		Route::post("/admin/recetas/delete", "admin\RecetasController@delete")->middleware('auth');
		Route::get("/admin/recetas/view/{id}", "admin\RecetasController@view")->middleware('auth');
		Route::get("/admin/recetas/baja/{id}", "admin\RecetasController@baja")->middleware('auth');
		Route::get("/admin/recetas/alta/{id}", "admin\RecetasController@alta")->middleware('auth');
		Route::get("/admin/recetas/ajax/{id}", "admin\RecetasController@getAjax")->middleware('auth');

    Route::get("/admin/recetas/print/{id}", "admin\RecetasController@view")->middleware('auth');
    //  EO : Recetas



		// BO : Recetas_detalle
	  Route::post("/admin/recetas_detalle/deleteAll", "admin\Recetas_detalleController@deleteAll")->middleware('auth');
	  Route::get("/admin/recetas_detalle", "admin\Recetas_detalleController@index")->middleware('auth');
		Route::get("/admin/recetas_detalle/add", "admin\Recetas_detalleController@getAdd")->middleware('auth');
		Route::post("/admin/recetas_detalle/add", "admin\Recetas_detalleController@postAdd")->middleware('auth');
		Route::get("/admin/recetas_detalle/edit/{id}", "admin\Recetas_detalleController@getEdit")->middleware('auth');
		Route::get("/admin/recetas_detalle/status/{field}/{id}", "admin\Recetas_detalleController@status")->middleware('auth');
		Route::get("/admin/recetas_detalle/export/{type}", "admin\Recetas_detalleController@getExport")->middleware('auth');
		Route::post("/admin/recetas_detalle/edit", "admin\Recetas_detalleController@postEdit")->middleware('auth');
		Route::post("/admin/recetas_detalle/delete", "admin\Recetas_detalleController@delete")->middleware('auth');
		Route::get("/admin/recetas_detalle/view/{id}", "admin\Recetas_detalleController@view")->middleware('auth');
		Route::get("/admin/recetas_detalle/baja/{id}", "admin\Recetas_detalleController@baja")->middleware('auth');
		Route::get("/admin/recetas_detalle/alta/{id}", "admin\Recetas_detalleController@alta")->middleware('auth');
		Route::get("/admin/recetas_detalle/ajax/{id}", "admin\Recetas_detalleController@getAjax")->middleware('auth');
	    //  EO : Recetas_detalle



		// BO : Consultas
	  Route::post("/admin/consultas/deleteAll", "admin\ConsultasController@deleteAll")->middleware('auth');
	  Route::get("/admin/consultas", "admin\ConsultasController@index")->middleware('auth');
		Route::get("/admin/consultas/add", "admin\ConsultasController@getAdd")->middleware('auth');
		Route::post("/admin/consultas/add", "admin\ConsultasController@postAdd")->middleware('auth');
		Route::get("/admin/consultas/edit/{id}", "admin\ConsultasController@getEdit")->middleware('auth');
		Route::get("/admin/consultas/status/{field}/{id}", "admin\ConsultasController@status")->middleware('auth');
		Route::get("/admin/consultas/export/{type}", "admin\ConsultasController@getExport")->middleware('auth');
		Route::post("/admin/consultas/edit", "admin\ConsultasController@postEdit")->middleware('auth');
		Route::post("/admin/consultas/delete", "admin\ConsultasController@delete")->middleware('auth');
		Route::get("/admin/consultas/view/{id}", "admin\ConsultasController@view")->middleware('auth');
		Route::get("/admin/consultas/baja/{id}", "admin\ConsultasController@baja")->middleware('auth');
		Route::get("/admin/consultas/alta/{id}", "admin\ConsultasController@alta")->middleware('auth');
		Route::get("/admin/consultas/ajax/{id}", "admin\ConsultasController@getAjax")->middleware('auth');

    Route::get("/admin/consultas/ficha/{id}", "admin\ConsultasController@getFicha")->middleware('auth');
    //  EO : Consultas



		// BO : Laboratorio
	  Route::post("/admin/laboratorio/deleteAll", "admin\LaboratorioController@deleteAll")->middleware('auth');
	  Route::get("/admin/laboratorio", "admin\LaboratorioController@index")->middleware('auth');
		Route::get("/admin/laboratorio/add", "admin\LaboratorioController@getAdd")->middleware('auth');
		Route::post("/admin/laboratorio/add", "admin\LaboratorioController@postAdd")->middleware('auth');
		Route::get("/admin/laboratorio/edit/{id}", "admin\LaboratorioController@getEdit")->middleware('auth');
		Route::get("/admin/laboratorio/status/{field}/{id}", "admin\LaboratorioController@status")->middleware('auth');
		Route::get("/admin/laboratorio/export/{type}", "admin\LaboratorioController@getExport")->middleware('auth');
		Route::post("/admin/laboratorio/edit", "admin\LaboratorioController@postEdit")->middleware('auth');
		Route::post("/admin/laboratorio/delete", "admin\LaboratorioController@delete")->middleware('auth');
		Route::get("/admin/laboratorio/view/{id}", "admin\LaboratorioController@view")->middleware('auth');
		Route::get("/admin/laboratorio/baja/{id}", "admin\LaboratorioController@baja")->middleware('auth');
		Route::get("/admin/laboratorio/alta/{id}", "admin\LaboratorioController@alta")->middleware('auth');
		Route::get("/admin/laboratorio/ajax/{id}", "admin\LaboratorioController@getAjax")->middleware('auth');
	    //  EO : Laboratorio



		// BO : Ordenes
	  Route::post("/admin/ordenes/deleteAll", "admin\OrdenesController@deleteAll")->middleware('auth');
	  Route::get("/admin/ordenes", "admin\OrdenesController@index")->middleware('auth');
		Route::get("/admin/ordenes/add", "admin\OrdenesController@getAdd")->middleware('auth');
		Route::post("/admin/ordenes/add", "admin\OrdenesController@postAdd")->middleware('auth');
		Route::get("/admin/ordenes/edit/{id}", "admin\OrdenesController@getEdit")->middleware('auth');
		Route::get("/admin/ordenes/status/{field}/{id}", "admin\OrdenesController@status")->middleware('auth');
		Route::get("/admin/ordenes/export/{type}", "admin\OrdenesController@getExport")->middleware('auth');
		Route::post("/admin/ordenes/edit", "admin\OrdenesController@postEdit")->middleware('auth');
		Route::post("/admin/ordenes/delete", "admin\OrdenesController@delete")->middleware('auth');
		Route::get("/admin/ordenes/view/{id}", "admin\OrdenesController@view")->middleware('auth');
		Route::get("/admin/ordenes/baja/{id}", "admin\OrdenesController@baja")->middleware('auth');
		Route::get("/admin/ordenes/alta/{id}", "admin\OrdenesController@alta")->middleware('auth');
		Route::get("/admin/ordenes/ajax/{id}", "admin\OrdenesController@getAjax")->middleware('auth');
	    //  EO : Ordenes



		// BO : Asistentes
	  Route::post("/admin/asistentes/deleteAll", "admin\AsistentesController@deleteAll")->middleware('auth');
	  Route::get("/admin/asistentes", "admin\AsistentesController@index")->middleware('auth');
		Route::get("/admin/asistentes/add", "admin\AsistentesController@getAdd")->middleware('auth');
		Route::post("/admin/asistentes/add", "admin\AsistentesController@postAdd")->middleware('auth');
		Route::get("/admin/asistentes/edit/{id}", "admin\AsistentesController@getEdit")->middleware('auth');
		Route::get("/admin/asistentes/status/{field}/{id}", "admin\AsistentesController@status")->middleware('auth');
		Route::get("/admin/asistentes/export/{type}", "admin\AsistentesController@getExport")->middleware('auth');
		Route::post("/admin/asistentes/edit", "admin\AsistentesController@postEdit")->middleware('auth');
		Route::post("/admin/asistentes/delete", "admin\AsistentesController@delete")->middleware('auth');
		Route::get("/admin/asistentes/view/{id}", "admin\AsistentesController@view")->middleware('auth');
		Route::get("/admin/asistentes/baja/{id}", "admin\AsistentesController@baja")->middleware('auth');
		Route::get("/admin/asistentes/alta/{id}", "admin\AsistentesController@alta")->middleware('auth');
		Route::get("/admin/asistentes/ajax/{id}", "admin\AsistentesController@getAjax")->middleware('auth');
	  Route::get("/admin/asistentes/search/", "admin\AsistentesController@getSearch")->middleware('auth');

    //  EO : Asistentes



		// BO : Pagos
	  Route::post("/admin/pagos/deleteAll", "admin\PagosController@deleteAll")->middleware('auth');
	  Route::get("/admin/pagos", "admin\PagosController@index")->middleware('auth');
		Route::get("/admin/pagos/add", "admin\PagosController@getAdd")->middleware('auth');
		Route::post("/admin/pagos/add", "admin\PagosController@postAdd")->middleware('auth');
		Route::get("/admin/pagos/edit/{id}", "admin\PagosController@getEdit")->middleware('auth');
		Route::get("/admin/pagos/status/{field}/{id}", "admin\PagosController@status")->middleware('auth');
		Route::get("/admin/pagos/export/{type}", "admin\PagosController@getExport")->middleware('auth');
		Route::post("/admin/pagos/edit", "admin\PagosController@postEdit")->middleware('auth');
		Route::post("/admin/pagos/delete", "admin\PagosController@delete")->middleware('auth');
		Route::get("/admin/pagos/view/{id}", "admin\PagosController@view")->middleware('auth');
		Route::get("/admin/pagos/baja/{id}", "admin\PagosController@baja")->middleware('auth');
		Route::get("/admin/pagos/alta/{id}", "admin\PagosController@alta")->middleware('auth');
		Route::get("/admin/pagos/ajax/{id}", "admin\PagosController@getAjax")->middleware('auth');

    Route::get("/admin/pagos/ajax/{id}", "admin\PagosController@getAjax")->middleware('auth');
	  Route::get("/admin/pagos/pagar/{id}", "admin\PagosController@pagado")->middleware('auth');
    //  EO : Pagos



		// BO : Empresas
	  Route::post("/admin/empresas/deleteAll", "admin\EmpresasController@deleteAll")->middleware('auth');
	  Route::get("/admin/empresas", "admin\EmpresasController@index")->middleware('auth');
		Route::get("/admin/empresas/add", "admin\EmpresasController@getAdd")->middleware('auth');
		Route::post("/admin/empresas/add", "admin\EmpresasController@postAdd")->middleware('auth');
		Route::get("/admin/empresas/edit/{id}", "admin\EmpresasController@getEdit")->middleware('auth');
		Route::get("/admin/empresas/status/{field}/{id}", "admin\EmpresasController@status")->middleware('auth');
		Route::get("/admin/empresas/export/{type}", "admin\EmpresasController@getExport")->middleware('auth');
		Route::post("/admin/empresas/edit", "admin\EmpresasController@postEdit")->middleware('auth');
		Route::post("/admin/empresas/delete", "admin\EmpresasController@delete")->middleware('auth');
		Route::get("/admin/empresas/view/{id}", "admin\EmpresasController@view")->middleware('auth');
		Route::get("/admin/empresas/baja/{id}", "admin\EmpresasController@baja")->middleware('auth');
		Route::get("/admin/empresas/alta/{id}", "admin\EmpresasController@alta")->middleware('auth');
		Route::get("/admin/empresas/ajax/{id}", "admin\EmpresasController@getAjax")->middleware('auth');
	    //  EO : Empresas



		// BO : Servicios
	  Route::post("/admin/servicios/deleteAll", "admin\ProductosController@deleteAll")->middleware('auth');
	  Route::get("/admin/servicios", "admin\ProductosController@index")->middleware('auth');
		Route::get("/admin/servicios/add", "admin\ProductosController@getAdd")->middleware('auth');
		Route::post("/admin/servicios/add", "admin\ProductosController@postAdd")->middleware('auth');
		Route::get("/admin/servicios/edit/{id}", "admin\ProductosController@getEdit")->middleware('auth');
		Route::get("/admin/servicios/status/{field}/{id}", "admin\ProductosController@status")->middleware('auth');
		Route::get("/admin/servicios/export/{type}", "admin\ProductosController@getExport")->middleware('auth');
		Route::post("/admin/servicios/edit", "admin\ProductosController@postEdit")->middleware('auth');
		Route::post("/admin/servicios/delete", "admin\ProductosController@delete")->middleware('auth');
		Route::get("/admin/servicios/view/{id}", "admin\ProductosController@view")->middleware('auth');
		Route::get("/admin/servicios/baja/{id}", "admin\ProductosController@baja")->middleware('auth');
		Route::get("/admin/servicios/alta/{id}", "admin\ProductosController@alta")->middleware('auth');
		Route::get("/admin/servicios/ajax/{id}", "admin\ProductosController@getAjax")->middleware('auth');
	    //  EO : Servicios



		// BO : Farmacia
	  Route::post("/admin/farmacia/deleteAll", "admin\FarmaciaController@deleteAll")->middleware('auth');
	  Route::get("/admin/farmacia", "admin\FarmaciaController@index")->middleware('auth');
		Route::get("/admin/farmacia/add", "admin\FarmaciaController@getAdd")->middleware('auth');
		Route::post("/admin/farmacia/add", "admin\FarmaciaController@postAdd")->middleware('auth');
		Route::get("/admin/farmacia/edit/{id}", "admin\FarmaciaController@getEdit")->middleware('auth');
		Route::get("/admin/farmacia/status/{field}/{id}", "admin\FarmaciaController@status")->middleware('auth');
		Route::get("/admin/farmacia/export/{type}", "admin\FarmaciaController@getExport")->middleware('auth');
		Route::post("/admin/farmacia/edit", "admin\FarmaciaController@postEdit")->middleware('auth');
		Route::post("/admin/farmacia/delete", "admin\FarmaciaController@delete")->middleware('auth');
		Route::get("/admin/farmacia/view/{id}", "admin\FarmaciaController@view")->middleware('auth');
		Route::get("/admin/farmacia/baja/{id}", "admin\FarmaciaController@baja")->middleware('auth');
		Route::get("/admin/farmacia/alta/{id}", "admin\FarmaciaController@alta")->middleware('auth');
		Route::get("/admin/farmacia/ajax/{id}", "admin\FarmaciaController@getAjax")->middleware('auth');
	    //  EO : Farmacia



		// BO : Notas
	  Route::post("/admin/notas/deleteAll", "admin\NotasController@deleteAll")->middleware('auth');
	  Route::get("/admin/notas", "admin\NotasController@index")->middleware('auth');
		Route::get("/admin/notas/add", "admin\NotasController@getAdd")->middleware('auth');
		Route::post("/admin/notas/add", "admin\NotasController@postAdd")->middleware('auth');
		Route::get("/admin/notas/edit/{id}", "admin\NotasController@getEdit")->middleware('auth');
		Route::get("/admin/notas/status/{field}/{id}", "admin\NotasController@status")->middleware('auth');
		Route::get("/admin/notas/export/{type}", "admin\NotasController@getExport")->middleware('auth');
		Route::post("/admin/notas/edit", "admin\NotasController@postEdit")->middleware('auth');
		Route::post("/admin/notas/delete", "admin\NotasController@delete")->middleware('auth');
		Route::get("/admin/notas/view/{id}", "admin\NotasController@view")->middleware('auth');
		Route::get("/admin/notas/baja/{id}", "admin\NotasController@baja")->middleware('auth');
		Route::get("/admin/notas/alta/{id}", "admin\NotasController@alta")->middleware('auth');
		Route::get("/admin/notas/ajax/{id}", "admin\NotasController@getAjax")->middleware('auth');
	    //  EO : Notas



		// BO : Urgencias
	  Route::post("/admin/urgencias/deleteAll", "admin\UrgenciasController@deleteAll")->middleware('auth');
	  Route::get("/admin/urgencias", "admin\UrgenciasController@index")->middleware('auth');
		Route::get("/admin/urgencias/add", "admin\UrgenciasController@getAdd")->middleware('auth');
		Route::post("/admin/urgencias/add", "admin\UrgenciasController@postAdd")->middleware('auth');
		Route::get("/admin/urgencias/edit/{id}", "admin\UrgenciasController@getEdit")->middleware('auth');
		Route::get("/admin/urgencias/status/{field}/{id}", "admin\UrgenciasController@status")->middleware('auth');
		Route::get("/admin/urgencias/export/{type}", "admin\UrgenciasController@getExport")->middleware('auth');
		Route::post("/admin/urgencias/edit", "admin\UrgenciasController@postEdit")->middleware('auth');
		Route::post("/admin/urgencias/delete", "admin\UrgenciasController@delete")->middleware('auth');
		Route::get("/admin/urgencias/view/{id}", "admin\UrgenciasController@view")->middleware('auth');
		Route::get("/admin/urgencias/baja/{id}", "admin\UrgenciasController@baja")->middleware('auth');
		Route::get("/admin/urgencias/alta/{id}", "admin\UrgenciasController@alta")->middleware('auth');
		Route::get("/admin/urgencias/ajax/{id}", "admin\UrgenciasController@getAjax")->middleware('auth');

    Route::get("/admin/urgencias/ficha/{id}", "admin\UrgenciasController@getFicha")->middleware('auth');

    Route::get("/admin/urgencias/servicios/{id}", "admin\UrgenciasController@getServicios")->middleware('auth');
    Route::get("/admin/urgencias/servicios/baja/{id}", "admin\UrgenciasController@bajaServicio")->middleware('auth');
    Route::post("/admin/urgencias/servicios", "admin\UrgenciasController@postServicios")->middleware('auth');

    Route::get("/admin/urgencias/abonar/{id}", "admin\UrgenciasController@postAbonar")->middleware('auth');
    Route::get("/admin/urgencias/fechas/", "admin\UrgenciasController@getFechas")->middleware('auth');
	    //  EO : Urgencias



		// BO : Areas
	  Route::post("/admin/areas/deleteAll", "admin\AreasController@deleteAll")->middleware('auth');
	  Route::get("/admin/areas", "admin\AreasController@index")->middleware('auth');
		Route::get("/admin/areas/add", "admin\AreasController@getAdd")->middleware('auth');
		Route::post("/admin/areas/add", "admin\AreasController@postAdd")->middleware('auth');
		Route::get("/admin/areas/edit/{id}", "admin\AreasController@getEdit")->middleware('auth');
		Route::get("/admin/areas/status/{field}/{id}", "admin\AreasController@status")->middleware('auth');
		Route::get("/admin/areas/export/{type}", "admin\AreasController@getExport")->middleware('auth');
		Route::post("/admin/areas/edit", "admin\AreasController@postEdit")->middleware('auth');
		Route::post("/admin/areas/delete", "admin\AreasController@delete")->middleware('auth');
		Route::get("/admin/areas/view/{id}", "admin\AreasController@view")->middleware('auth');
		Route::get("/admin/areas/baja/{id}", "admin\AreasController@baja")->middleware('auth');
		Route::get("/admin/areas/alta/{id}", "admin\AreasController@alta")->middleware('auth');
		Route::get("/admin/areas/ajax/{id}", "admin\AreasController@getAjax")->middleware('auth');
	    //  EO : Areas

      // BO : Ambulancias
		  Route::post("/admin/ambulancias/deleteAll", "admin\AmbulanciasController@deleteAll")->middleware('auth');
		  Route::get("/admin/ambulancias", "admin\AmbulanciasController@index")->middleware('auth');
			Route::get("/admin/ambulancias/add", "admin\AmbulanciasController@getAdd")->middleware('auth');
			Route::post("/admin/ambulancias/add", "admin\AmbulanciasController@postAdd")->middleware('auth');
			Route::get("/admin/ambulancias/edit/{id}", "admin\AmbulanciasController@getEdit")->middleware('auth');
			Route::get("/admin/ambulancias/status/{field}/{id}", "admin\AmbulanciasController@status")->middleware('auth');
			Route::get("/admin/ambulancias/export/{type}", "admin\AmbulanciasController@getExport")->middleware('auth');
			Route::post("/admin/ambulancias/edit", "admin\AmbulanciasController@postEdit")->middleware('auth');
			Route::post("/admin/ambulancias/delete", "admin\AmbulanciasController@delete")->middleware('auth');
			Route::get("/admin/ambulancias/view/{id}", "admin\AmbulanciasController@view")->middleware('auth');
      Route::get("/admin/ambulancias/ficha/{id}", "admin\AmbulanciasController@getFicha")->middleware('auth');
			Route::get("/admin/ambulancias/baja/{id}", "admin\AmbulanciasController@baja")->middleware('auth');
			Route::get("/admin/ambulancias/alta/{id}", "admin\AmbulanciasController@alta")->middleware('auth');
			Route::get("/admin/ambulancias/ajax/{id}", "admin\AmbulanciasController@getAjax")->middleware('auth');
			Route::get("/admin/ambulancias/excel", "admin\AmbulanciasController@getExcel")->middleware('auth');
		    //  EO : Ambulancias
						   

							// BO : Triaje
						  Route::post("/admin/triaje/deleteAll", "admin\TriajeController@deleteAll")->middleware('auth');
						  Route::get("/admin/triaje", "admin\TriajeController@index")->middleware('auth');
						  Route::get("/admin/triaje/excel", "admin\TriajeController@getExcel")->middleware('auth');

						  Route::get("/admin/triaje/add", "admin\TriajeController@getAdd")->middleware('auth');
							Route::post("/admin/triaje/add", "admin\TriajeController@postAdd")->middleware('auth');
							Route::get("/admin/triaje/edit/{id}", "admin\TriajeController@getEdit")->middleware('auth');
							Route::get("/admin/triaje/status/{field}/{id}", "admin\TriajeController@status")->middleware('auth');
							Route::get("/admin/triaje/export/{type}", "admin\TriajeController@getExport")->middleware('auth');
							Route::post("/admin/triaje/edit", "admin\TriajeController@postEdit")->middleware('auth');
							Route::post("/admin/triaje/delete", "admin\TriajeController@delete")->middleware('auth');
							Route::get("/admin/triaje/view/{id}", "admin\TriajeController@view")->middleware('auth');
							Route::get("/admin/triaje/baja/{id}", "admin\TriajeController@baja")->middleware('auth');
							Route::get("/admin/triaje/alta/{id}", "admin\TriajeController@alta")->middleware('auth');
							Route::get("/admin/triaje/ajax/{id}", "admin\TriajeController@getAjax")->middleware('auth');
						    //  EO : Triaje

						   // @@@@@#####@@@@@

						    









//Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/admin/home', 'HomeController@index');
//Home

Auth::routes();


Route::get('storage/{name}/{folder}/{image}', function($name, $folder, $image){

  $path = storage_path().'/app/public/'.$name .'/'. $folder. '/'. $image ;

  if (file_exists($path)) {
  	header("Content-type: image/jpeg");
  	readfile($path);
  }else{
  	return $path;
  }

});
