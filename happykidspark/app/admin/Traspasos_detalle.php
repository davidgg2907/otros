<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Traspasos_detalle extends Model
{
    protected $table = 'traspasos_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getTraspasos_detalle($id){
      $data =  Traspasos_detalle::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getTraspasos_detalleView($id){
      $traspasos_detalle = Traspasos_detalle::select(array('traspasos_detalle.*'));
      $traspasos_detalle->where('traspasos_detalle.id', $id);
      
      return $traspasos_detalle->get()[0];

    }

    public function updateStatus($id, $num){
      $traspasos_detalle = $this->getTraspasos_detalle($id);
      if(count($traspasos_detalle)){
        $traspasos_detalle->status = $num;
        $traspasos_detalle->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $traspasos_detalle = $this->getTraspasos_detalle($id);
      if(count($traspasos_detalle)){
        $img = public_path().'/uploads/'.$traspasos_detalle->featured_img;
            if($traspasos_detalle->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $traspasos_detalle->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getTraspasos_detalleData($per_page, $request, $sortBy, $order){
      $traspasos_detalle = Traspasos_detalle::select(array('traspasos_detalle.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $traspasos_detalle->where('traspasos_detalle.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $traspasos_detalle->where('traspasos_detalle.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $traspasos_detalle->where('traspasos_detalle.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $traspasos_detalle->orderBy('traspasos_detalle.id', 'desc');

        return $traspasos_detalle->paginate($per_page);
    }

    public function getTraspasos_detalleExport($request){
      $traspasos_detalle = Traspasos_detalle::select(array('traspasos_detalle.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $traspasos_detalle->where('traspasos_detalle.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $traspasos_detalle->orderBy('traspasos_detalle.id', 'desc');

        return $traspasos_detalle->get();
    }

    public function updateTraspasos_detalle($request){
      $id = $request->input('id');
      $traspasos_detalle = Traspasos_detalle::getTraspasos_detalle($id);
      if(count($traspasos_detalle)){

          $traspasos_detalle->traspaso_id = $request->input('traspaso_id')!="" ? $request->input('traspaso_id') : "";
	$traspasos_detalle->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$traspasos_detalle->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$traspasos_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

          $traspasos_detalle->save();
          return true;
      } else{
        return false;
      }
    }

    public function addTraspasos_detalle($request){
      $traspasos_detalle = new Traspasos_detalle;

        $traspasos_detalle->traspaso_id = $request->input('traspaso_id')!="" ? $request->input('traspaso_id') : "";
	$traspasos_detalle->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$traspasos_detalle->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$traspasos_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

        $traspasos_detalle->save();
        return true;
    }
}
