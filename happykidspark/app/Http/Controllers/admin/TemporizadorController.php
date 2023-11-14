<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Temporizador;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class TemporizadorController extends Controller
{
    public $v_fields=array('temporizador.venta_id', 'temporizador.vtadetalle_id', 'temporizador.cliente_id', 'temporizador.tiempo_id', 'temporizador.producto_id', 'temporizador.inicia', 'temporizador.termina', 'temporizador.nombre', 'temporizador.telefono', 'temporizador.qr', 'temporizador.barras', 'temporizador.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $temporizador = new \App\admin\Temporizador;

        $config = array();

        $config['titulo'] = "temporizador";

        $config['cancelar'] = url('/admin/temporizador');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de temporizador",
            'href' => url('/admin/temporizador'),
            'active' => false
        );

        $data = $temporizador->getTemporizadorData($per_page, $request, $sortBy, $order);

        return view('admin/temporizador/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function verCronometros(Request $request){

        return view('admin/temporizador/cronometro');
    }

    public function getAdd(Request $request){

      $data = \App\admin\Temporizador::whereIn('status',array(1,2,4))
                                     ->orderBy('termina','DESC')
                                     ->get();

      $html = '';

      foreach ($data as $value) {

        $date1 = new \DateTime(date('Y-m-d H:i:s'));
        $date2 = new \DateTime($value->termina);
        $diff = $date1->diff($date2);

        $click_event = '';

        if($diff->i <= "0") {

          $bg_color = 'bg-danger';
          $click_event = '<button class="btn btn-block btn-lg btn-danger" type="button" onclick="cerrarJuego(' . $value->id .')" style="cursor:pointer"> <i class="fa fa-play fa-lg"></i></button>';

        }

        if($value->status == 1) {
          $bg_color = 'table-secondary';
          $click_event = '<button class="btn btn-block btn-lg btn-success" type="button" onclick="iniciarJuego(' . $value->id .')" style="cursor:pointer"> <i class="fa fa-play fa-2x"></i></button>';

          $inicia = "";
          $termina = "";
          $timer = ' ';
        } else {

          if($value->status == 4) {
            $timer = $value->quedan . ' Mins';
            $bg_color = 'table-warning';
            $click_event = '<button class="btn btn-block btn-lg btn-success" type="button" onclick="reiniciarJuego(' . $value->id .')" style="cursor:pointer"> <i class="fa fa-play fa-2x"></i></button>';
          } else {

            $inicia  = date('G:i:s',strtotime($value->inicia));
            $termina = date('G:i:s',strtotime($value->termina));

            if($value->termina > date('Y-m-d G:i:s')) {

              $timer = $diff->i . ' Mins';

              if($diff->i <= "0") {

                $bg_color = 'table-danger';
                $click_event = '<button class="btn btn-block btn-lg btn-danger" type="button" onclick="cerrarJuego(' . $value->id .')" style="cursor:pointer""> <i class="fa fa-times-circle fa-2x"></i></button>';

              } else {
                $bg_color = 'table-primary';
                $click_event = '<button class="btn btn-block btn-lg btn-warning" type="button" onclick="pausarJuego(' . $value->id .')" style="cursor:pointer"> <i class="fa fa-circle-pause fa-2x"></i></button>
                                &nbsp;
                                <button class="btn btn-block btn-lg btn-danger" type="button" onclick="cancelarJuego(' . $value->id .')" style="cursor:pointer"> <i class="fa fa-times-circle fa-2x"></i></button>';
              }

            } else {

              $timer = '0 Mins';
              $bg_color = 'table-danger';
              $click_event = '<button class="btn btn-block btn-lg btn-danger" type="button" onclick="cerrarJuego(' . $value->id .')" style="cursor:pointer""> <i class="fa fa-times-circle fa-2x"></i></button>';

            }


          }

        }

        $html .= '<tr class="' . $bg_color. '">
                    <td style="padding:20px;">
                      <h1>' . $value->nombre;
                      if($value->status == 2) {
                        $html .= ' <small>( <i class="fa fa-archive fa-lg"></i> ' . $value->locker .' )</small>';
                      }
            $html .= '</h1>
                    </td>
                    <td style="padding:20px;"><h1>' .  $inicia . '</h1></td>
                    <td style="padding:20px;"><h1>' . $termina . '</h1></td>
                    <td style="padding:20px;"><h1>' . $timer . '</h1></td>
                    <td style="padding:20px;" class="text-center"> ' . $click_event. '</td>
                  </tr>';

      }

      return array('error' => 0,'html' => $html);

    }

    public function postAdd($id,Request $request){

      $temporizador = \App\admin\Temporizador::where('id',$id)->where('status',1)->first();

      if(count($temporizador)) {

        $tiempo = \App\admin\Tiempos::find($temporizador->tiempo_id);

        $inicio = date('Y-m-d G:i:s');

        $termina = date('Y-m-d G:i:s',strtotime($inicio . ' + ' . $tiempo->minutos . ' minutes'));

        $temporizador->inicia   = $inicio;
        $temporizador->termina  = $termina;
        $temporizador->status   = 2;
        $temporizador->locker   = $request->input('locker');
        $temporizador->save();

        //$temporizador->status=1;
        return array('error' => 0);
      } else {
        return array('error' => 1,
                     'msg' => 'No se encontro informacion del temporizador, puede que este ya fuese iniciado con anterioridad'
                    );
      }

    }

    public function getEdit($id=''){

        $temporizador = new \App\admin\Temporizador;

        $users = $temporizador->getAll('temporizador');

        $data = $temporizador->getTemporizador($id);

        $config = array();

        $config['titulo'] = "temporizador";

        $config['cancelar'] = url('/admin/temporizador');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de temporizador",
            'href' => url('/admin/temporizador'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar temporizador",
            'href' => url('/admin/temporizador/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/temporizador/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/temporizador/edit');
        }
    }

    public function postEdit($id){

      $temporizador = \App\admin\Temporizador::find($id);

      if(count($temporizador)) {

        $temporizador->status   = 3;
        $temporizador->save();
        //$temporizador->status=1;
        return array('error' => 0);
      } else {
        return array('error' => 1,
                     'msg' => 'No se encontro informacion del temporizador, puede que este ya fuese iniciado con anterioridad'
                    );
      }

    }

    public function view($id){

      $temporizador = new \App\admin\Temporizador;

      $data = $temporizador->getTemporizadorView($id);

      $config = array();

      $config['titulo'] = "temporizador";

      $config['cancelar'] = url('/admin/temporizador');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de temporizador",
          'href' => url('/admin/temporizador'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de temporizador",
          'href' => url('/admin/temporizador/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/temporizador/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/temporizador/view');

      }

    }

    public function pause($id){

      $temporizador = \App\admin\Temporizador::find($id);

      if(count($temporizador)) {

        $tiempo = \App\admin\Tiempos::find($temporizador->tiempo_id);

        $date1 = new \DateTime(date('Y-m-d G:i:s'));
        $date2 = new \DateTime($temporizador->termina);
        $diff = $date1->diff($date2);


        $inicio = $temporizador->inicia;

        $termina = date('Y-m-d G:i:s',strtotime($inicio . ' + ' . $tiempo->minutos . ' minutes'));

        $temporizador->inicia   = $inicio;
        $temporizador->pausado  = date('Y-m-d G:i:s');
        $temporizador->quedan   = $diff->i;
        $temporizador->status   = 4;
        $temporizador->save();
        //$temporizador->status=1;
        return array('error' => 0);
      } else {
        return array('error' => 1,
                     'msg' => 'No se encontro informacion del temporizador, puede que este ya fuese iniciado con anterioridad'
                    );
      }

    }

    public function baja($id){

      $temporizador = \App\admin\Temporizador::find($id);

      if(count($temporizador)) {

        $temporizador->status   = 0;
        $temporizador->save();
        //$temporizador->status=1;
        return array('error' => 0);
      } else {
        return array('error' => 1,
                     'msg' => 'No se encontro informacion del temporizador, puede que este ya fuese iniciado con anterioridad'
                    );
      }
    }

    public function alta($id){

      $temporizador = \App\admin\Temporizador::find($id);

      if(count($temporizador)) {

        $tiempo = \App\admin\Tiempos::find($temporizador->tiempo_id);

        $inicio = date('Y-m-d G:i:s');

        $termina = date('Y-m-d G:i:s',strtotime($inicio . ' + ' . $temporizador->quedan . ' minutes'));

        $temporizador->termina  = $termina;
        $temporizador->status   = 2;
        $temporizador->save();
        //$temporizador->status=1;
        return array('error' => 0);
      } else {
        return array('error' => 1,
                     'msg' => 'No se encontro informacion del temporizador, puede que este ya fuese iniciado con anterioridad'
                    );
      }

    }

    public function getAjax($id){

      $temporizador = new \App\admin\Temporizador;

      $data = $temporizador->getTemporizadorView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $temporizador = new \App\admin\Temporizador;

      $data = $temporizador->getTemporizadorExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$temporizador', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
