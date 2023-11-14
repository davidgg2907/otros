<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class RolesController extends Controller
{
    public $v_fields=array('roles.id', 'roles.name', 'roles.description', 'roles.created_at', 'roles.updated_at', 'roles.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $roles = new \App\admin\Roles;

        $config = array();

        $config['titulo'] = "roles";

        $config['cancelar'] = url('/admin/roles');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de roles",
            'href' => url('/admin/roles'),
            'active' => false
        );

        $data = $roles->getRolesData($per_page, $request, $sortBy, $order);

        return view('admin/roles/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $roles = new \App\admin\Roles;

      $config = array();

      $config['titulo'] = "roles";

      $config['cancelar'] = url('/admin/roles');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
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

    	return view('admin/roles/add', ['config'=>$config,'data'=>$data,'modulos' => $modulos, 'seleccionados' => $seleccionados ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $roles = new \App\admin\Roles;
        $roles->addRoles($request);
        $request->session()->flash('message', 'roles Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\RolesController@index');
    }

    public function getEdit($id=''){

        $roles = new \App\admin\Roles;

        $users = $roles->getAll('roles');

        $data = $roles->getRoles($id);

        $config = array();

        $config['titulo'] = "roles";

        $config['cancelar'] = url('/admin/roles');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
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

                'icon' => $ch->icon,

                'orden' => $ch->orden


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

          return view('admin/roles/edit', ['data'=>$data, 'config'=>$config ,'modulos' => $modulos, 'seleccionados' => $seleccionados]);
        } else{
          return view('admin/roles/edit');
        }
    }

    public function postEdit(Request $request){
      $roles = new \App\admin\Roles;
      if($roles->updateRoles($request)){
        $request->session()->flash('message', 'roles Editado exitosamente!');
        $request->session()->flash('exito', 'true');
      } else{
        $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
        $request->session()->flash('fracaso', 'true');
      }
      return redirect()->action('admin\RolesController@index');
    }

    public function view($id){

      $roles = new \App\admin\Roles;

      $data = $roles->getRolesView($id);

      $config = array();

      $config['titulo'] = "roles";

      $config['cancelar'] = url('/admin/roles');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
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

    public function getAjax($id){

      $roles = new \App\admin\Roles;

      $data = $roles->getRolesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $roles = new \App\admin\Roles;

      $data = $roles->getRolesExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$roles', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
