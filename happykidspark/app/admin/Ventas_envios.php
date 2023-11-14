<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Ventas_envios extends Model
{
    protected $table = 'ventas_envios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getVentas_envios($id){
      $data =  Ventas_envios::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getVentas_enviosView($id){
      $ventas_envios = Ventas_envios::select(array('ventas_envios.*'));
      $ventas_envios->where('ventas_envios.id', $id);
      
      return $ventas_envios->get()[0];

    }

    public function updateStatus($id, $num){
      $ventas_envios = $this->getVentas_envios($id);
      if(count($ventas_envios)){
        $ventas_envios->status = $num;
        $ventas_envios->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $ventas_envios = $this->getVentas_envios($id);
      if(count($ventas_envios)){
        $img = public_path().'/uploads/'.$ventas_envios->featured_img;
            if($ventas_envios->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $ventas_envios->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getVentas_enviosData($per_page, $request, $sortBy, $order){
      $ventas_envios = Ventas_envios::select(array('ventas_envios.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $ventas_envios->where('ventas_envios.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $ventas_envios->where('ventas_envios.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $ventas_envios->where('ventas_envios.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $ventas_envios->orderBy('ventas_envios.id', 'desc');

        return $ventas_envios->paginate($per_page);
    }

    public function getVentas_enviosExport($request){
      $ventas_envios = Ventas_envios::select(array('ventas_envios.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $ventas_envios->where('ventas_envios.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $ventas_envios->orderBy('ventas_envios.id', 'desc');

        return $ventas_envios->get();
    }

    public function updateVentas_envios($request){
      $id = $request->input('id');
      $ventas_envios = Ventas_envios::getVentas_envios($id);
      if(count($ventas_envios)){

          $ventas_envios->id = $request->input('id')!="" ? $request->input('id') : "";
	$ventas_envios->usr_id = $request->input('usr_id')!="" ? $request->input('usr_id') : "";
	$ventas_envios->venta_id = $request->input('venta_id')!="" ? $request->input('venta_id') : "";
	$ventas_envios->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
	$ventas_envios->forma_envio = $request->input('forma_envio')!="" ? $request->input('forma_envio') : "";
	$ventas_envios->en_camino = $request->input('en_camino')!="" ? $request->input('en_camino') : "";
	$ventas_envios->fecha_entrega = $request->input('fecha_entrega')!="" ? $request->input('fecha_entrega') : "";
	$ventas_envios->transportista = $request->input('transportista')!="" ? $request->input('transportista') : "";
	$ventas_envios->guia = $request->input('guia')!="" ? $request->input('guia') : "";
	$ventas_envios->tipo_envio = $request->input('tipo_envio')!="" ? $request->input('tipo_envio') : "";
	$ventas_envios->status = $request->input('status')!="" ? $request->input('status') : "";

          $ventas_envios->save();
          return true;
      } else{
        return false;
      }
    }

    public function addVentas_envios($request){
      $ventas_envios = new Ventas_envios;

        $ventas_envios->id = $request->input('id')!="" ? $request->input('id') : "";
	$ventas_envios->usr_id = $request->input('usr_id')!="" ? $request->input('usr_id') : "";
	$ventas_envios->venta_id = $request->input('venta_id')!="" ? $request->input('venta_id') : "";
	$ventas_envios->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
	$ventas_envios->forma_envio = $request->input('forma_envio')!="" ? $request->input('forma_envio') : "";
	$ventas_envios->en_camino = $request->input('en_camino')!="" ? $request->input('en_camino') : "";
	$ventas_envios->fecha_entrega = $request->input('fecha_entrega')!="" ? $request->input('fecha_entrega') : "";
	$ventas_envios->transportista = $request->input('transportista')!="" ? $request->input('transportista') : "";
	$ventas_envios->guia = $request->input('guia')!="" ? $request->input('guia') : "";
	$ventas_envios->tipo_envio = $request->input('tipo_envio')!="" ? $request->input('tipo_envio') : "";
	$ventas_envios->status = $request->input('status')!="" ? $request->input('status') : "";

        $ventas_envios->save();
        return true;
    }
}
