<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class NotasController extends Controller
{
    public $v_fields=array('notas.medico_id', 'notas.paciente_id', 'notas.tipo', 'notas.tipo_descripcion', 'notas.nota_medica', 'notas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $notas = new \App\admin\Notas;

        $config = array();

        $config['titulo'] = "notas";

        $config['cancelar'] = url('/admin/notas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de notas",
            'href' => url('/admin/notas'),
            'active' => false
        );

        $data = $notas->getNotasData($per_page, $request, $sortBy, $order);

        return view('admin/notas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $notas = new \App\admin\Notas;

      $config = array();

      $config['titulo'] = "notas";

      $config['cancelar'] = url('/admin/notas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de notas",
          'href' => url('/admin/notas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar notas",
          'href' => url('/admin/notas/add'),
          'active' => true
      );

      $data = new $notas;

    	return view('admin/notas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $notas = new \App\admin\Notas;
        $notas->addNotas($request);
        $request->session()->flash('message', 'notas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect($request->input('redirect'));
    }

    public function getEdit($id=''){

        $notas = new \App\admin\Notas;

        $users = $notas->getAll('notas');

        $data = $notas->getNotas($id);

        $config = array();

        $config['titulo'] = "notas";

        $config['cancelar'] = url('/admin/notas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de notas",
            'href' => url('/admin/notas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar notas",
            'href' => url('/admin/notas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/notas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/notas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $notas = new \App\admin\Notas;
        if($notas->updateNotas($request)){
            $request->session()->flash('message', 'notas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\NotasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\NotasController@index');
        }
    }

    public function view($id){

      $notas = new \App\admin\Notas;

      $data = $notas->getNotasView($id);

      $config = array();

      $config['titulo'] = "notas";

      $config['cancelar'] = url('/admin/notas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de notas",
          'href' => url('/admin/notas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de notas",
          'href' => url('/admin/notas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/notas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/notas/view');

      }

    }

    public function baja($id){

        $notas = new \App\admin\Notas;
        $flag = $notas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$notas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\NotasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\NotasController@index');
        }
    }

    public function alta($id){
        $notas = new \App\admin\Notas;
        $flag = $notas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$notas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\NotasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\NotasController@index');
        }
    }

    public function getAjax($id){

      $notas = new \App\admin\Notas;

      $data = $notas->getNotasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
