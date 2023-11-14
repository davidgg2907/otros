<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Ventas_detalleController extends Controller
{
    public $v_fields=array('ventas_detalle.id', 'ventas_detalle.venta_id', 'ventas_detalle.almacen_id', 'ventas_detalle.producto_id', 'ventas_detalle.variante', 'ventas_detalle.cantidad', 'ventas_detalle.costo', 'ventas_detalle.ingreso_ml', 'ventas_detalle.envio_ml', 'ventas_detalle.comision_ml', 'ventas_detalle.reembolso_ml', 'ventas_detalle.ganancia', 'ventas_detalle.pventa', 'ventas_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas_detalle = new \App\admin\Ventas_detalle;

        $config = array();

        $config['titulo'] = "ventas_detalle";

        $config['cancelar'] = url('/admin/ventas_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ventas_detalle",
            'href' => url('/admin/ventas_detalle'),
            'active' => false
        );

        $data = $ventas_detalle->getVentas_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/ventas_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $ventas_detalle = new \App\admin\Ventas_detalle;

      $config = array();

      $config['titulo'] = "ventas_detalle";

      $config['cancelar'] = url('/admin/ventas_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ventas_detalle",
          'href' => url('/admin/ventas_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar ventas_detalle",
          'href' => url('/admin/ventas_detalle/add'),
          'active' => true
      );

      $data = new $ventas_detalle;

    	return view('admin/ventas_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $ventas_detalle = new \App\admin\Ventas_detalle;
        $ventas_detalle->addVentas_detalle($request);
        $request->session()->flash('message', 'ventas_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Ventas_detalleController@index');
    }

    public function getEdit($id=''){

        $ventas_detalle = new \App\admin\Ventas_detalle;

        $users = $ventas_detalle->getAll('ventas_detalle');

        $data = $ventas_detalle->getVentas_detalle($id);

        $config = array();

        $config['titulo'] = "ventas_detalle";

        $config['cancelar'] = url('/admin/ventas_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ventas_detalle",
            'href' => url('/admin/ventas_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar ventas_detalle",
            'href' => url('/admin/ventas_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/ventas_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/ventas_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $ventas_detalle = new \App\admin\Ventas_detalle;
        if($ventas_detalle->updateVentas_detalle($request)){
            $request->session()->flash('message', 'ventas_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Ventas_detalleController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_detalleController@index');
        }
    }

    public function view($id){

      $ventas_detalle = new \App\admin\Ventas_detalle;

      $data = $ventas_detalle->getVentas_detalleView($id);

      $config = array();

      $config['titulo'] = "ventas_detalle";

      $config['cancelar'] = url('/admin/ventas_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ventas_detalle",
          'href' => url('/admin/ventas_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de ventas_detalle",
          'href' => url('/admin/ventas_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/ventas_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/ventas_detalle/view');

      }

    }

    public function baja($id){

        $ventas_detalle = new \App\admin\Ventas_detalle;
        $flag = $ventas_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$ventas_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ventas_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_detalleController@index');
        }
    }

    public function alta($id){
        $ventas_detalle = new \App\admin\Ventas_detalle;
        $flag = $ventas_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$ventas_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ventas_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_detalleController@index');
        }
    }

    public function getAjax($id){

      $ventas_detalle = new \App\admin\Ventas_detalle;

      $data = $ventas_detalle->getVentas_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $ventas_detalle = new \App\admin\Ventas_detalle;

      $data = $ventas_detalle->getVentas_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$ventas_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
