<?php
date_default_timezone_set('America/Santiago');
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
    Auth::user()->online = 0;
    Auth::user()->save();
    Auth::logout();
    Session::flush();
    return redirect('/');
});

Route::get('/generator', 'GeneratorController@index');
Route::post('/generator/add', 'GeneratorController@add');
Route::post('/generator/getKeyValue', 'GeneratorController@getKeyValue');
Route::post('/generator/getFields', 'GeneratorController@getFields');

Route::get('/admin', 'HomeController@index')->middleware('auth');
Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/lightdarktheme', 'HomeController@lightDarkTheme')->middleware('auth');


Route::get('/admin/reportes/movimientos', 'ReportesController@rptMovimientos')->middleware('auth');
Route::get('/admin/reportes/ventas', 'ReportesController@rptVentas')->middleware('auth');



Route::get('/admin/reportes/rendimiento', 'ReportesController@rptRendimiento')->middleware('auth');
Route::get('/admin/reportes/operaciones', 'ReportesController@rptOperaciones')->middleware('auth');
Route::get('/admin/reportes/inversion', 'ReportesController@rptInversion')->middleware('auth');


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

// BO : Productos
Route::get("/admin/productos", "admin\ProductosController@index")->middleware('auth');
Route::get("/admin/productos/add", "admin\ProductosController@getAdd")->middleware('auth');
Route::post("/admin/productos/add", "admin\ProductosController@postAdd")->middleware('auth');
Route::get("/admin/productos/edit/{id}", "admin\ProductosController@getEdit")->middleware('auth');
Route::post("/admin/productos/edit", "admin\ProductosController@postEdit")->middleware('auth');
Route::get("/admin/productos/view/{id}", "admin\ProductosController@view")->middleware('auth');
Route::get("/admin/productos/baja/{id}", "admin\ProductosController@baja")->middleware('auth');
Route::get("/admin/productos/alta/{id}", "admin\ProductosController@alta")->middleware('auth');
Route::get("/admin/productos/ajax/{id}", "admin\ProductosController@getAjax")->middleware('auth');
Route::get("/admin/productos/excel", "admin\ProductosController@getExcel")->middleware('auth');
  //  EO : Productos



// BO : Adjuntos
Route::get("/admin/adjuntos", "admin\AdjuntosController@index")->middleware('auth');
Route::get("/admin/adjuntos/add", "admin\AdjuntosController@getAdd")->middleware('auth');
Route::post("/admin/adjuntos/add", "admin\AdjuntosController@postAdd")->middleware('auth');
Route::get("/admin/adjuntos/edit/{id}", "admin\AdjuntosController@getEdit")->middleware('auth');
Route::post("/admin/adjuntos/edit", "admin\AdjuntosController@postEdit")->middleware('auth');
Route::get("/admin/adjuntos/view/{id}", "admin\AdjuntosController@view")->middleware('auth');
Route::get("/admin/adjuntos/baja/{id}", "admin\AdjuntosController@baja")->middleware('auth');
Route::get("/admin/adjuntos/alta/{id}", "admin\AdjuntosController@alta")->middleware('auth');
Route::get("/admin/adjuntos/ajax/{id}", "admin\AdjuntosController@getAjax")->middleware('auth');
Route::get("/admin/adjuntos/excel", "admin\AdjuntosController@getExcel")->middleware('auth');
  //  EO : Adjuntos



// BO : Cajas
Route::get("/admin/cajas", "admin\CajasController@index")->middleware('auth');
Route::get("/admin/cajas/printer/{id}", "admin\CajasController@getPrinter")->middleware('auth');
Route::get("/admin/cajas/view/{id}", "admin\CajasController@view")->middleware('auth');
Route::get("/admin/cajas/ajax/{id}", "admin\CajasController@getAjax")->middleware('auth');

Route::get("/admin/cajas/info/{id}", "admin\CajasController@getInfo")->middleware('auth');
Route::get("/admin/cajas/arqueo", "admin\CajasController@postArqueo")->middleware('auth');

//  EO : Cajas



// BO : Categorias
Route::get("/admin/categorias", "admin\CategoriasController@index")->middleware('auth');
Route::get("/admin/categorias/add", "admin\CategoriasController@getAdd")->middleware('auth');
Route::post("/admin/categorias/add", "admin\CategoriasController@postAdd")->middleware('auth');
Route::get("/admin/categorias/edit/{id}", "admin\CategoriasController@getEdit")->middleware('auth');
Route::post("/admin/categorias/edit", "admin\CategoriasController@postEdit")->middleware('auth');
Route::get("/admin/categorias/view/{id}", "admin\CategoriasController@view")->middleware('auth');
Route::get("/admin/categorias/baja/{id}", "admin\CategoriasController@baja")->middleware('auth');
Route::get("/admin/categorias/alta/{id}", "admin\CategoriasController@alta")->middleware('auth');
Route::get("/admin/categorias/ajax/{id}", "admin\CategoriasController@getAjax")->middleware('auth');
Route::get("/admin/categorias/excel", "admin\CategoriasController@getExcel")->middleware('auth');
  //  EO : Categorias



// BO : Clientes
Route::get("/admin/clientes", "admin\ClientesController@index")->middleware('auth');
Route::get("/admin/clientes/add", "admin\ClientesController@getAdd")->middleware('auth');
Route::post("/admin/clientes/add", "admin\ClientesController@postAdd")->middleware('auth');
Route::get("/admin/clientes/edit/{id}", "admin\ClientesController@getEdit")->middleware('auth');
Route::post("/admin/clientes/edit", "admin\ClientesController@postEdit")->middleware('auth');
Route::get("/admin/clientes/view/{id}", "admin\ClientesController@view")->middleware('auth');
Route::get("/admin/clientes/baja/{id}", "admin\ClientesController@baja")->middleware('auth');
Route::get("/admin/clientes/alta/{id}", "admin\ClientesController@alta")->middleware('auth');
Route::get("/admin/clientes/ajax/{id}", "admin\ClientesController@getAjax")->middleware('auth');
Route::get("/admin/clientes/excel", "admin\ClientesController@getExcel")->middleware('auth');

Route::get("/admin/clientes/autocomplete", "admin\ClientesController@getAutocomplete")->middleware('auth');
Route::get("/admin/clientes/ajaxsave", "admin\ClientesController@postSaveAjax")->middleware('auth');

  //  EO : Clientes



// BO : Compras
Route::get("/admin/compras", "admin\ComprasController@index")->middleware('auth');
Route::get("/admin/compras/add", "admin\ComprasController@getAdd")->middleware('auth');
Route::post("/admin/compras/add", "admin\ComprasController@postAdd")->middleware('auth');
Route::get("/admin/compras/edit/{id}", "admin\ComprasController@getEdit")->middleware('auth');
Route::post("/admin/compras/edit", "admin\ComprasController@postEdit")->middleware('auth');
Route::get("/admin/compras/view/{id}", "admin\ComprasController@view")->middleware('auth');
Route::get("/admin/compras/baja/{id}", "admin\ComprasController@baja")->middleware('auth');
Route::get("/admin/compras/alta/{id}", "admin\ComprasController@alta")->middleware('auth');
Route::get("/admin/compras/ajax/{id}", "admin\ComprasController@getAjax")->middleware('auth');
Route::get("/admin/compras/excel", "admin\ComprasController@getExcel")->middleware('auth');
  //  EO : Compras



// BO : Compras_detalle
Route::get("/admin/compras_detalle", "admin\Compras_detalleController@index")->middleware('auth');
Route::get("/admin/compras_detalle/add", "admin\Compras_detalleController@getAdd")->middleware('auth');
Route::post("/admin/compras_detalle/add", "admin\Compras_detalleController@postAdd")->middleware('auth');
Route::get("/admin/compras_detalle/edit/{id}", "admin\Compras_detalleController@getEdit")->middleware('auth');
Route::post("/admin/compras_detalle/edit", "admin\Compras_detalleController@postEdit")->middleware('auth');
Route::get("/admin/compras_detalle/view/{id}", "admin\Compras_detalleController@view")->middleware('auth');
Route::get("/admin/compras_detalle/baja/{id}", "admin\Compras_detalleController@baja")->middleware('auth');
Route::get("/admin/compras_detalle/alta/{id}", "admin\Compras_detalleController@alta")->middleware('auth');
Route::get("/admin/compras_detalle/ajax/{id}", "admin\Compras_detalleController@getAjax")->middleware('auth');
Route::get("/admin/compras_detalle/excel", "admin\Compras_detalleController@getExcel")->middleware('auth');
  //  EO : Compras_detalle



// BO : Proveedores
Route::get("/admin/proveedores", "admin\ProveedoresController@index")->middleware('auth');
Route::get("/admin/proveedores/add", "admin\ProveedoresController@getAdd")->middleware('auth');
Route::post("/admin/proveedores/add", "admin\ProveedoresController@postAdd")->middleware('auth');
Route::get("/admin/proveedores/edit/{id}", "admin\ProveedoresController@getEdit")->middleware('auth');
Route::post("/admin/proveedores/edit", "admin\ProveedoresController@postEdit")->middleware('auth');
Route::get("/admin/proveedores/view/{id}", "admin\ProveedoresController@view")->middleware('auth');
Route::get("/admin/proveedores/baja/{id}", "admin\ProveedoresController@baja")->middleware('auth');
Route::get("/admin/proveedores/alta/{id}", "admin\ProveedoresController@alta")->middleware('auth');
Route::get("/admin/proveedores/ajax/{id}", "admin\ProveedoresController@getAjax")->middleware('auth');
Route::get("/admin/proveedores/excel", "admin\ProveedoresController@getExcel")->middleware('auth');
  //  EO : Proveedores



// BO : Temporizador
Route::get("/admin/temporizador", "admin\TemporizadorController@index")->middleware('auth');
Route::get("/admin/temporizador/runing", "admin\TemporizadorController@getAdd");

Route::get("/admin/cronometro", "admin\TemporizadorController@verCronometros");



Route::get("/admin/temporizador/start/{id}", "admin\TemporizadorController@postAdd")->middleware('auth');
Route::get("/admin/temporizador/end/{id}", "admin\TemporizadorController@postEdit")->middleware('auth');

Route::get("/admin/temporizador/cancel/{id}", "admin\TemporizadorController@baja")->middleware('auth');
Route::get("/admin/temporizador/pause/{id}", "admin\TemporizadorController@pause")->middleware('auth');
Route::get("/admin/temporizador/restart/{id}", "admin\TemporizadorController@alta")->middleware('auth');

  //  EO : Temporizador



// BO : Tiempos
Route::get("/admin/tiempos", "admin\TiemposController@index")->middleware('auth');
Route::get("/admin/tiempos/add", "admin\TiemposController@getAdd")->middleware('auth');
Route::post("/admin/tiempos/add", "admin\TiemposController@postAdd")->middleware('auth');
Route::get("/admin/tiempos/edit/{id}", "admin\TiemposController@getEdit")->middleware('auth');
Route::post("/admin/tiempos/edit", "admin\TiemposController@postEdit")->middleware('auth');
Route::get("/admin/tiempos/view/{id}", "admin\TiemposController@view")->middleware('auth');
Route::get("/admin/tiempos/baja/{id}", "admin\TiemposController@baja")->middleware('auth');
Route::get("/admin/tiempos/alta/{id}", "admin\TiemposController@alta")->middleware('auth');
Route::get("/admin/tiempos/ajax/{id}", "admin\TiemposController@getAjax")->middleware('auth');
Route::get("/admin/tiempos/excel", "admin\TiemposController@getExcel")->middleware('auth');
  //  EO : Tiempos



// BO : Venta_detalle
Route::get("/admin/venta_detalle", "admin\Venta_detalleController@index")->middleware('auth');
Route::get("/admin/venta_detalle/add", "admin\Venta_detalleController@getAdd")->middleware('auth');
Route::post("/admin/venta_detalle/add", "admin\Venta_detalleController@postAdd")->middleware('auth');
Route::get("/admin/venta_detalle/edit/{id}", "admin\Venta_detalleController@getEdit")->middleware('auth');
Route::post("/admin/venta_detalle/edit", "admin\Venta_detalleController@postEdit")->middleware('auth');
Route::get("/admin/venta_detalle/view/{id}", "admin\Venta_detalleController@view")->middleware('auth');
Route::get("/admin/venta_detalle/baja/{id}", "admin\Venta_detalleController@baja")->middleware('auth');
Route::get("/admin/venta_detalle/alta/{id}", "admin\Venta_detalleController@alta")->middleware('auth');
Route::get("/admin/venta_detalle/ajax/{id}", "admin\Venta_detalleController@getAjax")->middleware('auth');
Route::get("/admin/venta_detalle/excel", "admin\Venta_detalleController@getExcel")->middleware('auth');
  //  EO : Venta_detalle



// BO : Ventas
Route::get("/admin/ventas", "admin\VentasController@index")->middleware('auth');
Route::get("/admin/ventas/add", "admin\VentasController@getAdd")->middleware('auth');
Route::post("/admin/ventas/add", "admin\VentasController@postAdd")->middleware('auth');
Route::get("/admin/ventas/edit/{id}", "admin\VentasController@getEdit")->middleware('auth');
Route::post("/admin/ventas/edit", "admin\VentasController@postEdit")->middleware('auth');
Route::get("/admin/ventas/view/{id}", "admin\VentasController@view")->middleware('auth');
Route::get("/admin/ventas/baja/{id}", "admin\VentasController@baja")->middleware('auth');

Route::get("/admin/ventas/bajAjax/{id}", "admin\VentasController@bajaAjax")->middleware('auth');

Route::get("/admin/ventas/alta/{id}", "admin\VentasController@alta")->middleware('auth');
Route::get("/admin/ventas/ajax/{id}", "admin\VentasController@getAjax")->middleware('auth');
Route::get("/admin/ventas/excel", "admin\VentasController@getExcel")->middleware('auth');

Route::get("/admin/ventas/poss", "admin\VentasController@getPos")->middleware('auth');
Route::post("/admin/ventas/pos", "admin\VentasController@postPos")->middleware('auth');

Route::get("/admin/ventas/misventas/{id}", "admin\VentasController@getMisVentas")->middleware('auth');

Route::get("/admin/ventas/voucher/{id}", "admin\VentasController@getVoucher")->middleware('auth');
Route::get("/admin/ventas/qrcode/{id}", "admin\VentasController@getQrcode")->middleware('auth');


  //  EO : Ventas



// BO : Configuracion
Route::get("/admin/configuracion", "admin\ConfiguracionController@getEdit")->middleware('auth');
Route::post("/admin/configuracion/edit", "admin\ConfiguracionController@postEdit")->middleware('auth');
 //  EO : Configuracion



							// BO : Efectivo
						  Route::get("/admin/efectivo", "admin\EfectivoController@index")->middleware('auth');
              Route::get("/admin/efectivo/save", "admin\EfectivoController@getAdd")->middleware('auth');


							Route::get("/admin/efectivo/view/{id}", "admin\EfectivoController@view")->middleware('auth');
							Route::get("/admin/efectivo/baja/{id}", "admin\EfectivoController@baja")->middleware('auth');
							Route::get("/admin/efectivo/alta/{id}", "admin\EfectivoController@alta")->middleware('auth');
							Route::get("/admin/efectivo/ajax/{id}", "admin\EfectivoController@getAjax")->middleware('auth');
							Route::get("/admin/efectivo/excel", "admin\EfectivoController@getExcel")->middleware('auth');
						    //  EO : Efectivo



							// BO : Inventario
						  Route::get("/admin/inventario", "admin\InventarioController@index")->middleware('auth');
							Route::get("/admin/inventario/add", "admin\InventarioController@getAdd")->middleware('auth');
							Route::post("/admin/inventario/add", "admin\InventarioController@postAdd")->middleware('auth');
							Route::get("/admin/inventario/edit/{id}", "admin\InventarioController@getEdit")->middleware('auth');
							Route::post("/admin/inventario/edit", "admin\InventarioController@postEdit")->middleware('auth');
							Route::get("/admin/inventario/view/{id}", "admin\InventarioController@view")->middleware('auth');
							Route::get("/admin/inventario/baja/{id}", "admin\InventarioController@baja")->middleware('auth');
							Route::get("/admin/inventario/alta/{id}", "admin\InventarioController@alta")->middleware('auth');
							Route::get("/admin/inventario/ajax/{id}", "admin\InventarioController@getAjax")->middleware('auth');
							Route::get("/admin/inventario/excel", "admin\InventarioController@getExcel")->middleware('auth');
						    //  EO : Inventario



							// BO : Inventario_log
						  Route::get("/admin/inventario_log", "admin\Inventario_logController@index")->middleware('auth');
							Route::get("/admin/inventario_log/add", "admin\Inventario_logController@getAdd")->middleware('auth');
							Route::post("/admin/inventario_log/add", "admin\Inventario_logController@postAdd")->middleware('auth');
							Route::get("/admin/inventario_log/edit/{id}", "admin\Inventario_logController@getEdit")->middleware('auth');
							Route::post("/admin/inventario_log/edit", "admin\Inventario_logController@postEdit")->middleware('auth');
							Route::get("/admin/inventario_log/view/{id}", "admin\Inventario_logController@view")->middleware('auth');
							Route::get("/admin/inventario_log/baja/{id}", "admin\Inventario_logController@baja")->middleware('auth');
							Route::get("/admin/inventario_log/alta/{id}", "admin\Inventario_logController@alta")->middleware('auth');
							Route::get("/admin/inventario_log/ajax/{id}", "admin\Inventario_logController@getAjax")->middleware('auth');
							Route::get("/admin/inventario_log/excel", "admin\Inventario_logController@getExcel")->middleware('auth');
						    //  EO : Inventario_log



							// BO : Reservaciones
						  Route::get("/admin/reservaciones", "admin\ReservacionesController@index")->middleware('auth');
							Route::get("/admin/reservaciones/add", "admin\ReservacionesController@getAdd")->middleware('auth');
							Route::post("/admin/reservaciones/add", "admin\ReservacionesController@postAdd")->middleware('auth');
							Route::get("/admin/reservaciones/edit/{id}", "admin\ReservacionesController@getEdit")->middleware('auth');
							Route::post("/admin/reservaciones/edit", "admin\ReservacionesController@postEdit")->middleware('auth');
							Route::get("/admin/reservaciones/view/{id}", "admin\ReservacionesController@view")->middleware('auth');
							Route::get("/admin/reservaciones/baja/{id}", "admin\ReservacionesController@baja")->middleware('auth');
							Route::get("/admin/reservaciones/alta/{id}", "admin\ReservacionesController@alta")->middleware('auth');
							Route::get("/admin/reservaciones/ajax/{id}", "admin\ReservacionesController@getAjax")->middleware('auth');
							Route::get("/admin/reservaciones/excel", "admin\ReservacionesController@getExcel")->middleware('auth');
						    //  EO : Reservaciones



							// BO : Codigos
						  Route::get("/admin/codigos", "admin\CodigosController@index")->middleware('auth');
							Route::get("/admin/codigos/add", "admin\CodigosController@getAdd")->middleware('auth');
							Route::post("/admin/codigos/add", "admin\CodigosController@postAdd")->middleware('auth');
							Route::get("/admin/codigos/edit/{id}", "admin\CodigosController@getEdit")->middleware('auth');
							Route::post("/admin/codigos/edit", "admin\CodigosController@postEdit")->middleware('auth');
							Route::get("/admin/codigos/view/{id}", "admin\CodigosController@view")->middleware('auth');
							Route::get("/admin/codigos/baja/{id}", "admin\CodigosController@baja")->middleware('auth');
							Route::get("/admin/codigos/alta/{id}", "admin\CodigosController@alta")->middleware('auth');
							Route::get("/admin/codigos/ajax/{id}", "admin\CodigosController@getAjax")->middleware('auth');
							Route::get("/admin/codigos/excel", "admin\CodigosController@getExcel")->middleware('auth');
						    //  EO : Codigos



							// BO : Reservaciones_detalle
						  Route::get("/admin/reservaciones_detalle", "admin\Reservaciones_detalleController@index")->middleware('auth');
							Route::get("/admin/reservaciones_detalle/add", "admin\Reservaciones_detalleController@getAdd")->middleware('auth');
							Route::post("/admin/reservaciones_detalle/add", "admin\Reservaciones_detalleController@postAdd")->middleware('auth');
							Route::get("/admin/reservaciones_detalle/edit/{id}", "admin\Reservaciones_detalleController@getEdit")->middleware('auth');
							Route::post("/admin/reservaciones_detalle/edit", "admin\Reservaciones_detalleController@postEdit")->middleware('auth');
							Route::get("/admin/reservaciones_detalle/view/{id}", "admin\Reservaciones_detalleController@view")->middleware('auth');
							Route::get("/admin/reservaciones_detalle/baja/{id}", "admin\Reservaciones_detalleController@baja")->middleware('auth');
							Route::get("/admin/reservaciones_detalle/alta/{id}", "admin\Reservaciones_detalleController@alta")->middleware('auth');
							Route::get("/admin/reservaciones_detalle/ajax/{id}", "admin\Reservaciones_detalleController@getAjax")->middleware('auth');
							Route::get("/admin/reservaciones_detalle/excel", "admin\Reservaciones_detalleController@getExcel")->middleware('auth');
						    //  EO : Reservaciones_detalle



							// BO : Bandas
						  Route::get("/admin/bandas", "admin\BandasController@index")->middleware('auth');
							Route::get("/admin/bandas/add", "admin\BandasController@getAdd")->middleware('auth');
							Route::post("/admin/bandas/add", "admin\BandasController@postAdd")->middleware('auth');
							Route::get("/admin/bandas/edit/{id}", "admin\BandasController@getEdit")->middleware('auth');
							Route::post("/admin/bandas/edit", "admin\BandasController@postEdit")->middleware('auth');
							Route::get("/admin/bandas/view/{id}", "admin\BandasController@view")->middleware('auth');
							Route::get("/admin/bandas/baja/{id}", "admin\BandasController@baja")->middleware('auth');
							Route::get("/admin/bandas/alta/{id}", "admin\BandasController@alta")->middleware('auth');
							Route::get("/admin/bandas/ajax/{id}", "admin\BandasController@getAjax")->middleware('auth');
							Route::get("/admin/bandas/excel", "admin\BandasController@getExcel")->middleware('auth');
              Route::get("/admin/bandas/existencias/{id}", "admin\BandasController@getExistencia")->middleware('auth');
							//  EO : Bandas



							// BO : Chat
						  Route::get("/admin/chat", "admin\ChatController@index")->middleware('auth');
							Route::get("/admin/chat/add", "admin\ChatController@getAdd")->middleware('auth');
							Route::get("/admin/chat/edit/{id}", "admin\ChatController@getEdit")->middleware('auth');
							Route::post("/admin/chat/edit", "admin\ChatController@postEdit")->middleware('auth');
              Route::get("/admin/chat/ajax/{id}", "admin\ChatController@getAjax")->middleware('auth');
              Route::get("/admin/chat/contacts", "admin\ChatController@getContacts")->middleware('auth');
              Route::get("/admin/chat/mensajes", "admin\ChatController@getNewMessages")->middleware('auth');
              //  EO : Chat

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
