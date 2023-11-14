<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recetas_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Recetas_detalleController extends Controller
{
    public $v_fields=array('medicamentos.comercial', 'recetas_detalle.medicamento_id', 'recetas_detalle.dosificacion', 'recetas_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $recetas_detalle = new \App\admin\Recetas_detalle;

        $config = array();

        $config['titulo'] = "recetas_detalle";

        $config['cancelar'] = url('/admin/recetas_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de recetas_detalle",
            'href' => url('/admin/recetas_detalle'),
            'active' => false
        );

        $data = $recetas_detalle->getRecetas_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/recetas_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $recetas_detalle = new \App\admin\Recetas_detalle;

      $config = array();

      $config['titulo'] = "recetas_detalle";

      $config['cancelar'] = url('/admin/recetas_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de recetas_detalle",
          'href' => url('/admin/recetas_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar recetas_detalle",
          'href' => url('/admin/recetas_detalle/add'),
          'active' => true
      );

      $data = new $recetas_detalle;

    	return view('admin/recetas_detalle/add', ['config'=>$config,'data'=>$data, 'medicamentos'=>$recetas_detalle->getAll('medicamentos')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'receta_id'=> 'required' , 
	 'medicamento_id'=> 'required' , 
	 'dosificacion'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $recetas_detalle = new \App\admin\Recetas_detalle;
        $recetas_detalle->addRecetas_detalle($request);
        $request->session()->flash('message', 'recetas_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Recetas_detalleController@index');
    }

    public function getEdit($id=''){

        $recetas_detalle = new \App\admin\Recetas_detalle;

        $users = $recetas_detalle->getAll('recetas_detalle');

        $data = $recetas_detalle->getRecetas_detalle($id);

        $config = array();

        $config['titulo'] = "recetas_detalle";

        $config['cancelar'] = url('/admin/recetas_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de recetas_detalle",
            'href' => url('/admin/recetas_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar recetas_detalle",
            'href' => url('/admin/recetas_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/recetas_detalle/edit', ['data'=>$data, 'config'=>$config ,'medicamentos'=>$recetas_detalle->getAll('medicamentos')]);
        } else{
          return view('admin/recetas_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'receta_id'=> 'required' , 
	 'medicamento_id'=> 'required' , 
	 'dosificacion'=> 'required' , 
	 'status'=> 'required' 
        ]);

        $recetas_detalle = new \App\admin\Recetas_detalle;
        if($recetas_detalle->updateRecetas_detalle($request)){
            $request->session()->flash('message', 'recetas_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Recetas_detalleController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Recetas_detalleController@index');
        }
    }

    public function view($id){

      $recetas_detalle = new \App\admin\Recetas_detalle;

      $data = $recetas_detalle->getRecetas_detalleView($id);

      $config = array();

      $config['titulo'] = "recetas_detalle";

      $config['cancelar'] = url('/admin/recetas_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de recetas_detalle",
          'href' => url('/admin/recetas_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de recetas_detalle",
          'href' => url('/admin/recetas_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/recetas_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/recetas_detalle/view');

      }

    }

    public function baja($id){

        $recetas_detalle = new \App\admin\Recetas_detalle;
        $flag = $recetas_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$recetas_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Recetas_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Recetas_detalleController@index');
        }
    }

    public function alta($id){
        $recetas_detalle = new \App\admin\Recetas_detalle;
        $flag = $recetas_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$recetas_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Recetas_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Recetas_detalleController@index');
        }
    }

    public function getAjax($id){

      $recetas_detalle = new \App\admin\Recetas_detalle;

      $data = $recetas_detalle->getRecetas_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
