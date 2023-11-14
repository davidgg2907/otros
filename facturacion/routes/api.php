<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//USER SESSIONS START
Route::post('login', 'admin\ApiController@login');//Solo Agente de campo
Route::post('logout', 'admin\ApiController@logout');//Solo Agente de campo
Route::post('token/refresh', 'admin\ApiController@refreshToken');//Solo Agente de campo
//USER SESSIONS END

//QUERY CONSULT START
Route::get('/sucursales', 'admin\ApiController@getSucursales');
Route::get('/sucursal/{id}', 'admin\ApiController@getSucursal');
Route::get('/roles', 'admin\ApiController@getRoles');
Route::get('/rol/{id}', 'admin\ApiController@getRol');
//QUERY CONSULT END

//USERS START
Route::get('/users', 'admin\ApiController@getUsers');
Route::get('/user/{id}', 'admin\ApiController@getUser');
Route::post('/users/add/', 'admin\ApiController@postUserAdd');
Route::post('/users/edit/', 'admin\ApiController@postUserEdit');
//USERS END

//PRODUCTOS START
Route::get('/productos', 'admin\ApiController@getProductos');
Route::get('/producto/{id}', 'admin\ApiController@getProducto');
Route::get('/plazo/{id}', 'admin\ApiController@getPlazo');
Route::get('/pregunta/{id}', 'admin\ApiController@getPregunta');
//PRODUCTOS END

//SOLICITUDES START
Route::get('/solicitudes', 'admin\ApiController@getSolicitudes');
Route::get('/solicitud/{id}', 'admin\ApiController@getSolicitud');
//SOLICITUDES END


//CREDITOS START
Route::get('/creditos', 'admin\ApiController@getCreditos');
Route::get('/credito/{id}', 'admin\ApiController@getCredito');
Route::get('/cuotas', 'admin\ApiController@getAmortizaciones');
Route::get('/cuota/{id}', 'admin\ApiController@getAmortizacion');
Route::post('/cuota/pagar', 'admin\ApiController@postPago');
//CREDITOS END


//CREDITOS START
Route::get('/pagos', 'admin\ApiController@getPagos');
Route::get('/pago/{id}', 'admin\ApiController@getPago');
//CREDITOS END













Route::get('/cobranza/dia/', 'admin\ApiController@getAmortizacionesDate');
