<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorias;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class CategoriasController extends Controller
{
    public $v_fields=array('categorias.nombre', 'categorias.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $categorias = new \App\admin\Categorias;

        $config = array();

        $config['titulo'] = "categorias";

        $config['cancelar'] = url('/admin/categorias');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de categorias",
            'href' => url('/admin/categorias'),
            'active' => false
        );

        $data = $categorias->getCategoriasData($per_page, $request, $sortBy, $order);

        return view('admin/categorias/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $categorias = new \App\admin\Categorias;

      $config = array();

      $config['titulo'] = "categorias";

      $config['cancelar'] = url('/admin/categorias');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de categorias",
          'href' => url('/admin/categorias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar categorias",
          'href' => url('/admin/categorias/add'),
          'active' => true
      );

      $data = new $categorias;

    	return view('admin/categorias/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $categorias = new \App\admin\Categorias;
        $categorias->addCategorias($request);
        $request->session()->flash('message', 'categorias Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\CategoriasController@index');
    }

    public function getEdit($id=''){

        $categorias = new \App\admin\Categorias;

        $users = $categorias->getAll('categorias');

        $data = $categorias->getCategorias($id);

        $config = array();

        $config['titulo'] = "categorias";

        $config['cancelar'] = url('/admin/categorias');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de categorias",
            'href' => url('/admin/categorias'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar categorias",
            'href' => url('/admin/categorias/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/categorias/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/categorias/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $categorias = new \App\admin\Categorias;
        if($categorias->updateCategorias($request)){
            $request->session()->flash('message', 'categorias Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\CategoriasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\CategoriasController@index');
        }
    }

    public function view($id){

      $categorias = new \App\admin\Categorias;

      $data = $categorias->getCategoriasView($id);

      $config = array();

      $config['titulo'] = "categorias";

      $config['cancelar'] = url('/admin/categorias');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de categorias",
          'href' => url('/admin/categorias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de categorias",
          'href' => url('/admin/categorias/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/categorias/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/categorias/view');

      }

    }

    public function baja($id){

        $categorias = new \App\admin\Categorias;
        $flag = $categorias->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$categorias deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CategoriasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CategoriasController@index');
        }
    }

    public function alta($id){
        $categorias = new \App\admin\Categorias;
        $flag = $categorias->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$categorias habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CategoriasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CategoriasController@index');
        }
    }

    public function getAjax($id){

      $categorias = new \App\admin\Categorias;

      $data = $categorias->getCategoriasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $categorias = new \App\admin\Categorias;

      $data = $categorias->getCategoriasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$categorias', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
