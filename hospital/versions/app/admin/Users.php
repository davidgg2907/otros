<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
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

    public function getUsers($id){
      $data =  Users::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getUsersView($id){
      $users = Users::select(array('users.*' , 'roles.name'));
      $users->where('users.id', $id);
      $users->leftJoin('roles', 'users.rol', '=','roles.id');
      return $users->get()[0];

    }

    public function changeStatus($field, $id){
      $users = $this->getUsers($id);
      if(count($users)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $users = $this->getUsers($id);
      if(count($users)){
        $users->status = $num;
        $users->save();
        return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $users = $this->getUsers($id);
      if(count($users)){
        $img = public_path().'/uploads/'.$users->featured_img;
            if($users->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $users->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getUsersData($per_page, $request, $type){

      $users = Users::select(array('users.*' , 'roles.name AS role'));
      //join
      $users->leftJoin('roles', 'users.rol', '=','roles.id');

      return $users->paginate($per_page);

    }

    public function getByType($type){

      $users = Users::select(array('users.*' , 'roles.name AS role'));
      //join
      $users->leftJoin('roles', 'users.rol', '=','roles.id');

      if(Auth::user()->tipo == 3) {

        $users->where('estado', Auth::user()->estado);

      }

      // where condition
      $users->where('tipo', $type);


      return $users->get();

    }

    public function getUsersExport($searchBy, $searchValue, $sortBy, $order){
      $users = Users::select(array('users.*' , 'roles.name'));

      //join
        $users->leftJoin('roles', 'users.rol', '=','roles.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $users->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $users->orderBy($sortBy, $order);
        } else{
          $users->orderBy('users.id', 'desc');
        }
        return $users->get();
    }

    public function updateUsers($request){
      $id = $request->input('id');
      $users = Users::getUsers($id);
      if(count($users)){

        $users->rol            = $request->input('rol')!="" ? $request->input('rol') : 0;
        $users->medico_id      = $request->input('medico_id')!="" ? $request->input('medico_id') : null;
        $users->paciente_id    = $request->input('paciente_id')!="" ? $request->input('paciente_id') : null;
        $users->enfermera_id   = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : null;
        $users->asistente_id   = $request->input('asistente_id')!="" ? $request->input('asistente_id') : null;
        $users->name           = $request->input('name')!="" ? $request->input('name') : "";
        $users->email          = $request->input('email')!="" ? $request->input('email') : "";
        $users->updated_at     = date('Y-m-d');

        $users->save();


        if($request->input('password')!="") {

          $users->password       = bcrypt ( $request->input('password') );

        }

        $users->save();
        return true;

      } else{
        return false;
      }
    }

    public function addUsers($request){
      $users = new Users;

        $users->rol            = $request->input('rol')!="" ? $request->input('rol') : 0;
        $users->medico_id      = $request->input('medico_id')!="" ? $request->input('medico_id') : null;
        $users->paciente_id    = $request->input('paciente_id')!="" ? $request->input('paciente_id') : null;
        $users->enfermera_id   = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : null;
        $users->asistente_id   = $request->input('asistente_id')!="" ? $request->input('asistente_id') : null;
      	$users->name           = $request->input('name')!="" ? $request->input('name') : "";
      	$users->email          = $request->input('email')!="" ? $request->input('email') : "";
      	$users->password       = $request->input('password')!="" ? bcrypt ( $request->input('password') ) : "";
      	$users->remember_token = null;
      	$users->created_at     = date('Y-m-d');
      	$users->updated_at     = null;
      	$users->time_login     = null;
      	$users->online         = 0;
      	$users->status         = 1;

        $users->save();
        return true;
    }

    public function createUser($request){
      $users = new Users;

      if($request['name'] != "" && $request['email'] != "" && $request['password'] != "" ) {

        $users->rol            = $request['rol_id'];
        $users->asistente_id   = $request['asistente_id'];
        $users->medico_id      = $request['medico_id'];
        $users->enfermera_id   = $request['enfermera_id'];
        $users->paciente_id    = $request['paciente_id'];
        $users->name           = $request['name'];
        $users->email          = $request['email'];
        $users->password       = bcrypt ($request['password'] );
        $users->online         = 0;
        $users->status         = 1;

        $users->save();

      }

      return true;
    }

    public function updateUser($request){

      $users = $this->getUsers($request['id']);

      if(count($users)) {

        $users->rol            = $request['rol_id'];
        $users->asistente_id   = $request['asistente_id'];
        $users->medico_id      = $request['medico_id'];
        $users->enfermera_id   = $request['enfermera_id'];
        $users->paciente_id    = $request['paciente_id'];
        $users->name           = $request['name'];
        $users->email          = $request['email'];

        if($request['password']) {

          $users->password       = bcrypt ($request['password'] );

        }

        $users->online         = 0;
        $users->status         = 1;

        $users->save();

      } else {

        $this->createUser($request);

      }

      return true;
    }

    public function permisos() {
      return $this->hasOne('\App\admin\Roles', 'id', 'rol');
    }

    public function medico() {
      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');
    }

    public function enfermera() {
      return $this->hasOne('\App\admin\Enfermeria', 'id', 'enfermera_id');
    }

    public function paciente() {
      return $this->hasOne('\App\admin\Pacientes', 'id', 'paciente_id');
    }

    public function getPerfil() {

      if(Auth::user()->medico_id != 0) {
        return Auth::user()->medico;
      }

      if(Auth::user()->paciente_id != 0) {
        return Auth::user()->paciente;
      }

      if(Auth::user()->enfermera_id != 0) {
        return Auth::user()->enfermera;
      }

    }
}
