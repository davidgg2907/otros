<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Signos_vitales;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Signos_vitalesController extends Controller
{
    public $v_fields=array('pacientes.nombre', 'medicos.nombre', 'enfermeria.nombre', 'signos_vitales.cita_id', 'signos_vitales.hospitalizacion_id', 'signos_vitales.fecha', 'signos_vitales.presion', 'signos_vitales.temperatura', 'signos_vitales.pulsaciones', 'signos_vitales.altura', 'signos_vitales.peso', 'signos_vitales.comentarios', 'signos_vitales.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $signos_vitales = new \App\admin\Signos_vitales;

        $config = array();

        $config['titulo'] = "signos_vitales";

        $config['cancelar'] = url('/admin/signos_vitales');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de signos_vitales",
            'href' => url('/admin/signos_vitales'),
            'active' => false
        );

        $data = $signos_vitales->getSignos_vitalesData($per_page, $request, $sortBy, $order);

        return view('admin/signos_vitales/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $signos_vitales = new \App\admin\Signos_vitales;

      $config = array();

      $config['titulo'] = "signos_vitales";

      $config['cancelar'] = url('/admin/signos_vitales');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de signos_vitales",
          'href' => url('/admin/signos_vitales'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar signos_vitales",
          'href' => url('/admin/signos_vitales/add'),
          'active' => true
      );

      $data = new $signos_vitales;

    	return view('admin/signos_vitales/add', ['config'=>$config,'data'=>$data, 'pacientes'=>$signos_vitales->getAll('pacientes'),'medicos'=>$signos_vitales->getAll('medicos'),'enfermeria'=>$signos_vitales->getAll('enfermeria')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' , 
	 'medico_id'=> 'required' , 
	 'enfermera_id'=> 'required' , 
	 'fecha'=> 'required' 
        ]);

        $signos_vitales = new \App\admin\Signos_vitales;
        $signos_vitales->addSignos_vitales($request);
        $request->session()->flash('message', 'signos_vitales Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Signos_vitalesController@index');
    }

    public function getEdit($id=''){

        $signos_vitales = new \App\admin\Signos_vitales;

        $users = $signos_vitales->getAll('signos_vitales');

        $data = $signos_vitales->getSignos_vitales($id);

        $config = array();

        $config['titulo'] = "signos_vitales";

        $config['cancelar'] = url('/admin/signos_vitales');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de signos_vitales",
            'href' => url('/admin/signos_vitales'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar signos_vitales",
            'href' => url('/admin/signos_vitales/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/signos_vitales/edit', ['data'=>$data, 'config'=>$config ,'pacientes'=>$signos_vitales->getAll('pacientes'),'medicos'=>$signos_vitales->getAll('medicos'),'enfermeria'=>$signos_vitales->getAll('enfermeria')]);
        } else{
          return view('admin/signos_vitales/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' , 
	 'medico_id'=> 'required' , 
	 'enfermera_id'=> 'required' , 
	 'fecha'=> 'required' 
        ]);

        $signos_vitales = new \App\admin\Signos_vitales;
        if($signos_vitales->updateSignos_vitales($request)){
            $request->session()->flash('message', 'signos_vitales Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Signos_vitalesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Signos_vitalesController@index');
        }
    }

    public function view($id){

      $signos_vitales = new \App\admin\Signos_vitales;

      $data = $signos_vitales->getSignos_vitalesView($id);

      $config = array();

      $config['titulo'] = "signos_vitales";

      $config['cancelar'] = url('/admin/signos_vitales');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de signos_vitales",
          'href' => url('/admin/signos_vitales'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de signos_vitales",
          'href' => url('/admin/signos_vitales/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/signos_vitales/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/signos_vitales/view');

      }

    }

    public function baja($id){

        $signos_vitales = new \App\admin\Signos_vitales;
        $flag = $signos_vitales->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$signos_vitales deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Signos_vitalesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Signos_vitalesController@index');
        }
    }

    public function alta($id){
        $signos_vitales = new \App\admin\Signos_vitales;
        $flag = $signos_vitales->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$signos_vitales habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Signos_vitalesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Signos_vitalesController@index');
        }
    }

    public function getAjax($id){

      $signos_vitales = new \App\admin\Signos_vitales;

      $data = $signos_vitales->getSignos_vitalesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
