<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class RolesController extends Controller
{
    public $v_fields=array('roles.id', 'roles.name', 'roles.description', 'roles.created_at', 'roles.updated_at', 'roles.status');
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
          $links[$value.'_link'] =url('/').'/admin/roles?'.$query_result;
        }
        $links['csvlink'] = url('/').'/admin/roles/export/csv?'.$_SERVER['QUERY_STRING'];
        $links['pdflink'] = url('/').'/admin/roles/export/pdf?'.$_SERVER['QUERY_STRING'];

        // pagination per page
        $per_page = isset($_GET['per_page'])?$_GET['per_page']:25;

        // search value
        if(isset($_GET['searchBy']) && in_array($_GET['searchBy'], $this->v_fields) && $_GET['searchValue']!=''){
            $searchBy=$_GET['searchBy'];
            $searchValue = $_GET['searchValue'];
        }

        // get by modal
        $roles = new \App\admin\Roles;

        $config = array();

        $config['titulo'] = "Administracion de Roles";

        $config['cancelar'] = url('/admin/roles');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de roles",
            'href' => url('/admin/roles'),
            'active' => false
        );

        $data = $roles->getRolesData($per_page, $searchBy, $searchValue, $sortBy, $order);

        return view('admin/roles/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config]);
    }

    public function getAdd(Request $request){

      $roles = new \App\admin\Roles;

      $config = array();

      $config['titulo'] = "Administracion de Roles";

      $config['cancelar'] = url('/admin/roles');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de roles",
          'href' => url('/admin/roles'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar roles",
          'href' => url('/admin/roles/add'),
          'active' => true
      );

      $data = new $roles;

      $modulos = array();

      $padres = $roles->getModules();

      foreach($padres as $parent) {

        $childres = $roles->getModules($parent->id);

        $child = array();

        foreach($childres as $ch) {

          $child[] = array(

            'id'    => $ch->id,

            'nombre'  => $ch->nombre,

          );

        }

        $modulos[] = array(

          'id'          => $parent->id,

          'icon_font'   => $parent->icon,

          'nombre'      => $parent->nombre,

          'childs'      => $child
        );

      }

      $seleccionados = array();

    	return view('admin/roles/add', ['config'=>$config,'data'=>$data,'modulos' => $modulos, 'seleccionados' => $seleccionados, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'name'=> 'required|string' ,
        ]);

        $roles = new \App\admin\Roles;


        $rol_id = $roles->addRoles($request);

        foreach($request->input('modulo') as $modulo) {

          $detail = array(

            'rol_id'      => $rol_id,

            'modulo_id'   => $modulo['modulo'],

            'status'      => 1,

          );

          $roles->addRolDetalle($detail);

        }

        $request->session()->flash('message', 'roles Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\RolesController@index');
    }

    public function getEdit($id=''){

        $roles = new \App\admin\Roles;

        $users = $roles->getAll('roles');

        $data = $roles->getRoles($id);

        $config = array();

        $config['titulo'] = "Administracion de Roles";

        $config['cancelar'] = url('/admin/roles');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de roles",
            'href' => url('/admin/roles'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar roles",
            'href' => url('/admin/roles/edit'),
            'active' => true
        );

        if(count($data)){

          $modulos = array();

          $padres = $roles->getModules();

          foreach($padres as $parent) {

            $childres = $roles->getModules($parent->id);

            $child = array();

            foreach($childres as $ch) {

              $child[] = array(

                'id'    => $ch->id,

                'nombre'  => $ch->nombre,

              );

            }

            $modulos[] = array(

              'id'          => $parent->id,

              'icon_font'   => $parent->icon,

              'nombre'      => $parent->nombre,

              'childs'      => $child
            );

          }

          $seleccionados = $roles->getSelectMods($id);

          return view('admin/roles/edit', ['data'=>$data, 'config'=>$config ,'modulos' => $modulos, 'seleccionados' => $seleccionados,]);
        } else{
          return view('admin/roles/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'name'=> 'required|string' ,
        ]);

        $roles = new \App\admin\Roles;
        if($roles->updateRoles($request)){

          $roles->clearSelectMods($request->input('id'));

          foreach($request->input('modulo') as $modulo) {

            $detail = array(

              'rol_id'      => $request->input('id'),

              'modulo_id'   => $modulo['modulo'],

              'status'      => 1,

            );

            $roles->addRolDetalle($detail);

          }

          $request->session()->flash('message', 'roles Editado exitosamente!');
          $request->session()->flash('exito', 'true');
          return redirect()->action('admin\RolesController@index');

        } else{

          $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
          $request->session()->flash('fracaso', 'true');
          return redirect()->action('admin\RolesController@index');

        }

    }

    public function view($id){

      $roles = new \App\admin\Roles;

      $data = $roles->getRolesView($id);

      $config = array();

      $config['titulo'] = "Administracion de Roles";

      $config['cancelar'] = url('/admin/roles');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de roles",
          'href' => url('/admin/roles'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de roles",
          'href' => url('/admin/roles/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/roles/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/roles/view');

      }

    }

    public function baja($id){

        $roles = new \App\admin\Roles;
        $flag = $roles->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$roles deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\RolesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\RolesController@index');
        }
    }

    public function alta($id){
        $roles = new \App\admin\Roles;
        $flag = $roles->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$roles habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\RolesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\RolesController@index');
        }
    }

}
