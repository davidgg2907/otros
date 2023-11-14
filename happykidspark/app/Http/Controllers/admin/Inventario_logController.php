<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventario_log;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Inventario_logController extends Controller
{
    public $v_fields=array('inventario_log.usr_id', 'inventario_log.producto_id', 'inventario_log.cantidad', 'inventario_log.anterior', 'inventario_log.posterior', 'inventario_log.movimiento', 'inventario_log.fecha', 'inventario_log.descripcion', 'inventario_log.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $inventario_log = new \App\admin\Inventario_log;

        $config = array();

        $config['titulo'] = "inventario_log";

        $config['cancelar'] = url('/admin/inventario_log');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de inventario_log",
            'href' => url('/admin/inventario_log'),
            'active' => false
        );

        $data = $inventario_log->getInventario_logData($per_page, $request, $sortBy, $order);

        return view('admin/inventario_log/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $inventario_log = new \App\admin\Inventario_log;

      $config = array();

      $config['titulo'] = "inventario_log";

      $config['cancelar'] = url('/admin/inventario_log');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de inventario_log",
          'href' => url('/admin/inventario_log'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar inventario_log",
          'href' => url('/admin/inventario_log/add'),
          'active' => true
      );

      $data = new $inventario_log;

    	return view('admin/inventario_log/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $inventario_log = new \App\admin\Inventario_log;
        $inventario_log->addInventario_log($request);
        $request->session()->flash('message', 'inventario_log Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Inventario_logController@index');
    }

    public function getEdit($id=''){

        $inventario_log = new \App\admin\Inventario_log;

        $users = $inventario_log->getAll('inventario_log');

        $data = $inventario_log->getInventario_log($id);

        $config = array();

        $config['titulo'] = "inventario_log";

        $config['cancelar'] = url('/admin/inventario_log');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de inventario_log",
            'href' => url('/admin/inventario_log'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar inventario_log",
            'href' => url('/admin/inventario_log/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/inventario_log/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/inventario_log/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $inventario_log = new \App\admin\Inventario_log;
        if($inventario_log->updateInventario_log($request)){
            $request->session()->flash('message', 'inventario_log Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Inventario_logController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Inventario_logController@index');
        }
    }

    public function view($id){

      $inventario_log = new \App\admin\Inventario_log;

      $data = $inventario_log->getInventario_logView($id);

      $config = array();

      $config['titulo'] = "inventario_log";

      $config['cancelar'] = url('/admin/inventario_log');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de inventario_log",
          'href' => url('/admin/inventario_log'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de inventario_log",
          'href' => url('/admin/inventario_log/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/inventario_log/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/inventario_log/view');

      }

    }

    public function baja($id){

        $inventario_log = new \App\admin\Inventario_log;
        $flag = $inventario_log->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$inventario_log deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Inventario_logController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Inventario_logController@index');
        }
    }

    public function alta($id){
        $inventario_log = new \App\admin\Inventario_log;
        $flag = $inventario_log->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$inventario_log habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Inventario_logController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Inventario_logController@index');
        }
    }

    public function getAjax($id){

      $inventario_log = new \App\admin\Inventario_log;

      $data = $inventario_log->getInventario_logView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $inventario_log = new \App\admin\Inventario_log;

      $data = $inventario_log->getInventario_logExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$inventario_log', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
