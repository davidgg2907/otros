<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proveedores;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ProveedoresController extends Controller
{
    public $v_fields=array('proveedores.nombre', 'proveedores.direccion', 'proveedores.celular', 'proveedores.correo', 'proveedores.vendedor', 'proveedores.vededor_celular', 'proveedores.vendedor_correo', 'proveedores.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $proveedores = new \App\admin\Proveedores;

        $config = array();

        $config['titulo'] = "proveedores";

        $config['cancelar'] = url('/admin/proveedores');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de proveedores",
            'href' => url('/admin/proveedores'),
            'active' => false
        );

        $data = $proveedores->getProveedoresData($per_page, $request, $sortBy, $order);

        return view('admin/proveedores/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $proveedores = new \App\admin\Proveedores;

      $config = array();

      $config['titulo'] = "proveedores";

      $config['cancelar'] = url('/admin/proveedores');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de proveedores",
          'href' => url('/admin/proveedores'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar proveedores",
          'href' => url('/admin/proveedores/add'),
          'active' => true
      );

      $data = new $proveedores;

    	return view('admin/proveedores/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $proveedores = new \App\admin\Proveedores;
        $proveedores->addProveedores($request);
        $request->session()->flash('message', 'proveedores Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ProveedoresController@index');
    }

    public function getEdit($id=''){

        $proveedores = new \App\admin\Proveedores;

        $users = $proveedores->getAll('proveedores');

        $data = $proveedores->getProveedores($id);

        $config = array();

        $config['titulo'] = "proveedores";

        $config['cancelar'] = url('/admin/proveedores');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de proveedores",
            'href' => url('/admin/proveedores'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar proveedores",
            'href' => url('/admin/proveedores/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/proveedores/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/proveedores/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $proveedores = new \App\admin\Proveedores;
        if($proveedores->updateProveedores($request)){
            $request->session()->flash('message', 'proveedores Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ProveedoresController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ProveedoresController@index');
        }
    }

    public function view($id){

      $proveedores = new \App\admin\Proveedores;

      $data = $proveedores->getProveedoresView($id);

      $config = array();

      $config['titulo'] = "proveedores";

      $config['cancelar'] = url('/admin/proveedores');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de proveedores",
          'href' => url('/admin/proveedores'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de proveedores",
          'href' => url('/admin/proveedores/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/proveedores/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/proveedores/view');

      }

    }

    public function baja($id){

        $proveedores = new \App\admin\Proveedores;
        $flag = $proveedores->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$proveedores deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProveedoresController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProveedoresController@index');
        }
    }

    public function alta($id){
        $proveedores = new \App\admin\Proveedores;
        $flag = $proveedores->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$proveedores habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProveedoresController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProveedoresController@index');
        }
    }

    public function getAjax($id){

      $proveedores = new \App\admin\Proveedores;

      $data = $proveedores->getProveedoresView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $proveedores = new \App\admin\Proveedores;

      $data = $proveedores->getProveedoresExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$proveedores', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
