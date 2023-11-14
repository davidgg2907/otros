<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cuartos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class CuartosController extends Controller
{
    public $v_fields=array('cuartos.numero', 'cuartos.descripcion', 'cuartos.amenidades', 'cuartos.equipo', 'cuartos.costo_dia', 'cuartos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $cuartos = new \App\admin\Cuartos;

        $config = array();

        $config['titulo'] = "Administracion de Habitaciones";

        $config['cancelar'] = url('/admin/cuartos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de cuartos",
            'href' => url('/admin/cuartos'),
            'active' => false
        );

        $data = $cuartos->getCuartosData($per_page, $request, $sortBy, $order);

        return view('admin/cuartos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $cuartos = new \App\admin\Cuartos;

      $config = array();

      $config['titulo'] = "Administracion de Habitaciones";

      $config['cancelar'] = url('/admin/cuartos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de cuartos",
          'href' => url('/admin/cuartos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar cuartos",
          'href' => url('/admin/cuartos/add'),
          'active' => true
      );

      $data = new $cuartos;

    	return view('admin/cuartos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'numero'=> 'required' ,
	 'descripcion'=> 'required' ,
	 'equipo'=> 'required' ,
	 'costo_dia'=> 'required' ,
	 'status'=> 'required'
        ]);

        $cuartos = new \App\admin\Cuartos;
        $cuartos->addCuartos($request);
        $request->session()->flash('message', 'cuartos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\CuartosController@index');
    }

    public function getEdit($id=''){

        $cuartos = new \App\admin\Cuartos;

        $users = $cuartos->getAll('cuartos');

        $data = $cuartos->getCuartos($id);

        $config = array();

        $config['titulo'] = "Administracion de Habitaciones";

        $config['cancelar'] = url('/admin/cuartos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de cuartos",
            'href' => url('/admin/cuartos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar cuartos",
            'href' => url('/admin/cuartos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/cuartos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/cuartos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'numero'=> 'required' ,
	 'descripcion'=> 'required' ,
	 'equipo'=> 'required' ,
	 'costo_dia'=> 'required' ,
	 'status'=> 'required'
        ]);

        $cuartos = new \App\admin\Cuartos;
        if($cuartos->updateCuartos($request)){
            $request->session()->flash('message', 'cuartos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\CuartosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\CuartosController@index');
        }
    }

    public function view($id){

      $cuartos = new \App\admin\Cuartos;

      $data = $cuartos->getCuartosView($id);

      $config = array();

      $config['titulo'] = "Administracion de Habitaciones";

      $config['cancelar'] = url('/admin/cuartos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de cuartos",
          'href' => url('/admin/cuartos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de cuartos",
          'href' => url('/admin/cuartos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/cuartos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/cuartos/view');

      }

    }

    public function baja($id){

        $cuartos = new \App\admin\Cuartos;
        $flag = $cuartos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$cuartos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CuartosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CuartosController@index');
        }
    }

    public function alta($id){
        $cuartos = new \App\admin\Cuartos;
        $flag = $cuartos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$cuartos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CuartosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CuartosController@index');
        }
    }

    public function getAjax($id){

      $cuartos = new \App\admin\Cuartos;

      $data = $cuartos->getCuartosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
