<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservaciones_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Reservaciones_detalleController extends Controller
{
    public $v_fields=array('reservaciones_detalle.reservacion_id', 'reservaciones_detalle.producto_id', 'reservaciones_detalle.cantidad', 'reservaciones_detalle.precio', 'reservaciones_detalle.importe', 'reservaciones_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $reservaciones_detalle = new \App\admin\Reservaciones_detalle;

        $config = array();

        $config['titulo'] = "reservaciones_detalle";

        $config['cancelar'] = url('/admin/reservaciones_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de reservaciones_detalle",
            'href' => url('/admin/reservaciones_detalle'),
            'active' => false
        );

        $data = $reservaciones_detalle->getReservaciones_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/reservaciones_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $reservaciones_detalle = new \App\admin\Reservaciones_detalle;

      $config = array();

      $config['titulo'] = "reservaciones_detalle";

      $config['cancelar'] = url('/admin/reservaciones_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de reservaciones_detalle",
          'href' => url('/admin/reservaciones_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar reservaciones_detalle",
          'href' => url('/admin/reservaciones_detalle/add'),
          'active' => true
      );

      $data = new $reservaciones_detalle;

    	return view('admin/reservaciones_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $reservaciones_detalle = new \App\admin\Reservaciones_detalle;
        $reservaciones_detalle->addReservaciones_detalle($request);
        $request->session()->flash('message', 'reservaciones_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Reservaciones_detalleController@index');
    }

    public function getEdit($id=''){

        $reservaciones_detalle = new \App\admin\Reservaciones_detalle;

        $users = $reservaciones_detalle->getAll('reservaciones_detalle');

        $data = $reservaciones_detalle->getReservaciones_detalle($id);

        $config = array();

        $config['titulo'] = "reservaciones_detalle";

        $config['cancelar'] = url('/admin/reservaciones_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de reservaciones_detalle",
            'href' => url('/admin/reservaciones_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar reservaciones_detalle",
            'href' => url('/admin/reservaciones_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/reservaciones_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/reservaciones_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $reservaciones_detalle = new \App\admin\Reservaciones_detalle;
        if($reservaciones_detalle->updateReservaciones_detalle($request)){
            $request->session()->flash('message', 'reservaciones_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Reservaciones_detalleController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Reservaciones_detalleController@index');
        }
    }

    public function view($id){

      $reservaciones_detalle = new \App\admin\Reservaciones_detalle;

      $data = $reservaciones_detalle->getReservaciones_detalleView($id);

      $config = array();

      $config['titulo'] = "reservaciones_detalle";

      $config['cancelar'] = url('/admin/reservaciones_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de reservaciones_detalle",
          'href' => url('/admin/reservaciones_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de reservaciones_detalle",
          'href' => url('/admin/reservaciones_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/reservaciones_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/reservaciones_detalle/view');

      }

    }

    public function baja($id){

        $reservaciones_detalle = new \App\admin\Reservaciones_detalle;
        $flag = $reservaciones_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$reservaciones_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Reservaciones_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Reservaciones_detalleController@index');
        }
    }

    public function alta($id){
        $reservaciones_detalle = new \App\admin\Reservaciones_detalle;
        $flag = $reservaciones_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$reservaciones_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Reservaciones_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Reservaciones_detalleController@index');
        }
    }

    public function getAjax($id){

      $reservaciones_detalle = new \App\admin\Reservaciones_detalle;

      $data = $reservaciones_detalle->getReservaciones_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $reservaciones_detalle = new \App\admin\Reservaciones_detalle;

      $data = $reservaciones_detalle->getReservaciones_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$reservaciones_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
