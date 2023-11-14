<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class MlConnect extends Model {

  private $server ="https://api.mercadolibre.com/";

  /*
          ML TOKEN: APP_USR-4723405037989850-022600-f35bbf55b35d56e2ba2a0eaf87f0f438-724975276
  ML REFRESH TOLEN: TG-63fae3278d37d90001145676-724975276
  */



  /* GENERAL FUNCTIONS START*/
  public function getApp() {

    $client = new Client();
    $config = \App\admin\Configuracion::getInfo();


    $url = $this->server . 'applications/' . $config->ml_appkey;

    $res =$client->get($url,['headers' =>['Content-type'  => 'Application/json',
                                          ]
                             ]);

    $result = json_decode($res->getBody()->getContents());

    return $result;

  }

  public function getSites() {

    $config = \App\admin\Configuracion::getInfo();
    $client = new Client();

    $url = $this->server . 'sites';

    $res =$client->get($url,['headers' =>['Accept'        => 'Application/json',
                                          'Authorization' => 'Bearer ' . $config->ml_token,
                                          'Content-Type'  => 'application/x-www-form-urlencoded']
                             ]);

    $result = json_decode($res->getBody()->getContents());

    return $result;

  }

  /* PERSONAL FUNCTIONS */

  public function createToken() {

    $config = \App\admin\Configuracion::getInfo();

    $client = new Client();

    $url = $this->server . 'oauth/token';
    print_r($config);
    $res =$client->post($url,['headers' =>['Accept'  => 'Application/json',
                                           'Content-type' => 'application/x-www-form-urlencoded'],
                              'body' => json_encode(['grant_type'    => 'authorization_code',
                                                     'client_id'     => $config->ml_appkey,
                                                     'client_secret' => $config->ml_appsecret,
                                                     'code'          => $config->ml_code,
                                                     'redirect_uri'  => 'https://app.clicklife.mx/mlauth'
                                                    ])
                             ]);

     $result = json_decode($res->getBody()->getContents());

     return $result;
  }

  public function refreshToken() {

    $config = \App\admin\Configuracion::getInfo();

    $client = new Client();

    $url = $this->server . 'oauth/token';

    $res =$client->post($url,['headers' =>['Accept'  => 'Application/json',
                                           'Content-Type' => 'application/x-www-form-urlencoded'],
                              'body' => json_encode(['grant_type'    => 'refresh_token',
                                                     'client_id'     => $config->ml_appkey,
                                                     'client_secret' => $config->ml_appsecret,
                                                     'refresh_token'  => $config->ml_rtoken
                                                    ])
                             ]);

    $result = json_decode($res->getBody()->getContents());

    return $result;
  }

  private function loginMl() {



  }





  public function getPublicaciones() {

  }

  //https://auth.mercadolibre.com.com/authorization?response_type=code&client_id=7595937698330383&redirect_uri=https://app.clicklife.mx/mlauth&code_challenge=$CODE_CHALLENGE&code_challenge_method=$CODE_METHOD
  //https://auth.mercadolibre.com.mx/authorization?response_type=code&client_id=7595937698330383&redirect_uri=https://app.clicklife.mx/mlauth


}
