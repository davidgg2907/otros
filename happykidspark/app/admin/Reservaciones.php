<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
    protected $table = 'reservaciones';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getReservaciones($id){
      $data =  Reservaciones::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getReservacionesView($id){
      $reservaciones = Reservaciones::select(array('reservaciones.*'));
      $reservaciones->where('reservaciones.id', $id);

      return $reservaciones->get()[0];

    }

    public function updateStatus($id, $num){
      $reservaciones = $this->getReservaciones($id);
      if(count($reservaciones)){
        $reservaciones->status = $num;
        $reservaciones->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $reservaciones = $this->getReservaciones($id);
      if(count($reservaciones)){
        $img = public_path().'/uploads/'.$reservaciones->featured_img;
            if($reservaciones->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $reservaciones->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getReservacionesData($per_page, $request, $sortBy, $order){
      $reservaciones = Reservaciones::select(array('reservaciones.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $reservaciones->where('reservaciones.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $reservaciones->where('reservaciones.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $reservaciones->where('reservaciones.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $reservaciones->orderBy('reservaciones.id', 'desc');

        return $reservaciones->paginate($per_page);
    }

    public function getReservacionesExport($request){
      $reservaciones = Reservaciones::select(array('reservaciones.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $reservaciones->where('reservaciones.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $reservaciones->orderBy('reservaciones.id', 'desc');

        return $reservaciones->get();
    }

    public function updateReservaciones($request){
      $id = $request->input('id');
      $reservaciones = Reservaciones::getReservaciones($id);
      if(count($reservaciones)){

        $reservaciones->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
        $reservaciones->tiempo_id = $request->input('tiempo_id')!="" ? $request->input('tiempo_id') : "0";
        $reservaciones->productos_id = $request->input('productos')!="" ? $request->input('productos') : "0";
      	$reservaciones->banda_id = $request->input('banda_id')!="" ? $request->input('banda_id') : "0";
        $reservaciones->tutor = $request->input('tutor')!="" ? $request->input('tutor') : "";
        $reservaciones->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        $reservaciones->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "0";
      	$reservaciones->fecha_reserva = $request->input('fecha_reserva')!="" ? $request->input('fecha_reserva') : "";

          $reservaciones->save();
          return true;
      } else{
        return false;
      }
    }

    public function addReservaciones($request){
      $reservaciones = new Reservaciones;

        $reservaciones->user_id = Auth::user()->id;
      	$reservaciones->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
        $reservaciones->tiempo_id = $request->input('tiempo_id')!="" ? $request->input('tiempo_id') : "0";
        $reservaciones->productos_id = $request->input('productos')!="" ? implode(',',$request->input('productos')) : "0";
        $reservaciones->banda_id = $request->input('banda_id')!="" ? $request->input('banda_id') : "0";
      	$reservaciones->tutor = $request->input('tutor')!="" ? $request->input('tutor') : "";
        $reservaciones->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        $reservaciones->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "0";
      	$reservaciones->fecha_registro = date('Y-m-d');
      	$reservaciones->fecha_reserva = $request->input('fecha_reserva')!="" ? $request->input('fecha_reserva') : "";
      	$reservaciones->subtotal = 0;
      	$reservaciones->total = 0;
      	$reservaciones->status = 1;

        $reservaciones->save();
        return true;
    }

    public function cliente(){
      return $this->hasOne('\App\admin\Clientes', 'id', 'cliente_id');
    }

    public function user(){
      return $this->hasOne('\App\admin\Users', 'id', 'user_id');
    }

    public function tiempo(){
      return $this->hasOne('\App\admin\Tiempos', 'id', 'tiempo_id');
    }

    public function banda(){
      return $this->hasOne('\App\admin\Bandas', 'id', 'banda_id');
    }
}
