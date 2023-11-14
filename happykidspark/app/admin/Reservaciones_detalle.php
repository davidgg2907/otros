<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Reservaciones_detalle extends Model
{
    protected $table = 'reservaciones_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getReservaciones_detalle($id){
      $data =  Reservaciones_detalle::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getReservaciones_detalleView($id){
      $reservaciones_detalle = Reservaciones_detalle::select(array('reservaciones_detalle.*'));
      $reservaciones_detalle->where('reservaciones_detalle.id', $id);
      
      return $reservaciones_detalle->get()[0];

    }

    public function updateStatus($id, $num){
      $reservaciones_detalle = $this->getReservaciones_detalle($id);
      if(count($reservaciones_detalle)){
        $reservaciones_detalle->status = $num;
        $reservaciones_detalle->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $reservaciones_detalle = $this->getReservaciones_detalle($id);
      if(count($reservaciones_detalle)){
        $img = public_path().'/uploads/'.$reservaciones_detalle->featured_img;
            if($reservaciones_detalle->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $reservaciones_detalle->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getReservaciones_detalleData($per_page, $request, $sortBy, $order){
      $reservaciones_detalle = Reservaciones_detalle::select(array('reservaciones_detalle.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $reservaciones_detalle->where('reservaciones_detalle.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $reservaciones_detalle->where('reservaciones_detalle.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $reservaciones_detalle->where('reservaciones_detalle.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $reservaciones_detalle->orderBy('reservaciones_detalle.id', 'desc');

        return $reservaciones_detalle->paginate($per_page);
    }

    public function getReservaciones_detalleExport($request){
      $reservaciones_detalle = Reservaciones_detalle::select(array('reservaciones_detalle.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $reservaciones_detalle->where('reservaciones_detalle.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $reservaciones_detalle->orderBy('reservaciones_detalle.id', 'desc');

        return $reservaciones_detalle->get();
    }

    public function updateReservaciones_detalle($request){
      $id = $request->input('id');
      $reservaciones_detalle = Reservaciones_detalle::getReservaciones_detalle($id);
      if(count($reservaciones_detalle)){

          $reservaciones_detalle->reservacion_id = $request->input('reservacion_id')!="" ? $request->input('reservacion_id') : "";
	$reservaciones_detalle->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$reservaciones_detalle->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$reservaciones_detalle->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$reservaciones_detalle->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$reservaciones_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

          $reservaciones_detalle->save();
          return true;
      } else{
        return false;
      }
    }

    public function addReservaciones_detalle($request){
      $reservaciones_detalle = new Reservaciones_detalle;

        $reservaciones_detalle->reservacion_id = $request->input('reservacion_id')!="" ? $request->input('reservacion_id') : "";
	$reservaciones_detalle->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$reservaciones_detalle->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$reservaciones_detalle->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$reservaciones_detalle->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$reservaciones_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

        $reservaciones_detalle->save();
        return true;
    }
}
