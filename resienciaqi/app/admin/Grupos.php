<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    protected $table = 'grupos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getGrupos($id){
      $data =  Grupos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getGruposView($id){
      $grupos = Grupos::select(array('grupos.*'));
      $grupos->where('grupos.id', $id);
      
      return $grupos->get()[0];

    }

    public function updateStatus($id, $num){
      $grupos = $this->getGrupos($id);
      if(count($grupos)){
        $grupos->status = $num;
        $grupos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $grupos = $this->getGrupos($id);
      if(count($grupos)){
        $img = public_path().'/uploads/'.$grupos->featured_img;
            if($grupos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $grupos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getGruposData($per_page, $request, $sortBy, $order){
      $grupos = Grupos::select(array('grupos.*'));

      //join
        

        // sort option
        $grupos->orderBy('grupos.id', 'desc');

        return $grupos->paginate($per_page);
    }

    public function updateGrupos($request){
      $id = $request->input('id');
      $grupos = Grupos::getGrupos($id);
      if(count($grupos)){

          $grupos->id = $request->input('id')!="" ? $request->input('id') : "";
	$grupos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$grupos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
	$grupos->status = $request->input('status')!="" ? $request->input('status') : "";

          $grupos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addGrupos($request){
      $grupos = new Grupos;

        $grupos->id = $request->input('id')!="" ? $request->input('id') : "";
	$grupos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$grupos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
	$grupos->status = $request->input('status')!="" ? $request->input('status') : "";

        $grupos->save();
        return true;
    }
}
