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

// BO : Factura
Route::get("/admin/factura", "admin\FacturaController@index")->middleware('auth');
Route::get("/admin/factura/add", "admin\FacturaController@getAdd")->middleware('auth');
Route::post("/admin/factura/add", "admin\FacturaController@postAdd")->middleware('auth');

Route::get("/admin/factura/general", "admin\FacturaController@getGeneral")->middleware('auth');


Route::get("/admin/factura/detallado", "admin\FacturaController@getDetallado")->middleware('auth');


Route::get("/admin/factura/view/{id}", "admin\FacturaController@view")->middleware('auth');
Route::get("/admin/factura/baja/{id}", "admin\FacturaController@baja")->middleware('auth');
Route::get("/admin/factura/alta/{id}", "admin\FacturaController@alta")->middleware('auth');

Route::get("/admin/factura/excel", "admin\FacturaController@getExcel")->middleware('auth');

Route::get("/admin/factura/rptpdf", "admin\FacturaController@getRptpdf")->middleware('auth');
Route::get("/admin/factura/rptexcel", "admin\FacturaController@getRptExcel")->middleware('auth');

Route::get("/admin/factura/leeXML/{url}", "admin\FacturaController@leeXML")->middleware('auth');
//  EO : Factura



// BO : Factura_detalle
Route::get("/admin/factura_detalle", "admin\Factura_detalleController@index")->middleware('auth');
Route::get("/admin/factura_detalle/add", "admin\Factura_detalleController@getAdd")->middleware('auth');
Route::post("/admin/factura_detalle/add", "admin\Factura_detalleController@postAdd")->middleware('auth');
Route::get("/admin/factura_detalle/edit/{id}", "admin\Factura_detalleController@getEdit")->middleware('auth');
Route::post("/admin/factura_detalle/edit", "admin\Factura_detalleController@postEdit")->middleware('auth');
Route::get("/admin/factura_detalle/view/{id}", "admin\Factura_detalleController@view")->middleware('auth');
Route::get("/admin/factura_detalle/baja/{id}", "admin\Factura_detalleController@baja")->middleware('auth');
Route::get("/admin/factura_detalle/alta/{id}", "admin\Factura_detalleController@alta")->middleware('auth');
Route::get("/admin/factura_detalle/ajax/{id}", "admin\Factura_detalleController@getAjax")->middleware('auth');
Route::get("/admin/factura_detalle/excel", "admin\Factura_detalleController@getExcel")->middleware('auth');
//  EO : Factura_detalle

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
