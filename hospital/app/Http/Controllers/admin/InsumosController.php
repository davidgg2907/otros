<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Insumos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class InsumosController extends Controller
{
    public $v_fields=array('insumos.nombre', 'insumos.descripcion', 'insumos.caducidad', 'insumos.costo', 'insumos.precio', 'insumos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $insumos = new \App\admin\Insumos;

        $config = array();

        $config['titulo'] = "Catalogo de Insumos";

        $config['cancelar'] = url('/admin/insumos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de insumos",
            'href' => url('/admin/insumos'),
            'active' => false
        );

        $data = $insumos->getInsumosData($per_page, $request, $sortBy, $order);

        return view('admin/insumos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $insumos = new \App\admin\Insumos;

      $config = array();

      $config['titulo'] = "Catalogo de Insumos";

      $config['cancelar'] = url('/admin/insumos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de insumos",
          'href' => url('/admin/insumos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar insumos",
          'href' => url('/admin/insumos/add'),
          'active' => true
      );

      $data = new $insumos;

    	return view('admin/insumos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
	 'costo'=> 'required' ,
	 'precio'=> 'required' ,
	 'status'=> 'required'
        ]);

        $insumos = new \App\admin\Insumos;
        $insumos->addInsumos($request);
        $request->session()->flash('message', 'insumos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\InsumosController@index');
    }

    public function getEdit($id=''){

        $insumos = new \App\admin\Insumos;

        $users = $insumos->getAll('insumos');

        $data = $insumos->getInsumos($id);

        $config = array();

        $config['titulo'] = "Catalogo de Insumos";

        $config['cancelar'] = url('/admin/insumos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de insumos",
            'href' => url('/admin/insumos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar insumos",
            'href' => url('/admin/insumos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/insumos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/insumos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
	 'costo'=> 'required' ,
	 'precio'=> 'required' ,
	 'status'=> 'required'
        ]);

        $insumos = new \App\admin\Insumos;
        if($insumos->updateInsumos($request)){
            $request->session()->flash('message', 'insumos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\InsumosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\InsumosController@index');
        }
    }

    public function view($id){

      $insumos = new \App\admin\Insumos;

      $data = $insumos->getInsumosView($id);

      $config = array();

      $config['titulo'] = "Catalogo de Insumos";

      $config['cancelar'] = url('/admin/insumos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de insumos",
          'href' => url('/admin/insumos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de insumos",
          'href' => url('/admin/insumos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/insumos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/insumos/view');

      }

    }

    public function baja($id){

        $insumos = new \App\admin\Insumos;
        $flag = $insumos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$insumos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\InsumosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\InsumosController@index');
        }
    }

    public function alta($id){
        $insumos = new \App\admin\Insumos;
        $flag = $insumos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$insumos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\InsumosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\InsumosController@index');
        }
    }

    public function getAjax($id){

      $insumos = new \App\admin\Insumos;

      $data = $insumos->getInsumosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
