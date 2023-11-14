<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    protected $table = 'garantia';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    const SITUACIONES = array(

      '1' => 'Ingresar a almacen',

      '2' => 'Enviar a Garantia',

      '3' => 'Producto Dañado, Desechar',

      '4' => 'Reparacion',

    );

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getGarantia($id){
      $data =  Garantia::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getGarantiaView($id){
      $garantia = Garantia::select(array('garantia.*'));
      $garantia->where('garantia.id', $id);

      return $garantia->get()[0];

    }

    public function updateStatus($id, $num){
      $garantia = $this->getGarantia($id);
      if(count($garantia)){
        $garantia->status = $num;
        $garantia->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $garantia = $this->getGarantia($id);
      if(count($garantia)){
        $img = public_path().'/uploads/'.$garantia->featured_img;
            if($garantia->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $garantia->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getGarantiaData($per_page, $request, $sortBy, $order){
      $garantia = Garantia::select(array('garantia.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $garantia->where('garantia.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $garantia->where('garantia.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $garantia->where('garantia.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $garantia->orderBy('garantia.id', 'desc');

        return $garantia->paginate($per_page);
    }

    public function getGarantiaExport($request){
      $garantia = Garantia::select(array('garantia.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $garantia->where('garantia.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $garantia->orderBy('garantia.id', 'desc');

        return $garantia->get();
    }

    public function updateGarantia($request){
      $id = $request->input('id');
      $garantia = Garantia::getGarantia($id);
      if(count($garantia)){

          $garantia->venta_id = $request->input('venta_id')!="" ? $request->input('venta_id') : "";
        	$garantia->detalle_id = $request->input('detalle_id')!="" ? $request->input('detalle_id') : "";
        	$garantia->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
        	$garantia->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
        	$garantia->situacion = $request->input('situacion')!="" ? $request->input('situacion') : "";
        	$garantia->importe = $request->input('importe')!="" ? $request->input('importe') : "";
        	$garantia->motivo = $request->input('motivo')!="" ? $request->input('motivo') : "";
        	$garantia->fecha_operacion = $request->input('fecha_operacion')!="" ? $request->input('fecha_operacion') : "";
        	$garantia->fecha_alta = $request->input('fecha_alta')!="" ? $request->input('fecha_alta') : "";
        	$garantia->status = $request->input('status')!="" ? $request->input('status') : "";

          $garantia->save();
          return true;
      } else{
        return false;
      }
    }

    public function addGarantia($request){
      $garantia = new Garantia;

        $garantia->venta_id = $request->input('venta_id')!="" ? $request->input('venta_id') : "";
      	$garantia->detalle_id = $request->input('detalle_id')!="" ? $request->input('detalle_id') : "";
      	$garantia->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
      	$garantia->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
      	$garantia->situacion = $request->input('situacion')!="" ? $request->input('situacion') : "";
      	$garantia->importe = $request->input('importe')!="" ? $request->input('importe') : "";
      	$garantia->motivo = $request->input('motivo')!="" ? $request->input('motivo') : "";
      	$garantia->fecha_operacion = $request->input('fecha_operacion')!="" ? $request->input('fecha_operacion') : "";
      	$garantia->fecha_alta = $request->input('fecha_alta')!="" ? $request->input('fecha_alta') : "";
      	$garantia->status = $request->input('status')!="" ? $request->input('status') : "";

        $garantia->save();
        return true;
    }

    public function venta(){
      return $this->hasOne('\App\admin\Ventas', 'id', 'venta_id');
    }

    public function ventaDet(){
      return $this->hasOne('\App\admin\Ventas_detalle', 'id', 'detalle_id');
    }

    public function producto(){
      return $this->hasOne('\App\admin\Productos', 'id', 'producto_id');
    }

}
