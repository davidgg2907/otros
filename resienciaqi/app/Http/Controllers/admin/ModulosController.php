<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modulos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ModulosController extends Controller
{
    public $v_fields=array('modulos.tipo', 'modulos.padre_id', 'modulos.nombre', 'modulos.url', 'modulos.icon', 'modulos.orden', 'modulos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $modulos = new \App\admin\Modulos;

        $config = array();

        $config['titulo'] = "modulos";

        $config['cancelar'] = url('/admin/modulos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de modulos",
            'href' => url('/admin/modulos'),
            'active' => false
        );

        $data = $modulos->getModulosData($per_page, $request, $sortBy, $order);

        return view('admin/modulos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $modulos = new \App\admin\Modulos;

      $config = array();

      $config['titulo'] = "modulos";

      $config['cancelar'] = url('/admin/modulos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de modulos",
          'href' => url('/admin/modulos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar modulos",
          'href' => url('/admin/modulos/add'),
          'active' => true
      );

      $data = new $modulos;

    	return view('admin/modulos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $modulos = new \App\admin\Modulos;
        $modulos->addModulos($request);
        $request->session()->flash('message', 'modulos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ModulosController@index');
    }

    public function getEdit($id=''){

        $modulos = new \App\admin\Modulos;

        $users = $modulos->getAll('modulos');

        $data = $modulos->getModulos($id);

        $config = array();

        $config['titulo'] = "modulos";

        $config['cancelar'] = url('/admin/modulos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de modulos",
            'href' => url('/admin/modulos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar modulos",
            'href' => url('/admin/modulos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/modulos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/modulos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $modulos = new \App\admin\Modulos;
        if($modulos->updateModulos($request)){
            $request->session()->flash('message', 'modulos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\ModulosController@index');
    }

    public function view($id){

      $modulos = new \App\admin\Modulos;

      $data = $modulos->getModulosView($id);

      $config = array();

      $config['titulo'] = "modulos";

      $config['cancelar'] = url('/admin/modulos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de modulos",
          'href' => url('/admin/modulos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de modulos",
          'href' => url('/admin/modulos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/modulos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/modulos/view');

      }

    }

    public function baja($id){

        $modulos = new \App\admin\Modulos;
        $flag = $modulos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$modulos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ModulosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ModulosController@index');
        }
    }

    public function alta($id){
        $modulos = new \App\admin\Modulos;
        $flag = $modulos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$modulos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ModulosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ModulosController@index');
        }
    }

    public function getAjax($id){

      $modulos = new \App\admin\Modulos;

      $data = $modulos->getModulosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $modulos = new \App\admin\Modulos;

      $data = $modulos->getModulosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$modulos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
