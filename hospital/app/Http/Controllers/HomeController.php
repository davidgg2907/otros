<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $url_movs = '/homeInfo';
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      $citas              = new \App\admin\Citas;
      $hospitalizacion    = new \App\admin\Hospitalizacion;
      $pagos              = new \App\admin\Pagos;

      $conteo = $citas->conteoCitas();

      $contar = $hospitalizacion->conteoIngresos();

      $citas_count = array('pendientes' => 0, 'finalizadas' => 0, 'canceladas' => 0, 'total' => 0);

      $hospital_count = array('ingresados' => 0, 'altas' => 0, 'canceladas' => 0, 'total' => 0);

      foreach($conteo as $value) {

        if($value->status == 0) {

          $citas_count['canceladas'] = (int)$value->total;

        }

        if($value->status == 1) {
          $citas_count['pendientes'] = (int)$value->total;
        }

        if($value->status == 2) {
          $citas_count['finalizadas'] = (int)$value->total;
        }

        $citas_count['total'] = $citas_count['total'] + (int)$value->total;

      }

      foreach($contar as $value) {

        if($value->status == 0) {

          $hospital_count['canceladas'] = (int)$value->total;

        }

        if($value->status == 1) {
          $hospital_count['ingresados'] = (int)$value->total;
        }

        if($value->status == 2) {
          $hospital_count['altas'] = (int)$value->total;
        }

        $hospital_count['total'] = $hospital_count['total'] + (int)$value->total;

      }

      $ultimas_citas = $citas->getUltimas();

      $ultimos_pagos = $pagos->ultimos();


      //Desactivamos las citas vencidas de ayer hacia atras
      $citas->desactivaPasadas();
      $hospitalizacion->actualizaHospedajes();
      return view('home', ['citas' => $citas_count,

                           'hospitalizacion' => $hospital_count,

                           'citados' => $ultimas_citas,

                           'pagos' => $ultimos_pagos
                          ]);




    }

}
