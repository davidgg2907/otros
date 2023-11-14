<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
use Illuminate\Support\Facades\Route;

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

Route::get('/admin', 'HomeController@index')->middleware('auth');
Route::post('admin/sendMailing', 'HomeController@sendMailing')->middleware('auth');

Route::get('/', 'HomeController@index')->middleware('auth');


// BO : Roles
Route::get("/admin/roles", "admin\RolesController@index")->middleware('auth');
Route::get("/admin/roles/add", "admin\RolesController@getAdd")->middleware('auth');
Route::post("/admin/roles/add", "admin\RolesController@postAdd")->middleware('auth');
Route::get("/admin/roles/edit/{id}", "admin\RolesController@getEdit")->middleware('auth');
Route::post("/admin/roles/edit", "admin\RolesController@postEdit")->middleware('auth');
Route::get("/admin/roles/view/{id}", "admin\RolesController@view")->middleware('auth');
Route::get("/admin/roles/baja/{id}", "admin\RolesController@baja")->middleware('auth');
Route::get("/admin/roles/alta/{id}", "admin\RolesController@alta")->middleware('auth');
Route::get("/admin/roles/ajax/{id}", "admin\RolesController@getAjax")->middleware('auth');
Route::get("/admin/roles/excel", "admin\RolesController@getExcel")->middleware('auth');
  //  EO : Roles

// BO : Users
Route::get("/admin/users", "admin\UsersController@index")->middleware('auth');
Route::get("/admin/users/add", "admin\UsersController@getAdd")->middleware('auth');
Route::post("/admin/users/add", "admin\UsersController@postAdd")->middleware('auth');
Route::get("/admin/users/edit/{id}", "admin\UsersController@getEdit")->middleware('auth');
Route::post("/admin/users/edit", "admin\UsersController@postEdit")->middleware('auth');
Route::get("/admin/users/view/{id}", "admin\UsersController@view")->middleware('auth');
Route::get("/admin/users/baja/{id}", "admin\UsersController@baja")->middleware('auth');
Route::get("/admin/users/alta/{id}", "admin\UsersController@alta")->middleware('auth');
Route::get("/admin/users/ajax/{id}", "admin\UsersController@getAjax")->middleware('auth');
Route::get("/admin/users/excel", "admin\UsersController@getExcel")->middleware('auth');
  //  EO : Users



							// BO : Areas
						Route::get("/admin/areas", "admin\AreasController@index")->middleware('auth');
              			
						Route::get("/admin/areas/dashgeneral/{id}", "admin\AreasController@dashGeneral")->middleware('auth');
						Route::get("/admin/areas/dashresilencia/{id}", "admin\AreasController@dashResilencia")->middleware('auth');
						
						Route::get("/admin/areas/add", "admin\AreasController@getAdd")->middleware('auth');
						Route::post("/admin/areas/add", "admin\AreasController@postAdd")->middleware('auth');
						Route::get("/admin/areas/edit/{id}", "admin\AreasController@getEdit")->middleware('auth');
						Route::post("/admin/areas/edit", "admin\AreasController@postEdit")->middleware('auth');
						Route::get("/admin/areas/view/{id}", "admin\AreasController@view")->middleware('auth');
						Route::get("/admin/areas/baja/{id}", "admin\AreasController@baja")->middleware('auth');
						Route::get("/admin/areas/alta/{id}", "admin\AreasController@alta")->middleware('auth');
						Route::get("/admin/areas/ajax/{id}", "admin\AreasController@getAjax")->middleware('auth');

						Route::get("/admin/areas/dgexcel/{id}", "admin\AreasController@getExcelGeneral")->middleware('auth');
						Route::get("/admin/areas/drexcel/{id}", "admin\AreasController@getExcelResilencia")->middleware('auth');
						//  EO : Areas



						// BO : Delegaciones
						Route::get("/admin/delegaciones", "admin\DelegacionesController@index")->middleware('auth');
              			
						Route::get("/admin/delegaciones/dashgeneral/{id}", "admin\DelegacionesController@dashGeneral")->middleware('auth');
						Route::get("/admin/delegaciones/dashresilencia/{id}", "admin\DelegacionesController@dashResilencia")->middleware('auth');
						
						Route::get("/admin/delegaciones/add", "admin\DelegacionesController@getAdd")->middleware('auth');
						Route::post("/admin/delegaciones/add", "admin\DelegacionesController@postAdd")->middleware('auth');
						Route::get("/admin/delegaciones/edit/{id}", "admin\DelegacionesController@getEdit")->middleware('auth');
						Route::post("/admin/delegaciones/edit", "admin\DelegacionesController@postEdit")->middleware('auth');
						Route::get("/admin/delegaciones/view/{id}", "admin\DelegacionesController@view")->middleware('auth');
						Route::get("/admin/delegaciones/baja/{id}", "admin\DelegacionesController@baja")->middleware('auth');
						Route::get("/admin/delegaciones/alta/{id}", "admin\DelegacionesController@alta")->middleware('auth');
						Route::get("/admin/delegaciones/ajax/{id}", "admin\DelegacionesController@getAjax")->middleware('auth');

						Route::get("/admin/delegaciones/dgexcel/{id}", "admin\DelegacionesController@getExcelGeneral")->middleware('auth');
						Route::get("/admin/delegaciones/drexcel/{id}", "admin\DelegacionesController@getExcelResilencia")->middleware('auth');
						//  EO : Delegaciones



							// BO : Grupos
						  Route::get("/admin/grupos", "admin\GruposController@index")->middleware('auth');
							Route::get("/admin/grupos/add", "admin\GruposController@getAdd")->middleware('auth');
							Route::post("/admin/grupos/add", "admin\GruposController@postAdd")->middleware('auth');
							Route::get("/admin/grupos/edit/{id}", "admin\GruposController@getEdit")->middleware('auth');
							Route::post("/admin/grupos/edit", "admin\GruposController@postEdit")->middleware('auth');
							Route::get("/admin/grupos/view/{id}", "admin\GruposController@view")->middleware('auth');
							Route::get("/admin/grupos/baja/{id}", "admin\GruposController@baja")->middleware('auth');
							Route::get("/admin/grupos/alta/{id}", "admin\GruposController@alta")->middleware('auth');
							Route::get("/admin/grupos/ajax/{id}", "admin\GruposController@getAjax")->middleware('auth');
							Route::get("/admin/grupos/excel", "admin\GruposController@getExcel")->middleware('auth');
						    //  EO : Grupos



							// BO : Modulos
						  Route::get("/admin/modulos", "admin\ModulosController@index")->middleware('auth');
							Route::get("/admin/modulos/add", "admin\ModulosController@getAdd")->middleware('auth');
							Route::post("/admin/modulos/add", "admin\ModulosController@postAdd")->middleware('auth');
							Route::get("/admin/modulos/edit/{id}", "admin\ModulosController@getEdit")->middleware('auth');
							Route::post("/admin/modulos/edit", "admin\ModulosController@postEdit")->middleware('auth');
							Route::get("/admin/modulos/view/{id}", "admin\ModulosController@view")->middleware('auth');
							Route::get("/admin/modulos/baja/{id}", "admin\ModulosController@baja")->middleware('auth');
							Route::get("/admin/modulos/alta/{id}", "admin\ModulosController@alta")->middleware('auth');
							Route::get("/admin/modulos/ajax/{id}", "admin\ModulosController@getAjax")->middleware('auth');
							Route::get("/admin/modulos/excel", "admin\ModulosController@getExcel")->middleware('auth');
						    //  EO : Modulos



							// BO : Pacientes
						  Route::get("/admin/pacientes", "admin\PacientesController@index")->middleware('auth');
							Route::get("/admin/pacientes/add", "admin\PacientesController@getAdd")->middleware('auth');
							Route::post("/admin/pacientes/add", "admin\PacientesController@postAdd")->middleware('auth');
							Route::get("/admin/pacientes/edit/{id}", "admin\PacientesController@getEdit")->middleware('auth');
							Route::post("/admin/pacientes/edit", "admin\PacientesController@postEdit")->middleware('auth');
							Route::get("/admin/pacientes/view/{id}", "admin\PacientesController@view")->middleware('auth');
							Route::get("/admin/pacientes/baja/{id}", "admin\PacientesController@baja")->middleware('auth');
							Route::get("/admin/pacientes/alta/{id}", "admin\PacientesController@alta")->middleware('auth');
							Route::get("/admin/pacientes/ajax/{id}", "admin\PacientesController@getAjax")->middleware('auth');
							Route::get("/admin/pacientes/excel", "admin\PacientesController@getExcel")->middleware('auth');

              Route::get("/admin/pacientes/curp/{curp}", "admin\PacientesController@getCurpInfo");
						    //  EO : Pacientes



							// BO : Preguntas
						  Route::get("/admin/preguntas", "admin\PreguntasController@index")->middleware('auth');
							Route::get("/admin/preguntas/add", "admin\PreguntasController@getAdd")->middleware('auth');
							Route::post("/admin/preguntas/add", "admin\PreguntasController@postAdd")->middleware('auth');
							Route::get("/admin/preguntas/edit/{id}", "admin\PreguntasController@getEdit")->middleware('auth');
							Route::post("/admin/preguntas/edit", "admin\PreguntasController@postEdit")->middleware('auth');
							Route::get("/admin/preguntas/view/{id}", "admin\PreguntasController@view")->middleware('auth');
							Route::get("/admin/preguntas/baja/{id}", "admin\PreguntasController@baja")->middleware('auth');
							Route::get("/admin/preguntas/alta/{id}", "admin\PreguntasController@alta")->middleware('auth');
							Route::get("/admin/preguntas/ajax/{id}", "admin\PreguntasController@getAjax")->middleware('auth');
							Route::get("/admin/preguntas/excel", "admin\PreguntasController@getExcel")->middleware('auth');
						    //  EO : Preguntas



							// BO : Preguntas_respuestas
						  Route::get("/admin/preguntas_respuestas", "admin\Preguntas_respuestasController@index")->middleware('auth');
							Route::get("/admin/preguntas_respuestas/add", "admin\Preguntas_respuestasController@getAdd")->middleware('auth');
							Route::post("/admin/preguntas_respuestas/add", "admin\Preguntas_respuestasController@postAdd")->middleware('auth');
							Route::get("/admin/preguntas_respuestas/edit/{id}", "admin\Preguntas_respuestasController@getEdit")->middleware('auth');
							Route::post("/admin/preguntas_respuestas/edit", "admin\Preguntas_respuestasController@postEdit")->middleware('auth');
							Route::get("/admin/preguntas_respuestas/view/{id}", "admin\Preguntas_respuestasController@view")->middleware('auth');
							Route::get("/admin/preguntas_respuestas/baja/{id}", "admin\Preguntas_respuestasController@baja")->middleware('auth');
							Route::get("/admin/preguntas_respuestas/alta/{id}", "admin\Preguntas_respuestasController@alta")->middleware('auth');
							Route::get("/admin/preguntas_respuestas/ajax/{id}", "admin\Preguntas_respuestasController@getAjax")->middleware('auth');
							Route::get("/admin/preguntas_respuestas/excel", "admin\Preguntas_respuestasController@getExcel")->middleware('auth');
						    //  EO : Preguntas_respuestas



							// BO : Resiliencia_preguntas
						  Route::get("/admin/resiliencia_preguntas", "admin\Resiliencia_preguntasController@index")->middleware('auth');
							Route::get("/admin/resiliencia_preguntas/add", "admin\Resiliencia_preguntasController@getAdd")->middleware('auth');
							Route::post("/admin/resiliencia_preguntas/add", "admin\Resiliencia_preguntasController@postAdd")->middleware('auth');
							Route::get("/admin/resiliencia_preguntas/edit/{id}", "admin\Resiliencia_preguntasController@getEdit")->middleware('auth');
							Route::post("/admin/resiliencia_preguntas/edit", "admin\Resiliencia_preguntasController@postEdit")->middleware('auth');
							Route::get("/admin/resiliencia_preguntas/view/{id}", "admin\Resiliencia_preguntasController@view")->middleware('auth');
							Route::get("/admin/resiliencia_preguntas/baja/{id}", "admin\Resiliencia_preguntasController@baja")->middleware('auth');
							Route::get("/admin/resiliencia_preguntas/alta/{id}", "admin\Resiliencia_preguntasController@alta")->middleware('auth');
							Route::get("/admin/resiliencia_preguntas/ajax/{id}", "admin\Resiliencia_preguntasController@getAjax")->middleware('auth');
							Route::get("/admin/resiliencia_preguntas/excel", "admin\Resiliencia_preguntasController@getExcel")->middleware('auth');
						    //  EO : Resiliencia_preguntas



							// BO : Resiliencia_resultados_detalle
						  Route::get("/admin/resiliencia_resultados_detalle", "admin\Resiliencia_resultados_detalleController@index")->middleware('auth');
							Route::get("/admin/resiliencia_resultados_detalle/add", "admin\Resiliencia_resultados_detalleController@getAdd")->middleware('auth');
							Route::post("/admin/resiliencia_resultados_detalle/add", "admin\Resiliencia_resultados_detalleController@postAdd")->middleware('auth');
							Route::get("/admin/resiliencia_resultados_detalle/edit/{id}", "admin\Resiliencia_resultados_detalleController@getEdit")->middleware('auth');
							Route::post("/admin/resiliencia_resultados_detalle/edit", "admin\Resiliencia_resultados_detalleController@postEdit")->middleware('auth');
							Route::get("/admin/resiliencia_resultados_detalle/view/{id}", "admin\Resiliencia_resultados_detalleController@view")->middleware('auth');
							Route::get("/admin/resiliencia_resultados_detalle/baja/{id}", "admin\Resiliencia_resultados_detalleController@baja")->middleware('auth');
							Route::get("/admin/resiliencia_resultados_detalle/alta/{id}", "admin\Resiliencia_resultados_detalleController@alta")->middleware('auth');
							Route::get("/admin/resiliencia_resultados_detalle/ajax/{id}", "admin\Resiliencia_resultados_detalleController@getAjax")->middleware('auth');
							Route::get("/admin/resiliencia_resultados_detalle/excel", "admin\Resiliencia_resultados_detalleController@getExcel")->middleware('auth');
						    //  EO : Resiliencia_resultados_detalle



							// BO : Resultados
						  Route::get("/admin/resultados", "admin\ResultadosController@index")->middleware('auth');
							Route::get("/admin/resultados/add", "admin\ResultadosController@getAdd")->middleware('auth');
							Route::post("/admin/resultados/add", "admin\ResultadosController@postAdd")->middleware('auth');
							Route::get("/admin/resultados/edit/{id}", "admin\ResultadosController@getEdit")->middleware('auth');
							Route::post("/admin/resultados/edit", "admin\ResultadosController@postEdit")->middleware('auth');
							Route::get("/admin/resultados/view/{id}", "admin\ResultadosController@view")->middleware('auth');
							Route::get("/admin/resultados/baja/{id}", "admin\ResultadosController@baja")->middleware('auth');
							Route::get("/admin/resultados/alta/{id}", "admin\ResultadosController@alta")->middleware('auth');
							Route::get("/admin/resultados/ajax/{id}", "admin\ResultadosController@getAjax")->middleware('auth');
							Route::get("/admin/resultados/excel", "admin\ResultadosController@getExcel")->middleware('auth');
						    //  EO : Resultados



							// BO : Resultados_detalle
						  Route::get("/admin/resultados_detalle", "admin\Resultados_detalleController@index")->middleware('auth');
							Route::get("/admin/resultados_detalle/add", "admin\Resultados_detalleController@getAdd")->middleware('auth');
							Route::post("/admin/resultados_detalle/add", "admin\Resultados_detalleController@postAdd")->middleware('auth');
							Route::get("/admin/resultados_detalle/edit/{id}", "admin\Resultados_detalleController@getEdit")->middleware('auth');
							Route::post("/admin/resultados_detalle/edit", "admin\Resultados_detalleController@postEdit")->middleware('auth');
							Route::get("/admin/resultados_detalle/view/{id}", "admin\Resultados_detalleController@view")->middleware('auth');
							Route::get("/admin/resultados_detalle/baja/{id}", "admin\Resultados_detalleController@baja")->middleware('auth');
							Route::get("/admin/resultados_detalle/alta/{id}", "admin\Resultados_detalleController@alta")->middleware('auth');
							Route::get("/admin/resultados_detalle/ajax/{id}", "admin\Resultados_detalleController@getAjax")->middleware('auth');
							Route::get("/admin/resultados_detalle/excel", "admin\Resultados_detalleController@getExcel")->middleware('auth');
						    //  EO : Resultados_detalle



							// BO : Riesgos_grupos
              Route::post("/admin/riesgos/grupos/deleteAll", "admin\Riesgos_gruposController@deleteAll")->middleware('auth');
              Route::get("/admin/riesgos/grupos", "admin\Riesgos_gruposController@index")->middleware('auth');
              Route::get("/admin/riesgos/grupos/add", "admin\Riesgos_gruposController@getAdd")->middleware('auth');
              Route::post("/admin/riesgos/grupos/add", "admin\Riesgos_gruposController@postAdd")->middleware('auth');
              Route::get("/admin/riesgos/grupos/edit/{id}", "admin\Riesgos_gruposController@getEdit")->middleware('auth');
              Route::get("/admin/riesgos/grupos/status/{field}/{id}", "admin\Riesgos_gruposController@status")->middleware('auth');
              Route::get("/admin/riesgos/grupos/export/{type}", "admin\Riesgos_gruposController@getExport")->middleware('auth');
              Route::post("/admin/riesgos/grupos/edit", "admin\Riesgos_gruposController@postEdit")->middleware('auth');
              Route::post("/admin/riesgos/grupos/delete", "admin\Riesgos_gruposController@delete")->middleware('auth');
              Route::get("/admin/riesgos/grupos/view/{id}", "admin\Riesgos_gruposController@view")->middleware('auth');
              Route::get("/admin/riesgos/grupos/baja/{id}", "admin\Riesgos_gruposController@baja")->middleware('auth');
              Route::get("/admin/riesgos/grupos/alta/{id}", "admin\Riesgos_gruposController@alta")->middleware('auth');
              Route::get("/admin/riesgos/grupos/ajax/{id}", "admin\Riesgos_gruposController@getAjax")->middleware('auth');
						    //  EO : Riesgos_grupos



							// BO : Riesgos_parameros
              // BO : riesgos/parameros
              Route::post("/admin/riesgos/parametros/deleteAll", "admin\Riesgos_paramerosController@deleteAll")->middleware('auth');
              Route::get("/admin/riesgos/parametros", "admin\Riesgos_paramerosController@index")->middleware('auth');
              Route::get("/admin/riesgos/parametros/add", "admin\Riesgos_paramerosController@getAdd")->middleware('auth');
              Route::post("/admin/riesgos/parametros/add", "admin\Riesgos_paramerosController@postAdd")->middleware('auth');
              Route::get("/admin/riesgos/parametros/edit/{id}", "admin\Riesgos_paramerosController@getEdit")->middleware('auth');
              Route::get("/admin/riesgos/parametros/status/{field}/{id}", "admin\Riesgos_paramerosController@status")->middleware('auth');
              Route::get("/admin/riesgos/parametros/export/{type}", "admin\Riesgos_paramerosController@getExport")->middleware('auth');
              Route::post("/admin/riesgos/parametros/edit", "admin\Riesgos_paramerosController@postEdit")->middleware('auth');
              Route::post("/admin/riesgos/parametros/delete", "admin\Riesgos_paramerosController@delete")->middleware('auth');
              Route::get("/admin/riesgos/parametros/view/{id}", "admin\Riesgos_paramerosController@view")->middleware('auth');
              Route::get("/admin/riesgos/parametros/baja/{id}", "admin\Riesgos_paramerosController@baja")->middleware('auth');
              Route::get("/admin/riesgos/parametros/alta/{id}", "admin\Riesgos_paramerosController@alta")->middleware('auth');
              Route::get("/admin/riesgos/parametros/ajax/{id}", "admin\Riesgos_paramerosController@getAjax")->middleware('auth');

              Route::get("/admin/riesgos/parametros/excel", "admin\Riesgos_gruposController@getExcel")->middleware('auth');
                //  EO : riesgos/parameros
						    //  EO : Riesgos_parameros



							// BO : Empresas
						  Route::get("/admin/empresas", "admin\EmpresasController@index")->middleware('auth');
							Route::post("/admin/empresas/edit", "admin\EmpresasController@postEdit")->middleware('auth');
						    //  EO : Empresas


              Route::get("/quiz/{delegacion}/{quiz}", "admin\EmpresasController@captureQuiz");
              Route::post("/quiz/save", "admin\EmpresasController@saveQuiz");
              Route::get("/quiz/end", "admin\EmpresasController@thanksQuiz");
               // @@@@@#####@@@@@





























Auth::routes();

Route::get('storage/{name}/{folder}/{image}', function($name, $folder, $image){

  $path = storage_path().'/app/public/'.$name .'/'. $folder. '/'. $image ;

  if (file_exists($path)) {

    header("Content-type: image/jpeg");
  	readfile($path);

  } else {

    return $path;

  }

});

/*
Route::get('/', function () {
    return view('welcome');
});
*/
