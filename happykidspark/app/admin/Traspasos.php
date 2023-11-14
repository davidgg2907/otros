<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Traspasos extends Model
{
    protected $table = 'traspasos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getTraspasos($id){
      $data =  Traspasos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getTraspasosView($id){
      $traspasos = Traspasos::select(array('traspasos.*'));
      $traspasos->where('traspasos.id', $id);
      
      return $traspasos->get()[0];

    }

    public function updateStatus($id, $num){
      $traspasos = $this->getTraspasos($id);
      if(count($traspasos)){
        $traspasos->status = $num;
        $traspasos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $traspasos = $this->getTraspasos($id);
      if(count($traspasos)){
        $img = public_path().'/uploads/'.$traspasos->featured_img;
            if($traspasos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $traspasos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getTraspasosData($per_page, $request, $sortBy, $order){
      $traspasos = Traspasos::select(array('traspasos.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $traspasos->where('traspasos.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $traspasos->where('traspasos.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $traspasos->where('traspasos.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $traspasos->orderBy('traspasos.id', 'desc');

        return $traspasos->paginate($per_page);
    }

    public function getTraspasosExport($request){
      $traspasos = Traspasos::select(array('traspasos.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $traspasos->where('traspasos.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $traspasos->orderBy('traspasos.id', 'desc');

        return $traspasos->get();
    }

    public function updateTraspasos($request){
      $id = $request->input('id');
      $traspasos = Traspasos::getTraspasos($id);
      if(count($traspasos)){

          $traspasos->usr_envia_id = $request->input('usr_envia_id')!="" ? $request->input('usr_envia_id') : "";
	$traspasos->usr_autoriza_id = $request->input('usr_autoriza_id')!="" ? $request->input('usr_autoriza_id') : "";
	$traspasos->almacen_origen_id = $request->input('almacen_origen_id')!="" ? $request->input('almacen_origen_id') : "";
	$traspasos->almacen_destino_id = $request->input('almacen_destino_id')!="" ? $request->input('almacen_destino_id') : "";
	$traspasos->fecha_envio = $request->input('fecha_envio')!="" ? $request->input('fecha_envio') : "";
	$traspasos->fecha_autorizacion = $request->input('fecha_autorizacion')!="" ? $request->input('fecha_autorizacion') : "";
	$traspasos->status = $request->input('status')!="" ? $request->input('status') : "";

          $traspasos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addTraspasos($request){
      $traspasos = new Traspasos;

        $traspasos->usr_envia_id = $request->input('usr_envia_id')!="" ? $request->input('usr_envia_id') : "";
	$traspasos->usr_autoriza_id = $request->input('usr_autoriza_id')!="" ? $request->input('usr_autoriza_id') : "";
	$traspasos->almacen_origen_id = $request->input('almacen_origen_id')!="" ? $request->input('almacen_origen_id') : "";
	$traspasos->almacen_destino_id = $request->input('almacen_destino_id')!="" ? $request->input('almacen_destino_id') : "";
	$traspasos->fecha_envio = $request->input('fecha_envio')!="" ? $request->input('fecha_envio') : "";
	$traspasos->fecha_autorizacion = $request->input('fecha_autorizacion')!="" ? $request->input('fecha_autorizacion') : "";
	$traspasos->status = $request->input('status')!="" ? $request->input('status') : "";

        $traspasos->save();
        return true;
    }
}
