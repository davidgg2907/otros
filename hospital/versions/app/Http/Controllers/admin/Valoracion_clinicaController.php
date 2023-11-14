<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Valoracion_clinica;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class Valoracion_clinicaController extends Controller
{
    public $v_fields=array('pacientes.nombre', 'medicos.nombre', 'valoracion_clinica.cita_id', 'valoracion_clinica.fecha', 'valoracion_clinica.valoracion', 'valoracion_clinica.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $valoracion_clinica = new \App\admin\Valoracion_clinica;

        $config = array();

        $config['titulo'] = "valoracion_clinica";

        $config['cancelar'] = url('/admin/valoracion_clinica');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de valoracion_clinica",
            'href' => url('/admin/valoracion_clinica'),
            'active' => false
        );

        $data = $valoracion_clinica->getValoracion_clinicaData($per_page, $request, $sortBy, $order);

        return view('admin/valoracion_clinica/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $valoracion_clinica = new \App\admin\Valoracion_clinica;

      $config = array();

      $config['titulo'] = "valoracion_clinica";

      $config['cancelar'] = url('/admin/valoracion_clinica');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de valoracion_clinica",
          'href' => url('/admin/valoracion_clinica'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar valoracion_clinica",
          'href' => url('/admin/valoracion_clinica/add'),
          'active' => true
      );

      $data = new $valoracion_clinica;

    	return view('admin/valoracion_clinica/add', ['config'=>$config,'data'=>$data, 'pacientes'=>$valoracion_clinica->getAll('pacientes'),'medicos'=>$valoracion_clinica->getAll('medicos')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' , 
	 'medico_id'=> 'required' , 
	 'cita_id'=> 'required' 
        ]);

        $valoracion_clinica = new \App\admin\Valoracion_clinica;
        $valoracion_clinica->addValoracion_clinica($request);
        $request->session()->flash('message', 'valoracion_clinica Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Valoracion_clinicaController@index');
    }

    public function getEdit($id=''){

        $valoracion_clinica = new \App\admin\Valoracion_clinica;

        $users = $valoracion_clinica->getAll('valoracion_clinica');

        $data = $valoracion_clinica->getValoracion_clinica($id);

        $config = array();

        $config['titulo'] = "valoracion_clinica";

        $config['cancelar'] = url('/admin/valoracion_clinica');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de valoracion_clinica",
            'href' => url('/admin/valoracion_clinica'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar valoracion_clinica",
            'href' => url('/admin/valoracion_clinica/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/valoracion_clinica/edit', ['data'=>$data, 'config'=>$config ,'pacientes'=>$valoracion_clinica->getAll('pacientes'),'medicos'=>$valoracion_clinica->getAll('medicos')]);
        } else{
          return view('admin/valoracion_clinica/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' , 
	 'medico_id'=> 'required' , 
	 'cita_id'=> 'required' 
        ]);

        $valoracion_clinica = new \App\admin\Valoracion_clinica;
        if($valoracion_clinica->updateValoracion_clinica($request)){
            $request->session()->flash('message', 'valoracion_clinica Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Valoracion_clinicaController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Valoracion_clinicaController@index');
        }
    }

    public function view($id){

      $valoracion_clinica = new \App\admin\Valoracion_clinica;

      $data = $valoracion_clinica->getValoracion_clinicaView($id);

      $config = array();

      $config['titulo'] = "valoracion_clinica";

      $config['cancelar'] = url('/admin/valoracion_clinica');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de valoracion_clinica",
          'href' => url('/admin/valoracion_clinica'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de valoracion_clinica",
          'href' => url('/admin/valoracion_clinica/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/valoracion_clinica/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/valoracion_clinica/view');

      }

    }

    public function baja($id){

        $valoracion_clinica = new \App\admin\Valoracion_clinica;
        $flag = $valoracion_clinica->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$valoracion_clinica deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Valoracion_clinicaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Valoracion_clinicaController@index');
        }
    }

    public function alta($id){
        $valoracion_clinica = new \App\admin\Valoracion_clinica;
        $flag = $valoracion_clinica->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$valoracion_clinica habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Valoracion_clinicaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Valoracion_clinicaController@index');
        }
    }

    public function getAjax($id){

      $valoracion_clinica = new \App\admin\Valoracion_clinica;

      $data = $valoracion_clinica->getValoracion_clinicaView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
