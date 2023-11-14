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

    const PERFILES = array(
        '0' => 'Administrador',
        '1' => 'Cajero',
        '2' => 'Cronometrista',
    );

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
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
      $users = Users::select(array('users.*'));
      $users->where('users.id', $id);

      return $users->get()[0];

    }

    public function updateStatus($id, $num){
      $users = $this->getUsers($id);
      if(count($users)){
        $users->status = $num;

        if($num == 0) {
            $users->password = bcrypt("");
        }
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

    public function getUsersData($per_page, $request, $sortBy, $order){
      $users = Users::select(array('users.*'));

      //join
      if($request->input('name') != "") {
        $users->where('name','LIKE','%' . $request->input('name') . '%');
      }

      if($request->input('perfil') != "") {
        $users->where('perfil',$request->input('perfil'));
      }

      if($request->input('rol_id') != "") {
        $users->where('rol_id',$request->input('rol_id'));
      }

      if($request->input('email') != "") {
        $users->where('email','LIKE','%' . $request->input('email') . '%');
      }

      $users->where('status',1);

        // sort option
        $users->orderBy('users.id', 'desc');

        return $users->paginate($per_page);
    }

    public function getUsersExport($request){
      $users = Users::select(array('users.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $users->where('users.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $users->orderBy('users.id', 'desc');

        return $users->get();
    }

    public function updateUsers($request){
      $id = $request->input('id');
      $users = Users::getUsers($id);
      if(count($users)){

        $users->rol_id = $request->input('rol_id')!="" ? $request->input('rol_id') : 0;
        $users->perfil = $request->input('perfil')!="" ? $request->input('perfil') : null;
        if($request->input('perfil') == 1) {
          $users->categoria_id = $request->input('categoria_id')!="" ? implode(',',$request->input('categoria_id')) : null;
        } else {
          $users->categoria_id = null;
        }
        $users->photo = $request->input('photo')=="" ? $request->input('old_photo') : $request->input('photo') ;

        // image upload code
        $photo_name='';
        $photo_file = $request->file('photo');
        if(!is_null($photo_file) && in_array($photo_file->getClientOriginalExtension(), $this->allow_image)){
            $photo_name = time().'_'.$photo_file->getClientOriginalName();
            $photo_file->move('uploads/usuarios',$photo_name);
            $users->photo = $photo_name;
        }

        $users->name = $request->input('name')!="" ? $request->input('name') : "";
        $users->email = $request->input('email')!="" ? $request->input('email') : "";
        if($request->input('password') != "") {
          $users->password = $request->input('password')!="" ? bcrypt($request->input('password'))  : "";
        }
        $users->updated_at = date('Y-m-d H:i:s');

        $users->save();
        return true;

      } else{
        return false;
      }
    }

    public function addUsers($request){
      $users = new Users;

      $users->rol_id = $request->input('rol_id')!="" ? $request->input('rol_id') : 0;
      $users->perfil = $request->input('perfil')!="" ? $request->input('perfil') : null;
      if($request->input('perfil') == 1) {
        $users->categoria_id = $request->input('categoria_id')!="" ? implode(',',$request->input('categoria_id')) : null;
      } else {
        $users->categoria_id = null;
      }
      $users->photo = $request->input('photo')=="" ? $request->input('old_photo') : $request->input('photo') ;

      // image upload code
      $photo_name='';
      $photo_file = $request->file('photo');
      if(!is_null($photo_file) && in_array($photo_file->getClientOriginalExtension(), $this->allow_image)){
          $photo_name = time().'_'.$photo_file->getClientOriginalName();
          $photo_file->move('uploads/usuarios',$photo_name);
          $users->photo = $photo_name;
      }

      $users->name = $request->input('name')!="" ? $request->input('name') : "";
      $users->email = $request->input('email')!="" ? $request->input('email') : "";
      $users->password = $request->input('password')!="" ? bcrypt($request->input('password'))  : "";
      $users->remember_token = null;
      $users->api_token = null;
      $users->created_at = date('Y-m-d H:i:s');
      $users->updated_at = null;
      $users->time_login = null;
      $users->time_logout = null;
      $users->online = null;
      $users->status = 1;

      $users->save();
      return true;
    }

    public function rol(){
      return $this->hasOne('\App\admin\Roles', 'id', 'rol_id');
    }

    public function sucursal(){
      return $this->hasOne('\App\admin\Sucursales', 'id', 'sucursal_id');
    }
}
