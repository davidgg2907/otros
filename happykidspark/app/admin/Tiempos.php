<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Tiempos extends Model
{
    protected $table = 'tiempos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getTiempos($id){
      $data =  Tiempos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getTiemposView($id){
      $tiempos = Tiempos::select(array('tiempos.*'));
      $tiempos->where('tiempos.id', $id);

      return $tiempos->get()[0];

    }

    public function updateStatus($id, $num){
      $tiempos = $this->getTiempos($id);
      if(count($tiempos)){
        $tiempos->status = $num;
        $tiempos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $tiempos = $this->getTiempos($id);
      if(count($tiempos)){
        $img = public_path().'/uploads/'.$tiempos->featured_img;
            if($tiempos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $tiempos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getTiemposData($per_page, $request, $sortBy, $order){
      $tiempos = Tiempos::select(array('tiempos.*'));

      //join
      $tiempos->where('status', 1);


        if(Auth::user()->comercio_id != 0) {
          $tiempos->where('tiempos.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $tiempos->where('tiempos.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $tiempos->where('tiempos.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $tiempos->orderBy('tiempos.id', 'desc');

        return $tiempos->paginate($per_page);
    }

    public function getTiemposExport($request){
      $tiempos = Tiempos::select(array('tiempos.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $tiempos->where('tiempos.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $tiempos->orderBy('tiempos.id', 'desc');

        return $tiempos->get();
    }

    public function updateTiempos($request){
      $id = $request->input('id');
      $tiempos = Tiempos::getTiempos($id);
      if(count($tiempos)){

          $tiempos->minutos = $request->input('minutos')!="" ? $request->input('minutos') : "";
	$tiempos->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$tiempos->status = $request->input('status')!="" ? $request->input('status') : "";

          $tiempos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addTiempos($request){
      $tiempos = new Tiempos;

        $tiempos->minutos = $request->input('minutos')!="" ? $request->input('minutos') : "";
	$tiempos->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$tiempos->status = $request->input('status')!="" ? $request->input('status') : "";

        $tiempos->save();
        return true;
    }
}
