<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Consultorios;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class ConsultoriosController extends Controller
{
    public $v_fields=array('consultorios.id', 'medicos.nombre', 'enfermeria.nombre', 'consultorios.dia_laboral', 'consultorios.hora_inicio', 'consultorios.hora_fin', 'consultorios.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $consultorios = new \App\admin\Consultorios;

        $config = array();

        $config['titulo'] = "Consultorios y Horarios";

        $config['cancelar'] = url('/admin/consultorios');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de consultorios",
            'href' => url('/admin/consultorios'),
            'active' => false
        );

        $data = $consultorios->getConsultoriosData($per_page, $request, $sortBy, $order);

        return view('admin/consultorios/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $consultorios = new \App\admin\Consultorios;

      $config = array();

      $config['titulo'] = "Consultorios y Horarios";

      $config['cancelar'] = url('/admin/consultorios');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de consultorios",
          'href' => url('/admin/consultorios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar consultorios",
          'href' => url('/admin/consultorios/add'),
          'active' => true
      );

      $data = new $consultorios;

    	return view('admin/consultorios/add', ['config'=>$config,'data'=>$data, 'medicos'=>$consultorios->getAll('medicos'),'enfermeria'=>$consultorios->getAll('enfermeria')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'medico_id'=> 'required' ,
	 'enfermera_id'=> 'required' ,
	 'dia_laboral'=> 'required' ,
	 'hora_inicio'=> 'required' ,
	 'hora_fin'=> 'required' ,
	 'status'=> 'required'
        ]);

        $consultorios = new \App\admin\Consultorios;
        $consultorios->addConsultorios($request);
        $request->session()->flash('message', 'consultorios Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ConsultoriosController@index');
    }

    public function getEdit($id=''){

        $consultorios = new \App\admin\Consultorios;

        $users = $consultorios->getAll('consultorios');

        $data = $consultorios->getConsultorios($id);

        $config = array();

        $config['titulo'] = "Consultorios y Horarios";

        $config['cancelar'] = url('/admin/consultorios');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de consultorios",
            'href' => url('/admin/consultorios'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar consultorios",
            'href' => url('/admin/consultorios/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/consultorios/edit', ['data'=>$data, 'config'=>$config ,'medicos'=>$consultorios->getAll('medicos'),'enfermeria'=>$consultorios->getAll('enfermeria')]);
        } else{
          return view('admin/consultorios/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'medico_id'=> 'required' ,
	 'enfermera_id'=> 'required' ,
	 'dia_laboral'=> 'required' ,
	 'hora_inicio'=> 'required' ,
	 'hora_fin'=> 'required' ,
	 'status'=> 'required'
        ]);

        $consultorios = new \App\admin\Consultorios;
        if($consultorios->updateConsultorios($request)){
            $request->session()->flash('message', 'consultorios Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ConsultoriosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ConsultoriosController@index');
        }
    }

    public function view($id){

      $consultorios = new \App\admin\Consultorios;

      $data = $consultorios->getConsultoriosView($id);

      $config = array();

      $config['titulo'] = "Consultorios y Horarios";

      $config['cancelar'] = url('/admin/consultorios');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de consultorios",
          'href' => url('/admin/consultorios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de consultorios",
          'href' => url('/admin/consultorios/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/consultorios/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/consultorios/view');

      }

    }

    public function baja($id){

        $consultorios = new \App\admin\Consultorios;
        $flag = $consultorios->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$consultorios deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ConsultoriosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ConsultoriosController@index');
        }
    }

    public function alta($id){
        $consultorios = new \App\admin\Consultorios;
        $flag = $consultorios->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$consultorios habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ConsultoriosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ConsultoriosController@index');
        }
    }

    public function getAjax($id){

      $consultorios = new \App\admin\Consultorios;

      $data = $consultorios->getConsultoriosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
