<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Riesgos_grupos extends Model
{
    protected $table = 'riesgos_grupos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getRiesgos_grupos($id){
      $data =  Riesgos_grupos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getRiesgos_gruposView($id){
      $riesgos_grupos = Riesgos_grupos::select(array('riesgos_grupos.*'));
      $riesgos_grupos->where('riesgos_grupos.id', $id);
      
      return $riesgos_grupos->get()[0];

    }

    public function updateStatus($id, $num){
      $riesgos_grupos = $this->getRiesgos_grupos($id);
      if(count($riesgos_grupos)){
        $riesgos_grupos->status = $num;
        $riesgos_grupos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $riesgos_grupos = $this->getRiesgos_grupos($id);
      if(count($riesgos_grupos)){
        $img = public_path().'/uploads/'.$riesgos_grupos->featured_img;
            if($riesgos_grupos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $riesgos_grupos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getRiesgos_gruposData($per_page, $request, $sortBy, $order){
      $riesgos_grupos = Riesgos_grupos::select(array('riesgos_grupos.*'));

      //join
        

        // sort option
        $riesgos_grupos->orderBy('riesgos_grupos.id', 'desc');

        return $riesgos_grupos->paginate($per_page);
    }

    public function updateRiesgos_grupos($request){
      $id = $request->input('id');
      $riesgos_grupos = Riesgos_grupos::getRiesgos_grupos($id);
      if(count($riesgos_grupos)){

          $riesgos_grupos->id = $request->input('id')!="" ? $request->input('id') : "";
	$riesgos_grupos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$riesgos_grupos->status = $request->input('status')!="" ? $request->input('status') : "";

          $riesgos_grupos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addRiesgos_grupos($request){
      $riesgos_grupos = new Riesgos_grupos;

        $riesgos_grupos->id = $request->input('id')!="" ? $request->input('id') : "";
	$riesgos_grupos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$riesgos_grupos->status = $request->input('status')!="" ? $request->input('status') : "";

        $riesgos_grupos->save();
        return true;
    }
}
