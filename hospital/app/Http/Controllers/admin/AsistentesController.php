<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asistentes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class AsistentesController extends Controller
{
    public $v_fields=array('asistentes.nombre', 'asistentes.celular', 'asistentes.rfc', 'asistentes.curp', 'asistentes.honorarios', 'asistentes.domicilio', 'asistentes.fotografia', 'asistentes.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $asistentes = new \App\admin\Asistentes;

        $config = array();

        $config['titulo'] = "Asistentes Medicos";

        $config['cancelar'] = url('/admin/asistentes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de asistentes",
            'href' => url('/admin/asistentes'),
            'active' => false
        );

        $data = $asistentes->getAsistentesData($per_page, $request, $sortBy, $order);

        return view('admin/asistentes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $asistentes = new \App\admin\Asistentes;

      $usuarios = new \App\admin\Users;

      $config = array();

      $config['titulo'] = "Asistentes Medicos";

      $config['cancelar'] = url('/admin/asistentes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de asistentes",
          'href' => url('/admin/asistentes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar asistentes",
          'href' => url('/admin/asistentes/add'),
          'active' => true
      );

      $data = new $asistentes;

      $user = new $usuarios();

    	return view('admin/asistentes/add', ['config'=>$config,'data'=>$data, 'doctores' => $asistentes->getAll('medicos'), 'roles' => $asistentes->getAll('roles'),'user' => $user]);

    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $asistentes = new \App\admin\Asistentes;
        $usuarios = new \App\admin\Users;

        $asistente_id = $asistentes->addAsistentes($request);

        $data = array(

          'rol_id'        => $request->input('rol_id'),

          'asistente_id'  => $asistente_id,

          'medico_id'     => 0,

          'enfermera_id'  => 0,

          'paciente_id'   => 0,

          'name'          => $request->input('nombre'),

          'email'         => $request->input('email'),

          'password'      =>  $request->input('password'),

        );

        $usuarios->createUser($data);

        $request->session()->flash('message', 'asistentes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\AsistentesController@index');
    }

    public function getEdit($id=''){

        $asistentes = new \App\admin\Asistentes;

        $usuarios = new \App\admin\Users;

        $users = $asistentes->getAll('asistentes');

        $data = $asistentes->getAsistentes($id);

        $config = array();

        $config['titulo'] = "Asistentes Medicos";

        $config['cancelar'] = url('/admin/asistentes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de asistentes",
            'href' => url('/admin/asistentes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar asistentes",
            'href' => url('/admin/asistentes/edit'),
            'active' => true
        );

        if(count($data)){

          $usuario = \App\admin\Users::where('asistente_id',$id)->get();

          if(count($usuario)) {
            $user = $usuario[0];
          } else {
            $user = new $usuarios;
          }


          return view('admin/asistentes/edit', ['data'=>$data, 'config'=>$config, 'doctores' => $asistentes->getAll('medicos'), 'roles' => $asistentes->getAll('roles'),'user' => $user]);

        } else{
          return view('admin/asistentes/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $asistentes = new \App\admin\Asistentes;

        $usuarios = new \App\admin\Users;
        
        if($asistentes->updateAsistentes($request)){


          $data = array(

            'id'            => $request->input('user_id'),

            'rol_id'        => $request->input('rol_id'),

            'asistente_id'  => $request->input('id'),

            'medico_id'     => 0,

            'enfermera_id'  => 0,

            'paciente_id'   => 0,

            'name'          => $request->input('nombre'),

            'email'         => $request->input('email'),

            'password'      =>  $request->input('password'),

          );

          $usuarios->updateUser($data);

            $request->session()->flash('message', 'asistentes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\AsistentesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\AsistentesController@index');
        }
    }

    public function view($id){

      $asistentes = new \App\admin\Asistentes;

      $data = $asistentes->getAsistentesView($id);

      $config = array();

      $config['titulo'] = "Asistentes Medicos";

      $config['cancelar'] = url('/admin/asistentes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de asistentes",
          'href' => url('/admin/asistentes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de asistentes",
          'href' => url('/admin/asistentes/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/asistentes/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/asistentes/view');

      }

    }

    public function baja($id){

        $asistentes = new \App\admin\Asistentes;
        $flag = $asistentes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$asistentes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AsistentesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AsistentesController@index');
        }
    }

    public function alta($id){
        $asistentes = new \App\admin\Asistentes;
        $flag = $asistentes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$asistentes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AsistentesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AsistentesController@index');
        }
    }

    public function getAjax($id){

      $asistentes = new \App\admin\Asistentes;

      $data = $asistentes->getAsistentesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
