<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->get();
    }

    public function getPermissions($id){
      $data =  Permissions::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPermissionsView($id){
      $permissions = Permissions::select(array('permissions.*'));
      $permissions->where('permissions.id', $id);

      return $permissions->get()[0];

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

    public function changeStatus($field, $id){
      $roles = $this->getRoles($id);
      if(count($roles)){

            return true;
      } else{
        return false;
      }
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

    public function getRolesData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $roles = Roles::select(array('roles.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $roles->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $roles->where('status', '1');

        // sort option
        if($sortBy!='' && $order!=''){
          $roles->orderBy($sortBy, $order);
        } else{
          $roles->orderBy('roles.id', 'desc');
        }

        return $roles->paginate($per_page);
    }

    public function getRolesExport($searchBy, $searchValue, $sortBy, $order){
      $roles = Roles::select(array('roles.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $roles->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $roles->orderBy($sortBy, $order);
        } else{
          $roles->orderBy('roles.id', 'desc');
        }
        return $roles->get();
    }

    public function updateRoles($request){
      $id = $request->input('id');
      $roles = Roles::getRoles($id);
      if(count($roles)){

        $roles->name          = $request->input('name')!="" ? $request->input('name') : "";

        $roles->visual        = $request->input('visual')!="" ? $request->input('visual') : "";
        $roles->addRecord     = $request->input('addRecord')!="" ? $request->input('addRecord') : "";
        $roles->editRecord    = $request->input('editRecord')!="" ? $request->input('editRecord') : "";
        $roles->viewRecord    = $request->input('viewRecord')!="" ? $request->input('viewRecord') : "";
        $roles->deleteRecord  = $request->input('deleteRecord')!="" ? $request->input('deleteRecord') : "";

        $roles->description   = $request->input('name')!="" ? $request->input('name') : "";
        $roles->updated_at    = date('Y-m-d');
        $roles->status        = $request->input('status')!="" ? $request->input('status') : 1;

        $roles->save();
        return true;

      } else{
        return false;
      }
    }

    public function addRoles($request){
      $roles = new Roles;

      	$roles->name          = $request->input('name')!="" ? $request->input('name') : "";
        $roles->visual        = $request->input('visual')!="" ? $request->input('visual') : "";

        $roles->addRecord     = $request->input('addRecord')!="" ? $request->input('addRecord') : "";
        $roles->editRecord    = $request->input('editRecord')!="" ? $request->input('editRecord') : "";
        $roles->viewRecord    = $request->input('viewRecord')!="" ? $request->input('viewRecord') : "";
        $roles->deleteRecord  = $request->input('deleteRecord')!="" ? $request->input('deleteRecord') : "";

        $roles->description   = $request->input('name')!="" ? $request->input('name') : "";
      	$roles->created_at    = date('Y-m-d');
      	$roles->status = 1;

        $roles->save();
        return $roles->id;
    }

    public function getModules($modulo_id = 0){

      return DB::table('modulos')

                                ->where('status', '1')

                                ->where('padre_id',$modulo_id)

                                ->where('status',1)

                                ->get();


    }

    public function clearSelectMods($rol_id) {

      $data = DB::table('rol_detalle')
                                   ->where('rol_id',$rol_id)

                                   ->delete();
      return true;
    }

    public function addRolDetalle($insert) {

      DB::table('rol_detalle')->insert([$insert]);
    }

    public function getSelectMods($rol_id) {

      $array = array();

      $data = DB::table('rol_detalle')
                                   ->where('rol_id',$rol_id)
                                   ->get();

      foreach($data as $row) {

        $array[] = $row->modulo_id;

      }

      return $array;
    }

    public function imprimeMenu($rol_id) {

      $html = "";

      $data = DB::table('modulos');

      $data->select('modulos.*');

      $data->leftJoin('rol_detalle', 'rol_detalle.modulo_id', '=','modulos.id');

      $data->where('rol_detalle.rol_id',$rol_id);

      $data->where('modulos.padre_id','0');

      $data->where('modulos.status','1');

      $data->orderBy('modulos.orden', 'ASC');

      $menu = $data->get();

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


        $html .= '<li>
                    <a href="' . $url . '" class="waves-effect">
                      <i class="fa ' . $item->icon . ' fa-lg"></i>
                      <span class="hide-menu">' . $item->nombre . '</span>
                    </a>';

        if(count($childrens)) {

          $html .= '<ul class="nav nav-second-level">';

          foreach($childrens as $child) {

            $html .= '<li>
                        <a href="' . url($child->url) . ' ">
                          <i class="fa ' . $child->icon . ' fa-lg"></i> &nbsp;&nbsp; ' . $child->nombre . '
                        </a>
                      </li>';

          }

          $html .= '</ul>';

        }

        $html .= '</li>';

      }

      return $html;
    }

}
