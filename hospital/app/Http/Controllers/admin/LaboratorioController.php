<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Laboratorio;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class LaboratorioController extends Controller
{
    public $v_fields=array('laboratorio.orden_id', 'pacientes.nombre', 'medicos.nombre', 'enfermeria.nombre', 'laboratorio.fecha', 'laboratorio.nombre', 'laboratorio.diagnostico', 'laboratorio.archivo', 'laboratorio.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $laboratorio = new \App\admin\Laboratorio;

        $config = array();

        $config['titulo'] = "Control de Laboratorio";

        $config['cancelar'] = url('/admin/laboratorio');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de laboratorio",
            'href' => url('/admin/laboratorio'),
            'active' => false
        );

        $data = $laboratorio->getLaboratorioData($per_page, $request, $sortBy, $order);

        return view('admin/laboratorio/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $laboratorio = new \App\admin\Laboratorio;

      $config = array();

      $config['titulo'] = "Control de Laboratorio";

      $config['cancelar'] = url('/admin/laboratorio');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de laboratorio",
          'href' => url('/admin/laboratorio'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar laboratorio",
          'href' => url('/admin/laboratorio/add'),
          'active' => true
      );

      $data = new $laboratorio;

    	return view('admin/laboratorio/add', ['config'=>$config,'data'=>$data, 'pacientes'=>$laboratorio->getAll('pacientes'),'medicos'=>$laboratorio->getAll('medicos'),'enfermeria'=>$laboratorio->getAll('enfermeria')]);
    }

    public function postAdd(Request $request){
      
        $this->validate($request, [
          	 'paciente_id'=> 'required' ,
          	 'medico_id'=> 'required' ,
          	 'diagnostico'=> 'required' ,
        ]);
        $laboratorio = new \App\admin\Laboratorio;
        $laboratorio->addLaboratorio($request);
        $request->session()->flash('message', 'laboratorio Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\LaboratorioController@index');
    }

    public function getEdit($id=''){

        $laboratorio = new \App\admin\Laboratorio;

        $users = $laboratorio->getAll('laboratorio');

        $data = $laboratorio->getLaboratorio($id);

        $config = array();

        $config['titulo'] = "Control de Laboratorio";

        $config['cancelar'] = url('/admin/laboratorio');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de laboratorio",
            'href' => url('/admin/laboratorio'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar laboratorio",
            'href' => url('/admin/laboratorio/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/laboratorio/edit', ['data'=>$data, 'config'=>$config ,'pacientes'=>$laboratorio->getAll('pacientes'),'medicos'=>$laboratorio->getAll('medicos'),'enfermeria'=>$laboratorio->getAll('enfermeria')]);
        } else{
          return view('admin/laboratorio/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'orden_id'=> 'required' ,
          	 'paciente_id'=> 'required' ,
          	 'medico_id'=> 'required' ,
          	 'diagnostico'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $laboratorio = new \App\admin\Laboratorio;
        if($laboratorio->updateLaboratorio($request)){
            $request->session()->flash('message', 'laboratorio Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\LaboratorioController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\LaboratorioController@index');
        }
    }

    public function view($id){

      $laboratorio = new \App\admin\Laboratorio;

      $data = $laboratorio->getLaboratorioView($id);

      $config = array();

      $config['titulo'] = "Control de Laboratorio";

      $config['cancelar'] = url('/admin/laboratorio');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de laboratorio",
          'href' => url('/admin/laboratorio'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de laboratorio",
          'href' => url('/admin/laboratorio/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/laboratorio/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/laboratorio/view');

      }

    }

    public function baja($id){

        $laboratorio = new \App\admin\Laboratorio;
        $flag = $laboratorio->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$laboratorio deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\LaboratorioController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\LaboratorioController@index');
        }
    }

    public function alta($id){
        $laboratorio = new \App\admin\Laboratorio;
        $flag = $laboratorio->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$laboratorio habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\LaboratorioController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\LaboratorioController@index');
        }
    }

    public function getAjax($id){

      $laboratorio = new \App\admin\Laboratorio;

      $data = $laboratorio->getLaboratorioView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
