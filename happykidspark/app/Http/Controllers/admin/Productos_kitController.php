<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos_kit;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Productos_kitController extends Controller
{
    public $v_fields=array('productos_kit.id', 'productos_kit.producto_id', 'productos_kit.prod_adjunto_id', 'productos_kit.cantidad', 'productos_kit.precio_unit', 'productos_kit.precio_paquete', 'productos_kit.importe', 'productos_kit.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $productos_kit = new \App\admin\Productos_kit;

        $config = array();

        $config['titulo'] = "productos_kit";

        $config['cancelar'] = url('/admin/productos_kit');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_kit",
            'href' => url('/admin/productos_kit'),
            'active' => false
        );

        $data = $productos_kit->getProductos_kitData($per_page, $request, $sortBy, $order);

        return view('admin/productos_kit/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $productos_kit = new \App\admin\Productos_kit;

      $config = array();

      $config['titulo'] = "productos_kit";

      $config['cancelar'] = url('/admin/productos_kit');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_kit",
          'href' => url('/admin/productos_kit'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar productos_kit",
          'href' => url('/admin/productos_kit/add'),
          'active' => true
      );

      $data = new $productos_kit;

    	return view('admin/productos_kit/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_kit = new \App\admin\Productos_kit;
        $productos_kit->addProductos_kit($request);
        $request->session()->flash('message', 'productos_kit Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Productos_kitController@index');
    }

    public function getEdit($id=''){

        $productos_kit = new \App\admin\Productos_kit;

        $users = $productos_kit->getAll('productos_kit');

        $data = $productos_kit->getProductos_kit($id);

        $config = array();

        $config['titulo'] = "productos_kit";

        $config['cancelar'] = url('/admin/productos_kit');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_kit",
            'href' => url('/admin/productos_kit'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar productos_kit",
            'href' => url('/admin/productos_kit/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/productos_kit/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/productos_kit/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_kit = new \App\admin\Productos_kit;
        if($productos_kit->updateProductos_kit($request)){
            $request->session()->flash('message', 'productos_kit Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Productos_kitController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Productos_kitController@index');
        }
    }

    public function view($id){

      $productos_kit = new \App\admin\Productos_kit;

      $data = $productos_kit->getProductos_kitView($id);

      $config = array();

      $config['titulo'] = "productos_kit";

      $config['cancelar'] = url('/admin/productos_kit');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_kit",
          'href' => url('/admin/productos_kit'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de productos_kit",
          'href' => url('/admin/productos_kit/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/productos_kit/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/productos_kit/view');

      }

    }

    public function baja($id){

        $productos_kit = new \App\admin\Productos_kit;
        $flag = $productos_kit->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$productos_kit deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_kitController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_kitController@index');
        }
    }

    public function alta($id){
        $productos_kit = new \App\admin\Productos_kit;
        $flag = $productos_kit->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$productos_kit habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_kitController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_kitController@index');
        }
    }

    public function getAjax($id){

      $productos_kit = new \App\admin\Productos_kit;

      $data = $productos_kit->getProductos_kitView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $productos_kit = new \App\admin\Productos_kit;

      $data = $productos_kit->getProductos_kitExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$productos_kit', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
