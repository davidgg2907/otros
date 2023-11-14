<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Riesgos_parameros extends Model
{
    protected $table = 'riesgos_parameros';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getRiesgos_parameros($id){
      $data =  Riesgos_parameros::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getRiesgos_paramerosView($id){
      $riesgos_parameros = Riesgos_parameros::select(array('riesgos_parameros.*'));
      $riesgos_parameros->where('riesgos_parameros.id', $id);
      
      return $riesgos_parameros->get()[0];

    }

    public function updateStatus($id, $num){
      $riesgos_parameros = $this->getRiesgos_parameros($id);
      if(count($riesgos_parameros)){
        $riesgos_parameros->status = $num;
        $riesgos_parameros->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $riesgos_parameros = $this->getRiesgos_parameros($id);
      if(count($riesgos_parameros)){
        $img = public_path().'/uploads/'.$riesgos_parameros->featured_img;
            if($riesgos_parameros->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $riesgos_parameros->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getRiesgos_paramerosData($per_page, $request, $sortBy, $order){
      $riesgos_parameros = Riesgos_parameros::select(array('riesgos_parameros.*'));

      //join
        

        // sort option
        $riesgos_parameros->orderBy('riesgos_parameros.id', 'desc');

        return $riesgos_parameros->paginate($per_page);
    }

    public function updateRiesgos_parameros($request){
      $id = $request->input('id');
      $riesgos_parameros = Riesgos_parameros::getRiesgos_parameros($id);
      if(count($riesgos_parameros)){

          $riesgos_parameros->id = $request->input('id')!="" ? $request->input('id') : "";
	$riesgos_parameros->grupo_id = $request->input('grupo_id')!="" ? $request->input('grupo_id') : "";
	$riesgos_parameros->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$riesgos_parameros->status = $request->input('status')!="" ? $request->input('status') : "";

          $riesgos_parameros->save();
          return true;
      } else{
        return false;
      }
    }

    public function addRiesgos_parameros($request){
      $riesgos_parameros = new Riesgos_parameros;

        $riesgos_parameros->id = $request->input('id')!="" ? $request->input('id') : "";
	$riesgos_parameros->grupo_id = $request->input('grupo_id')!="" ? $request->input('grupo_id') : "";
	$riesgos_parameros->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$riesgos_parameros->status = $request->input('status')!="" ? $request->input('status') : "";

        $riesgos_parameros->save();
        return true;
    }
}
