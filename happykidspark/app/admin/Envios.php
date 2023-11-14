<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Envios extends Model
{
    protected $table = 'envios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getEnvios($id){
      $data =  Envios::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getEnviosView($id){
      $envios = Envios::select(array('envios.*'));
      $envios->where('envios.id', $id);

      return $envios->get()[0];

    }

    public function updateStatus($id, $num){
      $envios = $this->getEnvios($id);
      if(count($envios)){
        $envios->status = $num;
        $envios->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $envios = $this->getEnvios($id);
      if(count($envios)){
        $img = public_path().'/uploads/'.$envios->featured_img;
            if($envios->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $envios->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getEnviosData($per_page, $request, $sortBy, $order){
      $envios = Envios::select(array('envios.*'));

      //join
      //join
      if($request->input('folioml') != "") {
        $envios->join('ventas','ventas.id','envios.venta_id');
        $envios->where('folioml',$request->input('folioml'));
      }

      if($request->input('transportista') != "") {
        $envios->where('transportista',$request->input('transportista'));
      }

      if($request->input('guia') != "") {
        $envios->where('guia',$request->input('guia'));
      }

      if($request->input('tipo_envio') != "") {
        $envios->where('forma',$request->input('tipo_envio'));
      }

      if($request->input('en_camino') != "") {
        $envios->where('fecha_envio',$request->input('en_camino'));
      }

      if($request->input('fecha_entrega') != "") {
        $envios->where('fecha_entrega',$request->input('fecha_entrega'));
      }


        // sort option
        $envios->orderBy('envios.id', 'desc');

        return $envios->paginate($per_page);
    }

    public function getEnviosExport($request){
      $envios = Envios::select(array('envios.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $envios->where('envios.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $envios->orderBy('envios.id', 'desc');

        return $envios->get();
    }

    public function updateEnvios($request){
      $id = $request->input('id');
      $envios = Envios::getEnvios($id);
      if(count($envios)){

          $envios->id = $request->input('id')!="" ? $request->input('id') : "";
	$envios->usr_id = $request->input('usr_id')!="" ? $request->input('usr_id') : "";
	$envios->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
	$envios->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : "";
	$envios->folioml = $request->input('folioml')!="" ? $request->input('folioml') : "";
	$envios->publicacion = $request->input('publicacion')!="" ? $request->input('publicacion') : "";
	$envios->entrega = $request->input('entrega')!="" ? $request->input('entrega') : "";
	$envios->facturacion = $request->input('facturacion')!="" ? $request->input('facturacion') : "";
	$envios->factura_adjunto = $request->input('factura_adjunto')!="" ? $request->input('factura_adjunto') : "";
	$envios->facturado_a = $request->input('facturado_a')!="" ? $request->input('facturado_a') : "";
	$envios->documento_factura = $request->input('documento_factura')!="" ? $request->input('documento_factura') : "";
	$envios->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
	$envios->tipo_contribuyente = $request->input('tipo_contribuyente')!="" ? $request->input('tipo_contribuyente') : "";
	$envios->rfc_contribuyente = $request->input('rfc_contribuyente')!="" ? $request->input('rfc_contribuyente') : "";
	$envios->domicilio_contribuyente = $request->input('domicilio_contribuyente')!="" ? $request->input('domicilio_contribuyente') : "";
	$envios->forma_envio = $request->input('forma_envio')!="" ? $request->input('forma_envio') : "";
	$envios->en_camino = $request->input('en_camino')!="" ? $request->input('en_camino') : "";
	$envios->fecha_entrega = $request->input('fecha_entrega')!="" ? $request->input('fecha_entrega') : "";
	$envios->transportista = $request->input('transportista')!="" ? $request->input('transportista') : "";
	$envios->guia = $request->input('guia')!="" ? $request->input('guia') : "";
	$envios->tipo_envio = $request->input('tipo_envio')!="" ? $request->input('tipo_envio') : "";
	$envios->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$envios->subtotal = $request->input('subtotal')!="" ? $request->input('subtotal') : "";
	$envios->descuento = $request->input('descuento')!="" ? $request->input('descuento') : "";
	$envios->iva = $request->input('iva')!="" ? $request->input('iva') : "";
	$envios->total = $request->input('total')!="" ? $request->input('total') : "";
	$envios->status = $request->input('status')!="" ? $request->input('status') : "";

          $envios->save();
          return true;
      } else{
        return false;
      }
    }

    public function addEnvios($request){
      $envios = new Envios;

        $envios->id = $request->input('id')!="" ? $request->input('id') : "";
      	$envios->usr_id = $request->input('usr_id')!="" ? $request->input('usr_id') : "";
      	$envios->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
      	$envios->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : "";
      	$envios->folioml = $request->input('folioml')!="" ? $request->input('folioml') : "";
      	$envios->publicacion = $request->input('publicacion')!="" ? $request->input('publicacion') : "";
      	$envios->entrega = $request->input('entrega')!="" ? $request->input('entrega') : "";
      	$envios->facturacion = $request->input('facturacion')!="" ? $request->input('facturacion') : "";
      	$envios->factura_adjunto = $request->input('factura_adjunto')!="" ? $request->input('factura_adjunto') : "";
      	$envios->facturado_a = $request->input('facturado_a')!="" ? $request->input('facturado_a') : "";
      	$envios->documento_factura = $request->input('documento_factura')!="" ? $request->input('documento_factura') : "";
      	$envios->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
      	$envios->tipo_contribuyente = $request->input('tipo_contribuyente')!="" ? $request->input('tipo_contribuyente') : "";
      	$envios->rfc_contribuyente = $request->input('rfc_contribuyente')!="" ? $request->input('rfc_contribuyente') : "";
      	$envios->domicilio_contribuyente = $request->input('domicilio_contribuyente')!="" ? $request->input('domicilio_contribuyente') : "";
      	$envios->forma_envio = $request->input('forma_envio')!="" ? $request->input('forma_envio') : "";
      	$envios->en_camino = $request->input('en_camino')!="" ? $request->input('en_camino') : "";
      	$envios->fecha_entrega = $request->input('fecha_entrega')!="" ? $request->input('fecha_entrega') : "";
      	$envios->transportista = $request->input('transportista')!="" ? $request->input('transportista') : "";
      	$envios->guia = $request->input('guia')!="" ? $request->input('guia') : "";
      	$envios->tipo_envio = $request->input('tipo_envio')!="" ? $request->input('tipo_envio') : "";
      	$envios->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
      	$envios->subtotal = $request->input('subtotal')!="" ? $request->input('subtotal') : "";
      	$envios->descuento = $request->input('descuento')!="" ? $request->input('descuento') : "";
      	$envios->iva = $request->input('iva')!="" ? $request->input('iva') : "";
      	$envios->total = $request->input('total')!="" ? $request->input('total') : "";
      	$envios->status = $request->input('status')!="" ? $request->input('status') : "";

        $envios->save();
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
