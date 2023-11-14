<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Efectivo;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class EfectivoController extends Controller
{
    public $v_fields=array('efectivo.tipo', 'efectivo.importe', 'efectivo.concepto', 'efectivo.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $efectivo = new \App\admin\Efectivo;

        $config = array();

        $config['titulo'] = "efectivo";

        $config['cancelar'] = url('/admin/efectivo');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de efectivo",
            'href' => url('/admin/efectivo'),
            'active' => false
        );

        $data = $efectivo->getEfectivoData($per_page, $request, $sortBy, $order);

        return view('admin/efectivo/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){


      $code = \App\admin\Codigos::where('codigo',$request->input('code_auth'))->first();

      if(count($code)) {

        if($code->status == 1) {

          $efectivo = new \App\admin\Efectivo;
          $efectivo->caja_id    = $request->input('caja_id');
          $efectivo->fecha      = date('Y-m-d');
          $efectivo->hora       = date('G:i:s');
          $efectivo->tipo       = $request->input('tipo');
          $efectivo->importe    = $request->input('monto');
          $efectivo->concepto   = $request->input('concepto');
          $efectivo->save();

          $code->status = 2;
          $code->usr_usa_id = Auth::user()->id;
          $code->save();

        } elseif($code->status == 2) {
          return array('error' =>1, 'msg' => 'El codigo ya ha sido utilizado','data' => array());
        } elseif ($code->status == 0) {
          return array('error' =>1, 'msg' => 'El codigo especificado ya ha caducado','data' => array());
        }

        //Reseteamos el codigo


        return array('error' =>0 ,'msg');

      } else {

        if($code->status == 2) {
          return array('error' =>1, 'msg' => 'El codigo ya ha sido utilizado','data' => array());
        } elseif ($code->status == 0) {
          return array('error' =>1, 'msg' => 'El codigo especificado ya ha caducado','data' => array());
        }

      }



      //return array('error' => '0','msg' =>);

    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $efectivo = new \App\admin\Efectivo;
        $efectivo->addEfectivo($request);
        $request->session()->flash('message', 'efectivo Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\EfectivoController@index');
    }

    public function getEdit($id=''){

        $efectivo = new \App\admin\Efectivo;

        $users = $efectivo->getAll('efectivo');

        $data = $efectivo->getEfectivo($id);

        $config = array();

        $config['titulo'] = "efectivo";

        $config['cancelar'] = url('/admin/efectivo');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de efectivo",
            'href' => url('/admin/efectivo'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar efectivo",
            'href' => url('/admin/efectivo/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/efectivo/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/efectivo/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $efectivo = new \App\admin\Efectivo;
        if($efectivo->updateEfectivo($request)){
            $request->session()->flash('message', 'efectivo Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\EfectivoController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\EfectivoController@index');
        }
    }

    public function view($id){

      $efectivo = new \App\admin\Efectivo;

      $data = $efectivo->getEfectivoView($id);

      $config = array();

      $config['titulo'] = "efectivo";

      $config['cancelar'] = url('/admin/efectivo');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de efectivo",
          'href' => url('/admin/efectivo'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de efectivo",
          'href' => url('/admin/efectivo/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/efectivo/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/efectivo/view');

      }

    }

    public function baja($id){

        $efectivo = new \App\admin\Efectivo;
        $flag = $efectivo->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$efectivo deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EfectivoController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EfectivoController@index');
        }
    }

    public function alta($id){
        $efectivo = new \App\admin\Efectivo;
        $flag = $efectivo->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$efectivo habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EfectivoController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EfectivoController@index');
        }
    }

    public function getAjax($id){

      $efectivo = \App\admin\Efectivo::where('caja_id',$id)->get();

      if(count($efectivo)){

        $html = '';

        foreach($efectivo as $money) {
          $tipo = $money->tipo == 'I' ? '<i class="fa fa-lg fa-dollar text-info"></i> INGRESO' : ' <i class="fa fa-lg fa-money-bill-alt text-danger"></i> EGRESO';
          $html .= '<tr>
                      <td>' . $tipo . '</td>
                      <td>' . $money->importe. '</td>
                      <td>' . $money->concepto. '</td>
                    </tr>';
        }

        return array('error' =>0, 'msg' => '','data' => $data,'html' => $html);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $efectivo = new \App\admin\Efectivo;

      $data = $efectivo->getEfectivoExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$efectivo', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
