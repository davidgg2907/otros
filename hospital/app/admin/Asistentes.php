<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Asistentes extends Model
{
    protected $table = 'asistentes';
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

    public function getAsistentes($id){
      $data =  Asistentes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAsistentesView($id){
      $asistentes = Asistentes::select(array('asistentes.*'));
      $asistentes->where('asistentes.id', $id);

      return $asistentes->get()[0];

    }

    public function changeStatus($field, $id){
      $asistentes = $this->getAsistentes($id);
      if(count($asistentes)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $asistentes = $this->getAsistentes($id);
      if(count($asistentes)){
        $asistentes->status = $num;
        $asistentes->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $asistentes = $this->getAsistentes($id);
      if(count($asistentes)){
        $img = public_path().'/uploads/'.$asistentes->featured_img;
            if($asistentes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $asistentes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAsistentesData($per_page, $request, $sortBy, $order){
      $asistentes = Asistentes::select(array('asistentes.*'));

      // where condition
      if($request->input('nombre') != ""){
        $asistentes->where('nombre','LIKE','%' . $request->input('nombre') . '%');
      }

      if($request->input('rfc') != ""){
        $asistentes->where('rfc','LIKE','%' . $request->input('rfc') . '%');
      }

      if($request->input('celular') != ""){
        $asistentes->where('celular','LIKE','%' . $request->input('celular') . '%');
      }

      $asistentes->where('status',1);


        // sort option
        if($sortBy!='' && $order!=''){
          $asistentes->orderBy($sortBy, $order);
        } else{
          $asistentes->orderBy('asistentes.id', 'desc');
        }

        return $asistentes->paginate($per_page);
    }

    public function getAsistentesExport($searchBy, $searchValue, $sortBy, $order){
      $asistentes = Asistentes::select(array('asistentes.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $asistentes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $asistentes->orderBy($sortBy, $order);
        } else{
          $asistentes->orderBy('asistentes.id', 'desc');
        }
        return $asistentes->get();
    }

    public function updateAsistentes($request){
      $id = $request->input('id');
      $asistentes = Asistentes::getAsistentes($id);
      if(count($asistentes)){

          $asistentes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$asistentes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$asistentes->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
        	$asistentes->curp = $request->input('curp')!="" ? $request->input('curp') : "";
        	$asistentes->honorarios = $request->input('honorarios')!="" ? $request->input('honorarios') : 0;
        	$asistentes->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
          $asistentes->doctores = $request->input('doctores')!="" ?  implode(',',$request->input('doctores')) : "";
        	$asistentes->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

          // image upload code
          $fotografia_name='';
          $fotografia_file = $request->file('fotografia');
          if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
              $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
              $fotografia_file->move('uploads',$fotografia_name);
              $asistentes->fotografia = $fotografia_name;
          }

        	$asistentes->status = $request->input('status')!="" ? $request->input('status') : "";

          $asistentes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAsistentes($request){
      $asistentes = new Asistentes;

        $asistentes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$asistentes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      	$asistentes->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
      	$asistentes->curp = $request->input('curp')!="" ? $request->input('curp') : "";
      	$asistentes->honorarios = $request->input('honorarios')!="" ? $request->input('honorarios') : 0;
      	$asistentes->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
        $asistentes->doctores = $request->input('doctores')!="" ? implode(',',$request->input('doctores')) : "";
      	$asistentes->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

        // image upload code
        $fotografia_name='';
        $fotografia_file = $request->file('fotografia');
        if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
            $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
            $fotografia_file->move('uploads',$fotografia_name);
            $asistentes->fotografia = $fotografia_name;
        }

      	$asistentes->status = $request->input('status')!="" ? $request->input('status') : "";

        $asistentes->save();
        return $asistentes->id;
    }
}
