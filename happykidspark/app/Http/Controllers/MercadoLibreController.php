<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Auth;
use PDF;

class MercadoLibreController extends Controller
{

    public function index(Request $request){

      $connect = new \App\admin\MlConnect;

      $response = $connect->getSites();

      print_r($response);

    }

    public function webhook() {

      $body = @file_get_contents('php://input');
      $json = json_decode($body);
      $notifications = new \App\admin\Ml_notifications;

      $notifications->ml_id = $json->_id;
      $notifications->resource = $json->resource;
      $notifications->user_id = $json->user_id;
      $notifications->topic = $json->topic;
      $notifications->application_id = $json->application_id;
      $notifications->attempts = $json->attempts;
      $notifications->sent = $json->sent;
      $notifications->received = $json->received;
      $notifications->status = 1;
      $notifications->save();

      return 200;

    }

    public function catchCode(Request $request) {

      $configuracion = new \App\admin\Configuracion;

      $config = $configuracion->getConfiguracion(1);

      $config->ml_code = $request->input('code');
      $config->save();

    }

    public function refreshToken() {

      $configuracion = new \App\admin\Configuracion;
      $config        = $configuracion->getConfiguracion(1);

      $connect       = new \App\admin\MlConnect;

      $response = $connect->refreshToken();

      $config->ml_token       = $response->access_token;
      $config->ml_rtoken      = $response->refresh_token;
      $config->ml_tokenexpire = $response->expires_in;
      $config->save();


    }


    public function createToken() {

      $configuracion = new \App\admin\Configuracion;
      $config        = $configuracion->getConfiguracion(1);

      $connect       = new \App\admin\MlConnect;

      $response = $connect->createToken();

      $config->ml_token       = $response->access_token;
      $config->ml_rtoken      = $response->refresh_token;
      $config->ml_tokenexpire = $response->expires_in;
      $config->save();


    }

}


///{"id":1318353234,"email":"test_user_1318353234@testuser.com","nickname":"TEST_USER_1318353234","site_status":"active","password":"vMYNUleZ3b"}
