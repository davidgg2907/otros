<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Ventas_facturacion extends Model
{
    protected $table = 'ventas_facturacion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getVentas_facturacion($id){
      $data =  Ventas_facturacion::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getVentas_facturacionView($id){
      $ventas_facturacion = Ventas_facturacion::select(array('ventas_facturacion.*'));
      $ventas_facturacion->where('ventas_facturacion.id', $id);

      return $ventas_facturacion->get()[0];

    }

    public function updateStatus($id, $num){
      $ventas_facturacion = $this->getVentas_facturacion($id);
      if(count($ventas_facturacion)){
        $ventas_facturacion->status = $num;
        $ventas_facturacion->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $ventas_facturacion = $this->getVentas_facturacion($id);
      if(count($ventas_facturacion)){
        $img = public_path().'/uploads/'.$ventas_facturacion->featured_img;
            if($ventas_facturacion->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $ventas_facturacion->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getVentas_facturacionData($per_page, $request, $sortBy, $order){
      $ventas_facturacion = Ventas_facturacion::select(array('ventas_facturacion.*'));
      $ventas_facturacion->join('ventas','ventas.id','ventas_facturacion.venta_id');

      //join
      //join
      if($request->input('tienda_id') != "") {
        $ventas_facturacion->where('ventas.tienda_id',$request->input('tienda_id'));
      }

      if($request->input('cliente_id') != "") {
        $ventas_facturacion->where('ventas.cliente_id',$request->input('cliente_id'));
      }

      if($request->input('fecha_desde') != "" && $request->input('fecha_hasta')) {
        $ventas_facturacion->whereBetween('ventas.fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
      } elseif($request->input('fecha_desde') != "") {
        $ventas_facturacion->where('ventas.fecha',$request->input('fecha_desde'));
      } elseif($request->input('fecha_hasta') != "") {
        $ventas_facturacion->where('ventas.fecha',$request->input('fecha_hasta'));
      }

      if($request->input('tipo') != "folioml") {
        $ventas_facturacion->where('ventas.folioml','!=',"");
      } else if($request->input('tipo') != "nullfml") {
        $ventas_facturacion->where('ventas.folioml',"");
      } else if($request->input('tipo') != "folioaws") {

      }


        // sort option
        $ventas_facturacion->orderBy('ventas_facturacion.id', 'desc');

        return $ventas_facturacion->paginate($per_page);
    }

    public function getVentas_facturacionExport($request){
      $ventas_facturacion = Ventas_facturacion::select(array('ventas_facturacion.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $ventas_facturacion->where('ventas_facturacion.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $ventas_facturacion->orderBy('ventas_facturacion.id', 'desc');

        return $ventas_facturacion->get();
    }

    public function updateVentas_facturacion($request){
      $id = $request->input('id');
      $ventas_facturacion = Ventas_facturacion::getVentas_facturacion($id);
      if(count($ventas_facturacion)){

          $ventas_facturacion->id = $request->input('id')!="" ? $request->input('id') : "";
        	$ventas_facturacion->usr_id = $request->input('usr_id')!="" ? $request->input('usr_id') : "";
        	$ventas_facturacion->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
        	$ventas_facturacion->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : "";
        	$ventas_facturacion->adjunta = $request->input('adjunta')!="" ? $request->input('adjunta') : "";
        	$ventas_facturacion->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$ventas_facturacion->documento = $request->input('documento')!="" ? $request->input('documento') : "";
        	$ventas_facturacion->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
        	$ventas_facturacion->tipoc = $request->input('tipoc')!="" ? $request->input('tipoc') : "";
        	$ventas_facturacion->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
        	$ventas_facturacion->status = $request->input('status')!="" ? $request->input('status') : "";

          $ventas_facturacion->save();
          return true;
      } else{
        return false;
      }
    }

    public function addVentas_facturacion($request){
      $ventas_facturacion = new Ventas_facturacion;

        $ventas_facturacion->id = $request->input('id')!="" ? $request->input('id') : "";
      	$ventas_facturacion->usr_id = $request->input('usr_id')!="" ? $request->input('usr_id') : "";
      	$ventas_facturacion->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
      	$ventas_facturacion->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : "";
      	$ventas_facturacion->adjunta = $request->input('adjunta')!="" ? $request->input('adjunta') : "";
      	$ventas_facturacion->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$ventas_facturacion->documento = $request->input('documento')!="" ? $request->input('documento') : "";
      	$ventas_facturacion->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
      	$ventas_facturacion->tipoc = $request->input('tipoc')!="" ? $request->input('tipoc') : "";
      	$ventas_facturacion->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
      	$ventas_facturacion->status = $request->input('status')!="" ? $request->input('status') : "";

        $ventas_facturacion->save();
        return true;
    }

    public function venta(){
      return $this->hasOne('\App\admin\Ventas', 'id', 'venta_id');
    }

    public function capturista(){
      return $this->hasOne('\App\admin\Users', 'id', 'usr_id');
    }

    public function cliente(){
      return $this->hasOne('\App\admin\Clientes', 'id', 'cliente_id');
    }

    public function tienda(){
      return $this->hasOne('\App\admin\Tiendas', 'id', 'tienda_id');
    }

}
