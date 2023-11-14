<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inventario;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class InventarioController extends Controller
{
    public $v_fields=array('inventario.producto_id', 'inventario.cantidad', 'inventario.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $inventario = new \App\admin\Inventario;

        $config = array();

        $config['titulo'] = "inventario";

        $config['cancelar'] = url('/admin/inventario');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de inventario",
            'href' => url('/admin/inventario'),
            'active' => false
        );

        $data = $inventario->getInventarioData($per_page, $request, $sortBy, $order);

        return view('admin/inventario/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $inventario = new \App\admin\Inventario;

      $config = array();

      $config['titulo'] = "inventario";

      $config['cancelar'] = url('/admin/inventario');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de inventario",
          'href' => url('/admin/inventario'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar inventario",
          'href' => url('/admin/inventario/add'),
          'active' => true
      );

      $data = new $inventario;

    	return view('admin/inventario/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $inventario = new \App\admin\Inventario;
        $inventario->addInventario($request);
        $request->session()->flash('message', 'inventario Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\InventarioController@index');
    }

    public function getEdit($id=''){

        $inventario = new \App\admin\Inventario;

        $users = $inventario->getAll('inventario');

        $data = $inventario->getInventario($id);

        $config = array();

        $config['titulo'] = "inventario";

        $config['cancelar'] = url('/admin/inventario');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de inventario",
            'href' => url('/admin/inventario'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar inventario",
            'href' => url('/admin/inventario/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/inventario/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/inventario/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $inventario = new \App\admin\Inventario;
        if($inventario->updateInventario($request)){
            $request->session()->flash('message', 'inventario Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\InventarioController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\InventarioController@index');
        }
    }

    public function view($id){

      $producto = \App\admin\Productos::find($id);

      $data = \App\admin\InvLog::where('producto_id',$id)->get();

      $config = array();

      $config['titulo'] = "Movimientos de Producto";

      $config['cancelar'] = url('/admin/inventario');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Almacen",
          'href' => url('/admin/inventario'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Movimientos de Producto",
          'href' => url('/admin/inventario/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/inventario/view', ['data'=>$data, 'producto'=>$producto, 'config'=>$config]);

      } else{

        return view('admin/inventario/view');

      }

    }

    public function baja($id){

        $inventario = new \App\admin\Inventario;
        $flag = $inventario->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$inventario deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\InventarioController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\InventarioController@index');
        }
    }

    public function alta($id){
        $inventario = new \App\admin\Inventario;
        $flag = $inventario->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$inventario habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\InventarioController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\InventarioController@index');
        }
    }

    public function getAjax($id){

      $inventario = new \App\admin\Inventario;

      $data = $inventario->getInventarioView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $inventario = new \App\admin\Inventario;

      $data = $inventario->getInventarioExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$inventario', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
