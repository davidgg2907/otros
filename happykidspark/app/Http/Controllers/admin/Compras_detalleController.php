<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Compras_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Compras_detalleController extends Controller
{
    public $v_fields=array('compras_detalle.compra_id', 'compras_detalle.producto_id', 'compras_detalle.cantidad', 'compras_detalle.precio', 'compras_detalle.importe', 'compras_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $compras_detalle = new \App\admin\Compras_detalle;

        $config = array();

        $config['titulo'] = "compras_detalle";

        $config['cancelar'] = url('/admin/compras_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de compras_detalle",
            'href' => url('/admin/compras_detalle'),
            'active' => false
        );

        $data = $compras_detalle->getCompras_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/compras_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $compras_detalle = new \App\admin\Compras_detalle;

      $config = array();

      $config['titulo'] = "compras_detalle";

      $config['cancelar'] = url('/admin/compras_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de compras_detalle",
          'href' => url('/admin/compras_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar compras_detalle",
          'href' => url('/admin/compras_detalle/add'),
          'active' => true
      );

      $data = new $compras_detalle;

    	return view('admin/compras_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $compras_detalle = new \App\admin\Compras_detalle;
        $compras_detalle->addCompras_detalle($request);
        $request->session()->flash('message', 'compras_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Compras_detalleController@index');
    }

    public function getEdit($id=''){

        $compras_detalle = new \App\admin\Compras_detalle;

        $users = $compras_detalle->getAll('compras_detalle');

        $data = $compras_detalle->getCompras_detalle($id);

        $config = array();

        $config['titulo'] = "compras_detalle";

        $config['cancelar'] = url('/admin/compras_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de compras_detalle",
            'href' => url('/admin/compras_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar compras_detalle",
            'href' => url('/admin/compras_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/compras_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/compras_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $compras_detalle = new \App\admin\Compras_detalle;
        if($compras_detalle->updateCompras_detalle($request)){
            $request->session()->flash('message', 'compras_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Compras_detalleController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Compras_detalleController@index');
        }
    }

    public function view($id){

      $compras_detalle = new \App\admin\Compras_detalle;

      $data = $compras_detalle->getCompras_detalleView($id);

      $config = array();

      $config['titulo'] = "compras_detalle";

      $config['cancelar'] = url('/admin/compras_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de compras_detalle",
          'href' => url('/admin/compras_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de compras_detalle",
          'href' => url('/admin/compras_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/compras_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/compras_detalle/view');

      }

    }

    public function baja($id){

        $compras_detalle = new \App\admin\Compras_detalle;
        $flag = $compras_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$compras_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Compras_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Compras_detalleController@index');
        }
    }

    public function alta($id){
        $compras_detalle = new \App\admin\Compras_detalle;
        $flag = $compras_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$compras_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Compras_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Compras_detalleController@index');
        }
    }

    public function getAjax($id){

      $compras_detalle = new \App\admin\Compras_detalle;

      $data = $compras_detalle->getCompras_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $compras_detalle = new \App\admin\Compras_detalle;

      $data = $compras_detalle->getCompras_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$compras_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
