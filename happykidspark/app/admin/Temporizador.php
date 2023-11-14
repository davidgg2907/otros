<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Temporizador extends Model
{
    protected $table = 'temporizador';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getTemporizador($id){
      $data =  Temporizador::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getTemporizadorView($id){
      $temporizador = Temporizador::select(array('temporizador.*'));
      $temporizador->where('temporizador.id', $id);

      return $temporizador->get()[0];

    }

    public function updateStatus($id, $num){
      $temporizador = $this->getTemporizador($id);
      if(count($temporizador)){
        $temporizador->status = $num;
        $temporizador->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $temporizador = $this->getTemporizador($id);
      if(count($temporizador)){
        $img = public_path().'/uploads/'.$temporizador->featured_img;
            if($temporizador->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $temporizador->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getTemporizadorData($per_page, $request, $sortBy, $order){
      $temporizador = Temporizador::select(array('temporizador.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $temporizador->where('temporizador.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $temporizador->where('temporizador.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $temporizador->where('temporizador.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $temporizador->orderBy('temporizador.id', 'desc');

        return $temporizador->paginate($per_page);
    }

    public function getTemporizadorExport($request){
      $temporizador = Temporizador::select(array('temporizador.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $temporizador->where('temporizador.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $temporizador->orderBy('temporizador.id', 'desc');

        return $temporizador->get();
    }

    public function updateTemporizador($request){
      $id = $request->input('id');
      $temporizador = Temporizador::getTemporizador($id);
      if(count($temporizador)){

          $temporizador->venta_id = $request->input('venta_id')!="" ? $request->input('venta_id') : "";
	$temporizador->vtadetalle_id = $request->input('vtadetalle_id')!="" ? $request->input('vtadetalle_id') : "";
	$temporizador->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
	$temporizador->tiempo_id = $request->input('tiempo_id')!="" ? $request->input('tiempo_id') : "";
	$temporizador->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$temporizador->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
	$temporizador->termina = $request->input('termina')!="" ? $request->input('termina') : "";
	$temporizador->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$temporizador->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$temporizador->qr = $request->input('qr')!="" ? $request->input('qr') : "";
	$temporizador->barras = $request->input('barras')!="" ? $request->input('barras') : "";
	$temporizador->status = $request->input('status')!="" ? $request->input('status') : "";

          $temporizador->save();
          return true;
      } else{
        return false;
      }
    }

    public function addTemporizador($request){
      $temporizador = new Temporizador;

        $temporizador->venta_id = $request->input('venta_id')!="" ? $request->input('venta_id') : "";
	$temporizador->vtadetalle_id = $request->input('vtadetalle_id')!="" ? $request->input('vtadetalle_id') : "";
	$temporizador->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
	$temporizador->tiempo_id = $request->input('tiempo_id')!="" ? $request->input('tiempo_id') : "";
	$temporizador->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$temporizador->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
	$temporizador->termina = $request->input('termina')!="" ? $request->input('termina') : "";
	$temporizador->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$temporizador->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$temporizador->qr = $request->input('qr')!="" ? $request->input('qr') : "";
	$temporizador->barras = $request->input('barras')!="" ? $request->input('barras') : "";
	$temporizador->status = $request->input('status')!="" ? $request->input('status') : "";

        $temporizador->save();
        return true;
    }

    public function banda(){
      return $this->hasOne('\App\admin\Bandas', 'id', 'banda_id');
    }

    public function producto(){
      return $this->hasOne('\App\admin\Productos', 'id', 'producto_id');
    }

    public function detallevta(){
      return $this->hasOne('\App\admin\Venta_detalle', 'id', 'vtadetalle_id');
    }

    public function tiempo(){
      return $this->hasOne('\App\admin\Tiempos', 'id', 'tiempo_id');
    }
}
