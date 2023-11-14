<?php

namespace App\admin;
use DB;
use Auth;
use Request;
use Illuminate\Database\Eloquent\Model;


class RolDetalle extends Model
{
    protected $table = 'rol_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status', 1)->get();
    }

    public static function getRolDetalle($rol_id, $modulo_id)
    {
      $data =  RolDetalle::where('rol_id', $rol_id)
                      ->where('modulo_id',$modulo_id)
                      ->get();
      if(count($data)){
        return $data[0];
      }else{
        return [];
      }
    }
}

class Roles extends Model
{

    const PERFILES = array(
        1 => 'Femenino',
        2 => 'Masculino',
    );

    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getRoles($id){
      $data =  Roles::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getRolesView($id){
      $roles = Roles::select(array('roles.*'));
      $roles->where('roles.id', $id);

      return $roles->get()[0];

    }

    public function updateStatus($id, $num){
      $roles = $this->getRoles($id);
      if(count($roles)){
        $roles->status = $num;
        $roles->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $roles = $this->getRoles($id);
      if(count($roles)){
        $img = public_path().'/uploads/'.$roles->featured_img;
            if($roles->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $roles->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getRolesData($per_page, $request, $sortBy, $order){
      $roles = Roles::select(array('roles.*'));

      //join

      if($request->input('name') != "") {
        $roles->where('name','LIKE','%' . $request->input('name') . '%');
      }

        // sort option
        $roles->orderBy('roles.id', 'desc');

        return $roles->paginate($per_page);
    }

    public function getRolesExport($request){
      $roles = Roles::select(array('roles.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $roles->where('roles.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $roles->orderBy('roles.id', 'desc');

        return $roles->get();
    }


    public function updateRoles($request){
      $id = $request->input('id');
      $roles = Roles::getRoles($id);
      if(count($roles)){
        $roles->name = $request->input('name')!="" ? $request->input('name') : "";
        $roles->description = $request->input('description')!="" ? $request->input('description') : "";
        $roles->updated_at = $request->input('updated_at')!="" ? $request->input('updated_at') : date('Y-m-d H:i:s');
        $roles->status = $request->input('status')!="" ? $request->input('status') : "";
        $roles->save();
        $this->setRolDetalle($roles->id,$request);
        return true;

      } else{
        return false;
      }
    }

    public function addRoles($request){
      $roles = new Roles;
        $roles->name = $request->input('name')!="" ? $request->input('name') : "";
      	$roles->description = $request->input('description')!="" ? $request->input('description') : "";
      	$roles->created_at = $request->input('created_at')!="" ? $request->input('created_at') : date('Y-m-d H:i:s');
      	$roles->updated_at = $request->input('updated_at')!="" ? $request->input('updated_at') : null;
      	$roles->status = $request->input('status')!="" ? $request->input('status') : "";
        $roles->save();
        $this->setRolDetalle($roles->id,$request);
        return $roles->id;
    }


    public function setRolDetalle($rol_id, $modules) {

      RolDetalle::where('rol_id',$rol_id)->delete();

      foreach($modules->input('module') as $key => $mods) {
        $access = new RolDetalle();

        $access->rol_id       = $rol_id;
        $access->modulo_id    = $key;
        $access->view         = $mods['view'] != null ? $mods['view'] : 0;
        $access->add          = $mods['add'] != null ? $mods['add'] : 0;
        $access->edit         = $mods['edit'] != null ? $mods['edit'] : 0;
        $access->delete       = $mods['delete'] != null ? $mods['delete'] : 0;
        $access->status       = 1;
        $access->save();

      }


    }


    public function addRolesDetalle($id_rol, $request) {

          $padres = $this->getModules();
          $view =[];
          $add =[];
          $edit =[];
          $delete =[];
          foreach ($request->input(["view"]) as $key => $value) {
            $view[$key] = $value;
          };
          foreach ($request->input(["add"]) as $key => $value) {
            $add[$key] = $value;
          };
          foreach ($request->input(["edit"]) as $key => $value) {
            $edit[$key] = $value;
          };
          foreach ($request->input(["del"]) as $key => $value) {
            $delete[$key] = $value;
          };
          foreach ($padres as $rol) {
              $detalle = new RolDetalle;
              $detalle->rol_id     = $id_rol;
              $detalle->modulo_id  = $rol['id'];
              $detalle->status  = 1;
              $detalle->visualizar = $view[$rol['id']] == 1  ? $view[$rol['id']] : null;
              $detalle->agregar    = $add[ $rol['id']] == 1  ? $add[$rol['id']] : null;
              $detalle->editar     = $edit[$rol['id']] == 1  ? $edit[$rol['id']] : null;
              $detalle->eliminar   = $delete[$rol['id']] == 1  ? $delete[$rol['id']] : null;
              $detalle->save();
          }
          return true;
        }

    public static function imprimeMenu($rol_id,$tipo) {

      $html = "";

      $data = DB::table('modulos');

      $data->select('modulos.*');

      $data->leftJoin('rol_detalle', 'rol_detalle.modulo_id', '=','modulos.id');

      $data->where('rol_detalle.rol_id',$rol_id);

      $data->where('modulos.padre_id','0');

      $data->where('modulos.tipo',$tipo);

      $data->where('modulos.status','1');

      $data->orderBy('modulos.orden', 'ASC');

      $menu = $data->get();

      $html = Roles::separador($tipo);

      foreach($menu as $item) {

        //Obtenemos los hijos asigndos al padre
        $data = DB::table('modulos');

        $data->select('modulos.*');

        $data->leftJoin('rol_detalle', 'rol_detalle.modulo_id', '=','modulos.id');

        $data->where('rol_detalle.rol_id',$rol_id);

        $data->where('modulos.padre_id',$item->id);

        $data->where('modulos.status','1');

        $data->orderBy('modulos.orden', 'ASC');

        $childrens = $data->get();

        if(!empty($item->url)) {
          $url = url($item->url);
        } else {
          $url =  "#";
        }

        $active = '';
        $parts =  explode('/',str_replace(env('APP_URL') . '/','',Request::url()));


        if ($parts[2] != "" && !in_array($parts[2],array('add','edit','view','alta','baja')) ) {
          $active_url = $parts[0] . '/' .$parts[1] . '/' .$parts[2];
        } else {
          $active_url = $parts[0] . '/' .$parts[1];
        }

        if($active_url == $item->url) { $active = 'active'; }


        $html .= '<li class="nav-item ' . $active . '" style="padding-bottom:10px;">
                    <a href="' . $url . '" class="d-flex">
                      <i class="fa ' . $item->icon . '"></i>
                      <span data-i18n="" class="menu-title">' . $item->nombre . '</span>
                    </a>';

        if(count($childrens)) {

          $html .= '<ul class="menu-content">';

          foreach($childrens as $child) {

            $active = '';

            $parts =  explode('/',str_replace(env('APP_URL') . '/','',Request::url()));

            if($active_url == $child->url) { $active = 'active'; }

            $html .= '<li class="' . $active . '">
                        <a href="' . url($child->url) . ' " class="d-flex align-items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                          <span class="menu-item text-truncate" data-i18n="Input">' . $child->nombre . '</span>
                        </a>
                      </li>';

          }

          $html .= '</ul>';

        }

        $html .= '</li>';

      }

      return $html;
    }

    public static function separador($tipo) {
      switch($tipo) {
        case 'admin':
          return '<li class=" navigation-header" style="margin-top:10px;">
                      <span data-i18n="User Interface">ADMINISTRACIÓN</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                      <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </li>';;
          break;
        case 'cats':
          return '<li class=" navigation-header" style="margin-top:10px;">
                      <span data-i18n="User Interface">CATALOGOS</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                      <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </li>';;
          break;
        case 'evals':
          return '<li class=" navigation-header" style="margin-top:10px;">
                      <span data-i18n="User Interface">EVALUACIONES</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                      <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </li>';;
          break;
        case 'conf':
          return '<li class=" navigation-header" style="margin-top:10px;">
                      <span data-i18n="User Interface">CONFIGURACIÓN</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                      <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </li>';;
          break;
        case 'otros':
          return '<li class=" navigation-header" style="margin-top:10px;">
                      <span data-i18n="User Interface">OTROS</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                      <circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </li>';;
          break;


      }
    }

    public function getModules($modulo_id = 0){

      return Modulos::where('status', '1')
                    ->where('padre_id', $modulo_id)
                    ->get();
    }

    public function getSelectMods($rol_id) {

      $array = array();

      $data = RolDetalle::where('rol_id', $rol_id)
                        ->get();

      foreach($data as $row) {

        $array[] = $row->modulo_id;
        $array['view_'.$row->modulo_id] = $row->view;
        $array['add_'.$row->modulo_id] = $row->add;
        $array['edit_'.$row->modulo_id] = $row->edit;
        $array['delete_'.$row->modulo_id] = $row->delete;


      }
      return $array;
    }

}
