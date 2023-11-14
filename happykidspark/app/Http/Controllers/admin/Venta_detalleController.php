<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Venta_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Venta_detalleController extends Controller
{
    public $v_fields=array('venta_detalle.id', 'venta_detalle.venta_id', 'venta_detalle.producto_id', 'venta_detalle.temporizador_id', 'venta_detalle.cantidad', 'venta_detalle.precio', 'venta_detalle.importe', 'venta_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $venta_detalle = new \App\admin\Venta_detalle;

        $config = array();

        $config['titulo'] = "venta_detalle";

        $config['cancelar'] = url('/admin/venta_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de venta_detalle",
            'href' => url('/admin/venta_detalle'),
            'active' => false
        );

        $data = $venta_detalle->getVenta_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/venta_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $venta_detalle = new \App\admin\Venta_detalle;

      $config = array();

      $config['titulo'] = "venta_detalle";

      $config['cancelar'] = url('/admin/venta_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de venta_detalle",
          'href' => url('/admin/venta_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar venta_detalle",
          'href' => url('/admin/venta_detalle/add'),
          'active' => true
      );

      $data = new $venta_detalle;

    	return view('admin/venta_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $venta_detalle = new \App\admin\Venta_detalle;
        $venta_detalle->addVenta_detalle($request);
        $request->session()->flash('message', 'venta_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Venta_detalleController@index');
    }

    public function getEdit($id=''){

        $venta_detalle = new \App\admin\Venta_detalle;

        $users = $venta_detalle->getAll('venta_detalle');

        $data = $venta_detalle->getVenta_detalle($id);

        $config = array();

        $config['titulo'] = "venta_detalle";

        $config['cancelar'] = url('/admin/venta_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de venta_detalle",
            'href' => url('/admin/venta_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar venta_detalle",
            'href' => url('/admin/venta_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/venta_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/venta_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $venta_detalle = new \App\admin\Venta_detalle;
        if($venta_detalle->updateVenta_detalle($request)){
            $request->session()->flash('message', 'venta_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Venta_detalleController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Venta_detalleController@index');
        }
    }

    public function view($id){

      $venta_detalle = new \App\admin\Venta_detalle;

      $data = $venta_detalle->getVenta_detalleView($id);

      $config = array();

      $config['titulo'] = "venta_detalle";

      $config['cancelar'] = url('/admin/venta_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de venta_detalle",
          'href' => url('/admin/venta_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de venta_detalle",
          'href' => url('/admin/venta_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/venta_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/venta_detalle/view');

      }

    }

    public function baja($id){

        $venta_detalle = new \App\admin\Venta_detalle;
        $flag = $venta_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$venta_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Venta_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Venta_detalleController@index');
        }
    }

    public function alta($id){
        $venta_detalle = new \App\admin\Venta_detalle;
        $flag = $venta_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$venta_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Venta_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Venta_detalleController@index');
        }
    }

    public function getAjax($id){

      $venta_detalle = new \App\admin\Venta_detalle;

      $data = $venta_detalle->getVenta_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $venta_detalle = new \App\admin\Venta_detalle;

      $data = $venta_detalle->getVenta_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$venta_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
