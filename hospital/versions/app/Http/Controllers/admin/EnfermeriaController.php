<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enfermeria;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class EnfermeriaController extends Controller
{
    public $v_fields=array('enfermeria.nombre', 'enfermeria.celular', 'enfermeria.rfc', 'enfermeria.cedula', 'enfermeria.curp', 'enfermeria.honorarios', 'enfermeria.domicilio', 'enfermeria.fotografia', 'enfermeria.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $enfermeria = new \App\admin\Enfermeria;

        $config = array();

        $config['titulo'] = "Adminsitracion de Enfermeria";

        $config['cancelar'] = url('/admin/enfermeria');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de enfermeria",
            'href' => url('/admin/enfermeria'),
            'active' => false
        );

        $data = $enfermeria->getEnfermeriaData($per_page, $request, $sortBy, $order);

        return view('admin/enfermeria/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $enfermeria = new \App\admin\Enfermeria;
      $users      = new \App\admin\Users;

      $config = array();

      $config['titulo'] = "Adminsitracion de Enfermeria";

      $config['cancelar'] = url('/admin/enfermeria');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de enfermeria",
          'href' => url('/admin/enfermeria'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar enfermeria",
          'href' => url('/admin/enfermeria/add'),
          'active' => true
      );

      $data = new $enfermeria;

      $user = new $users;

    	return view('admin/enfermeria/add', ['config'=>$config,'data'=>$data, 'user' => $user, 'roles' => $enfermeria->getAll('roles')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'cedula'=> 'required',
             'password' => 'required|min:6|confirmed',
             'rol_id' => 'required',
        ]);

        $enfermeria = new \App\admin\Enfermeria;
        $usuarios = new \App\admin\Users;

        $enfermeria_id = $enfermeria->addEnfermeria($request);

        $data = array(

          'rol_id'        => $request->input('rol_id'),

          'asistente_id'  => 0,

          'medico_id'     => 0,

          'enfermera_id'  => $enfermeria_id,

          'paciente_id'   => 0,

          'name'          => $request->input('nombre'),

          'email'         => $request->input('email'),

          'password'      =>  $request->input('password'),

        );

        $usuarios->createUser($data);

        $request->session()->flash('message', 'enfermeria Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\EnfermeriaController@index');
    }

    public function getEdit($id=''){

        $enfermeria = new \App\admin\Enfermeria;
        $users      = new \App\admin\Users;

        $data = $enfermeria->getEnfermeria($id);

        $config = array();

        $config['titulo'] = "Adminsitracion de Enfermeria";

        $config['cancelar'] = url('/admin/enfermeria');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de enfermeria",
            'href' => url('/admin/enfermeria'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar enfermeria",
            'href' => url('/admin/enfermeria/edit'),
            'active' => true
        );

        if(count($data)){

          $usuario = \App\admin\Users::where('enfermera_id',$id)->get();

          if(count($usuario)) {
            $user = $usuario[0];
          } else {
            $user = new $users;
          }

          return view('admin/enfermeria/edit', ['data'=>$data, 'config'=>$config, 'user' => $user, 'roles' => $enfermeria->getAll('roles')]);
        } else{
          return view('admin/enfermeria/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'cedula'=> 'required'
        ]);

        $enfermeria = new \App\admin\Enfermeria;
        $usuarios      = new \App\admin\Users;

        if($enfermeria->updateEnfermeria($request)){

          $data = array(

            'id'            => $request->input('user_id'),

            'rol_id'        => $request->input('rol_id'),

            'asistente_id'  => 0,
            
            'medico_id'     => 0,

            'enfermera_id'  => $request->input('id'),

            'paciente_id'   => 0,

            'name'          => $request->input('nombre'),

            'email'         => $request->input('email'),

            'password'      =>  $request->input('password'),

          );

          $usuarios->updateUser($data);

            $request->session()->flash('message', 'enfermeria Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\EnfermeriaController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\EnfermeriaController@index');
        }
    }

    public function view($id){

      $enfermeria = new \App\admin\Enfermeria;

      $data = $enfermeria->getEnfermeriaView($id);

      $config = array();

      $config['titulo'] = "Adminsitracion de Enfermeria";

      $config['cancelar'] = url('/admin/enfermeria');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de enfermeria",
          'href' => url('/admin/enfermeria'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de enfermeria",
          'href' => url('/admin/enfermeria/view'),
          'active' => true
      );

      if(count($data)){

        $consultorios = $enfermeria->misConsultorios($id);

        $citas =  $enfermeria->misCitas($id);

        return view('admin/enfermeria/view', ['data'=>$data,

                                              'config'=>$config,

                                              'consultorios' => $consultorios,

                                              'citas' => $citas
                                             ]);

      } else{

        return view('admin/enfermeria/view');

      }

    }

    public function baja($id){

        $enfermeria = new \App\admin\Enfermeria;
        $flag = $enfermeria->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$enfermeria deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EnfermeriaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EnfermeriaController@index');
        }
    }

    public function alta($id){
        $enfermeria = new \App\admin\Enfermeria;
        $flag = $enfermeria->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$enfermeria habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EnfermeriaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EnfermeriaController@index');
        }
    }

    public function getAjax($id){

      $enfermeria = new \App\admin\Enfermeria;

      $data = $enfermeria->getEnfermeriaView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
