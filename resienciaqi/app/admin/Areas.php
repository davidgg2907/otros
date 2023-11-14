<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'areas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getAreas($id){
      $data =  Areas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAreasView($id){
      $areas = Areas::select(array('areas.*'));
      $areas->where('areas.id', $id);

      return $areas->get()[0];

    }

    public function updateStatus($id, $num){
      $areas = $this->getAreas($id);
      if(count($areas)){
        $areas->status = $num;
        $areas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $areas = $this->getAreas($id);
      if(count($areas)){
        $img = public_path().'/uploads/'.$areas->featured_img;
            if($areas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $areas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAreasData($per_page, $request, $sortBy, $order){
      $areas = Areas::select(array('areas.*'));

      //join


        // sort option
        $areas->orderBy('areas.id', 'desc');

        return $areas->paginate($per_page);
    }

    public function updateAreas($request){
      $id = $request->input('id');
      $areas = Areas::getAreas($id);
      if(count($areas)){

          $areas->delegacion_id = $request->input('delegacion_id')!="" ? $request->input('delegacion_id') : "";
	$areas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$areas->status = $request->input('status')!="" ? $request->input('status') : "";

          $areas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAreas($request){
      $areas = new Areas;

        $areas->delegacion_id = $request->input('delegacion_id')!="" ? $request->input('delegacion_id') : "";
      	$areas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$areas->status = $request->input('status')!="" ? $request->input('status') : "";

        $areas->save();
        return true;
    }

    public function delegacion(){
      return $this->hasOne('\App\admin\Delegaciones', 'id', 'delegacion_id');
    }
}
