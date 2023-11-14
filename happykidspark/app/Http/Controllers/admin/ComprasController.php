<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Compras;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ComprasController extends Controller
{
    public $v_fields=array('compras.user_id', 'compras.proveedor_id', 'compras.fecha_compra', 'compras.subtotal', 'compras.impuestos', 'compras.total', 'compras.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $compras = new \App\admin\Compras;

        $config = array();

        $config['titulo'] = "compras";

        $config['cancelar'] = url('/admin/compras');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de compras",
            'href' => url('/admin/compras'),
            'active' => false
        );

        $data = $compras->getComprasData($per_page, $request, $sortBy, $order);

        return view('admin/compras/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $compras = new \App\admin\Compras;

      $config = array();

      $config['titulo'] = "compras";

      $config['cancelar'] = url('/admin/compras');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de compras",
          'href' => url('/admin/compras'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar compras",
          'href' => url('/admin/compras/add'),
          'active' => true
      );

      $data = new $compras;

    	return view('admin/compras/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $compras = new \App\admin\Compras;
        $compras->addCompras($request);
        $request->session()->flash('message', 'compras Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ComprasController@index');
    }

    public function getEdit($id=''){

        $compras = new \App\admin\Compras;

        $users = $compras->getAll('compras');

        $data = $compras->getCompras($id);

        $config = array();

        $config['titulo'] = "compras";

        $config['cancelar'] = url('/admin/compras');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de compras",
            'href' => url('/admin/compras'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar compras",
            'href' => url('/admin/compras/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/compras/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/compras/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $compras = new \App\admin\Compras;
        if($compras->updateCompras($request)){
            $request->session()->flash('message', 'compras Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ComprasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ComprasController@index');
        }
    }

    public function view($id){

      $compras = new \App\admin\Compras;

      $data = $compras->getComprasView($id);

      $config = array();

      $config['titulo'] = "compras";

      $config['cancelar'] = url('/admin/compras');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de compras",
          'href' => url('/admin/compras'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de compras",
          'href' => url('/admin/compras/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/compras/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/compras/view');

      }

    }

    public function baja($id){

        $compras = new \App\admin\Compras;
        $flag = $compras->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$compras deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ComprasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ComprasController@index');
        }
    }

    public function alta($id){
        $compras = new \App\admin\Compras;
        $flag = $compras->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$compras habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ComprasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ComprasController@index');
        }
    }

    public function getAjax($id){

      $compras = new \App\admin\Compras;

      $data = $compras->getComprasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $compras = new \App\admin\Compras;

      $data = $compras->getComprasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$compras', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
