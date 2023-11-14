<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos_precios;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Productos_preciosController extends Controller
{
    public $v_fields=array('productos_precios.id', 'productos_precios.producto_id', 'productos_precios.costo', 'productos_precios.venta', 'productos_precios.fecha_inicio', 'productos_precios.fecha_termino', 'productos_precios.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $productos_precios = new \App\admin\Productos_precios;

        $config = array();

        $config['titulo'] = "productos_precios";

        $config['cancelar'] = url('/admin/productos_precios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_precios",
            'href' => url('/admin/productos_precios'),
            'active' => false
        );

        $data = $productos_precios->getProductos_preciosData($per_page, $request, $sortBy, $order);

        return view('admin/productos_precios/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $productos_precios = new \App\admin\Productos_precios;

      $config = array();

      $config['titulo'] = "productos_precios";

      $config['cancelar'] = url('/admin/productos_precios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_precios",
          'href' => url('/admin/productos_precios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar productos_precios",
          'href' => url('/admin/productos_precios/add'),
          'active' => true
      );

      $data = new $productos_precios;

    	return view('admin/productos_precios/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_precios = new \App\admin\Productos_precios;
        $productos_precios->addProductos_precios($request);
        $request->session()->flash('message', 'productos_precios Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Productos_preciosController@index');
    }

    public function getEdit($id=''){

        $productos_precios = new \App\admin\Productos_precios;

        $users = $productos_precios->getAll('productos_precios');

        $data = $productos_precios->getProductos_precios($id);

        $config = array();

        $config['titulo'] = "productos_precios";

        $config['cancelar'] = url('/admin/productos_precios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos_precios",
            'href' => url('/admin/productos_precios'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar productos_precios",
            'href' => url('/admin/productos_precios/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/productos_precios/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/productos_precios/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $productos_precios = new \App\admin\Productos_precios;
        if($productos_precios->updateProductos_precios($request)){
            $request->session()->flash('message', 'productos_precios Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Productos_preciosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Productos_preciosController@index');
        }
    }

    public function view($id){

      $productos_precios = new \App\admin\Productos_precios;

      $data = $productos_precios->getProductos_preciosView($id);

      $config = array();

      $config['titulo'] = "productos_precios";

      $config['cancelar'] = url('/admin/productos_precios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos_precios",
          'href' => url('/admin/productos_precios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de productos_precios",
          'href' => url('/admin/productos_precios/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/productos_precios/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/productos_precios/view');

      }

    }

    public function baja($id){

        $productos_precios = new \App\admin\Productos_precios;
        $flag = $productos_precios->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$productos_precios deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_preciosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_preciosController@index');
        }
    }

    public function alta($id){
        $productos_precios = new \App\admin\Productos_precios;
        $flag = $productos_precios->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$productos_precios habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Productos_preciosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Productos_preciosController@index');
        }
    }

    public function getAjax($id){

      $productos_precios = new \App\admin\Productos_precios;

      $data = $productos_precios->getProductos_preciosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $productos_precios = new \App\admin\Productos_precios;

      $data = $productos_precios->getProductos_preciosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$productos_precios', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
