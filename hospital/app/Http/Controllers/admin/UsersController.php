<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Users;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class UsersController extends Controller
{
    public $v_fields=array('users.id', 'roles.name', 'users.tipo', 'users.estado', 'users.telefono', 'users.celular', 'users.direccion', 'users.name', 'users.email', 'users.password', 'users.remember_token', 'users.created_at', 'users.updated_at', 'users.time_login', 'users.online', 'users.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){
        $sortBy='';
        $order = '';
        $searchBy='';
        $searchValue='';

        // order
        if(isset($_GET['sortBy']) && in_array($_GET['sortBy'], $this->v_fields)){
            $sortBy=$_GET['sortBy'];
            $order = isset($_GET['order']) && $_GET['order']=='asc'?'asc':'desc';
            if(isset($_GET['order']) && $_GET['order']!=''){
                $_GET['order']=$_GET['order']=='asc'?'desc':'asc';
            } else{
                $_GET['order']='desc';
            }
        }

        // create links for field
        $get_q = $_GET;
        foreach ($this->v_fields as $key => $value) {
          $get_q['sortBy'] = $value;
          $get_q['page']=1;
          $query_result = http_build_query($get_q);
          $links[$value.'_link'] =url('/').'/admin/users?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/users/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/users/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $users = new \App\admin\Users;

        $config = array();

        $config['titulo'] = "Control de Usuarios";

        $config['cancelar'] = url('/admin/users');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de users",
            'href' => url('/admin/users'),
            'active' => false
        );

        $data = $users->getUsersData($per_page, $request,0);

        return view('admin/users/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $users = new \App\admin\Users;

      $config = array();

      $config['titulo'] = "Control de Usuarios";

      $config['cancelar'] = url('/admin/users');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de users",
          'href' => url('/admin/users'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar users",
          'href' => url('/admin/users/add'),
          'active' => true
      );

      $data = new $users;

    	return view('admin/users/add', ['config'=>$config,'data'=>$data, 'roles'=>$users->getAll('roles')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
          	 'name'=> 'required' ,
          	 'email'=> 'required' ,
          	 'password' => 'required|min:6|confirmed',
          	 'status'=> 'required'
        ]);

        $users = new \App\admin\Users;
        $users->addUsers($request);
        $request->session()->flash('message', 'users Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\UsersController@index');
    }

    public function getEdit($id=''){

        $users = new \App\admin\Users;

        $data = $users->getUsers($id);

        $config = array();

        $config['titulo'] = "Control de Usuarios";

        $config['cancelar'] = url('/admin/users');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de users",
            'href' => url('/admin/users'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar users",
            'href' => url('/admin/users/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/users/edit', ['data'=>$data, 'config'=>$config ,'roles'=>$users->getAll('roles')]);
        } else{
          return view('admin/users/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
          	 'name'=> 'required' ,
          	 'email'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $users = new \App\admin\Users;
        if($users->updateUsers($request)){
            $request->session()->flash('message', 'users Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\UsersController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\UsersController@index');
        }
    }

    public function view($id){

      $users = new \App\admin\Users;

      $data = $users->getUsersView($id);

      $config = array();

      $config['titulo'] = "Control de Usuarios";

      $config['cancelar'] = url('/admin/users');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de users",
          'href' => url('/admin/users'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de users",
          'href' => url('/admin/users/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/users/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/users/view');

      }

    }

    public function baja($id){

        $users = new \App\admin\Users;
        $flag = $users->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$users deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\UsersController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\UsersController@index');
        }
    }

    public function alta($id){
        $users = new \App\admin\Users;
        $flag = $users->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$users habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\UsersController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\UsersController@index');
        }
    }

    public function getAjax($id){

      $users = new \App\admin\Users;

      $data = $users->getUsersView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getPerfil(){

      $users = new \App\admin\Users;

      $data = $users->getUsersView(Auth::user()->id);

      $config = array();

      $config['titulo'] = "Control de Usuarios";

      $config['cancelar'] = url('/admin/users');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de users",
          'href' => url('/admin/users'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de users",
          'href' => url('/admin/users/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/users/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/users/view');

      }

    }

}
