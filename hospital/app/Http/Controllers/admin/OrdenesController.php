<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ordenes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class OrdenesController extends Controller
{
    public $v_fields=array('ordenes.tipo', 'medicos.nombre', 'enfermeria.nombre', 'ordenes.fecha_solicitud', 'ordenes.fecha_aplicacion', 'ordenes.comentarios', 'ordenes.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ordenes = new \App\admin\Ordenes;

        $config = array();

        $config['titulo'] = "ordenes";

        $config['cancelar'] = url('/admin/ordenes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ordenes",
            'href' => url('/admin/ordenes'),
            'active' => false
        );

        $data = $ordenes->getOrdenesData($per_page, $request, $sortBy, $order);

        return view('admin/ordenes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $ordenes = new \App\admin\Ordenes;

      $config = array();

      $config['titulo'] = "ordenes";

      $config['cancelar'] = url('/admin/ordenes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ordenes",
          'href' => url('/admin/ordenes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar ordenes",
          'href' => url('/admin/ordenes/add'),
          'active' => true
      );

      $data = new $ordenes;

    	return view('admin/ordenes/add', ['config'=>$config,'data'=>$data, 'medicos'=>$ordenes->getAll('medicos'),'enfermeria'=>$ordenes->getAll('enfermeria')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'tipo'=> 'required' , 
	 'medico_id'=> 'required' , 
	 'paciente_id'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $ordenes = new \App\admin\Ordenes;
        $ordenes->addOrdenes($request);
        $request->session()->flash('message', 'ordenes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\OrdenesController@index');
    }

    public function getEdit($id=''){

        $ordenes = new \App\admin\Ordenes;

        $users = $ordenes->getAll('ordenes');

        $data = $ordenes->getOrdenes($id);

        $config = array();

        $config['titulo'] = "ordenes";

        $config['cancelar'] = url('/admin/ordenes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ordenes",
            'href' => url('/admin/ordenes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar ordenes",
            'href' => url('/admin/ordenes/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/ordenes/edit', ['data'=>$data, 'config'=>$config ,'medicos'=>$ordenes->getAll('medicos'),'enfermeria'=>$ordenes->getAll('enfermeria')]);
        } else{
          return view('admin/ordenes/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'tipo'=> 'required' , 
	 'medico_id'=> 'required' , 
	 'paciente_id'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $ordenes = new \App\admin\Ordenes;
        if($ordenes->updateOrdenes($request)){
            $request->session()->flash('message', 'ordenes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\OrdenesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\OrdenesController@index');
        }
    }

    public function view($id){

      $ordenes = new \App\admin\Ordenes;

      $data = $ordenes->getOrdenesView($id);

      $config = array();

      $config['titulo'] = "ordenes";

      $config['cancelar'] = url('/admin/ordenes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ordenes",
          'href' => url('/admin/ordenes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de ordenes",
          'href' => url('/admin/ordenes/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/ordenes/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/ordenes/view');

      }

    }

    public function baja($id){

        $ordenes = new \App\admin\Ordenes;
        $flag = $ordenes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$ordenes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\OrdenesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\OrdenesController@index');
        }
    }

    public function alta($id){
        $ordenes = new \App\admin\Ordenes;
        $flag = $ordenes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$ordenes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\OrdenesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\OrdenesController@index');
        }
    }

    public function getAjax($id){

      $ordenes = new \App\admin\Ordenes;

      $data = $ordenes->getOrdenesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
