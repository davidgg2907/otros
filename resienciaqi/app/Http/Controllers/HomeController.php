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
      public $url_movs = '/';

      /**
       * Show the application dashboard.
       *
       * @return \Illuminate\Http\Response
       */
      public function index(Request $request) {
        return view('panels/admin', []);
      }

      public function sendMailing(Request $request) {

        if($request->input('prospecto_id') != 0) {

          $prospectos = explode(',',$request->input('prospecto_id'));
          print_r($prospectos);
          foreach($prospectos as $record) {

            if($record != "") {

              $info = \App\admin\Prospectos::find($record);

              $data = array('prospecto_id'  => $record,
                            'cliente_id'    => 0,
                            'comentarios'   => " Correo Electronico Enviado, " . $request->input('titulo'),
                            'estatus_id'    => $info->estatus_id);

              \App\admin\Bitacora::addBitacora($data);

            }

          }

        } else {

          $clientes = explode(',',$request->input('cliente_id'));

          foreach($clientes as $record) {

            if($record != "") {
              $info = \App\admin\Clientes::find($record);

              $data = array('prospecto_id'  => $info->prospecto_id,
                            'cliente_id'    => $record,
                            'comentarios'   => " Correo electronico enviado, " . $request->input('titulo'),
                            'estatus_id'    => $info->estatus_id);

              \App\admin\Bitacora::addBitacora($data);
            }
          }
      }

      $request->session()->flash('message', 'Correo(s), enviado(s) exitosamente, se ha registrado la actividad en la bitacora');
      $request->session()->flash('exito', 'true');
      return redirect($request->input('redirect'));


    }

  }
