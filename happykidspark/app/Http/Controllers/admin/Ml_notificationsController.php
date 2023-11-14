<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ml_notifications;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Ml_notificationsController extends Controller
{
    public $v_fields=array('ml_notifications.ml_id', 'ml_notifications.resource', 'ml_notifications.user_id', 'ml_notifications.application_id', 'ml_notifications.attempts', 'ml_notifications.sent', 'ml_notifications.received', 'ml_notifications.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ml_notifications = new \App\admin\Ml_notifications;

        $config = array();

        $config['titulo'] = "ml_notifications";

        $config['cancelar'] = url('/admin/ml_notifications');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ml_notifications",
            'href' => url('/admin/ml_notifications'),
            'active' => false
        );

        $data = $ml_notifications->getMl_notificationsData($per_page, $request, $sortBy, $order);

        return view('admin/ml_notifications/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $ml_notifications = new \App\admin\Ml_notifications;

      $config = array();

      $config['titulo'] = "ml_notifications";

      $config['cancelar'] = url('/admin/ml_notifications');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ml_notifications",
          'href' => url('/admin/ml_notifications'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar ml_notifications",
          'href' => url('/admin/ml_notifications/add'),
          'active' => true
      );

      $data = new $ml_notifications;

    	return view('admin/ml_notifications/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $ml_notifications = new \App\admin\Ml_notifications;
        $ml_notifications->addMl_notifications($request);
        $request->session()->flash('message', 'ml_notifications Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Ml_notificationsController@index');
    }

    public function getEdit($id=''){

        $ml_notifications = new \App\admin\Ml_notifications;

        $users = $ml_notifications->getAll('ml_notifications');

        $data = $ml_notifications->getMl_notifications($id);

        $config = array();

        $config['titulo'] = "ml_notifications";

        $config['cancelar'] = url('/admin/ml_notifications');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ml_notifications",
            'href' => url('/admin/ml_notifications'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar ml_notifications",
            'href' => url('/admin/ml_notifications/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/ml_notifications/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/ml_notifications/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $ml_notifications = new \App\admin\Ml_notifications;
        if($ml_notifications->updateMl_notifications($request)){
            $request->session()->flash('message', 'ml_notifications Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Ml_notificationsController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Ml_notificationsController@index');
        }
    }

    public function view($id){

      $ml_notifications = new \App\admin\Ml_notifications;

      $data = $ml_notifications->getMl_notificationsView($id);

      $config = array();

      $config['titulo'] = "ml_notifications";

      $config['cancelar'] = url('/admin/ml_notifications');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ml_notifications",
          'href' => url('/admin/ml_notifications'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de ml_notifications",
          'href' => url('/admin/ml_notifications/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/ml_notifications/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/ml_notifications/view');

      }

    }

    public function baja($id){

        $ml_notifications = new \App\admin\Ml_notifications;
        $flag = $ml_notifications->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$ml_notifications deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ml_notificationsController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ml_notificationsController@index');
        }
    }

    public function alta($id){
        $ml_notifications = new \App\admin\Ml_notifications;
        $flag = $ml_notifications->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$ml_notifications habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ml_notificationsController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ml_notificationsController@index');
        }
    }

    public function getAjax($id){

      $ml_notifications = new \App\admin\Ml_notifications;

      $data = $ml_notifications->getMl_notificationsView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $ml_notifications = new \App\admin\Ml_notifications;

      $data = $ml_notifications->getMl_notificationsExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$ml_notifications', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
