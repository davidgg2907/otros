<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getCompras($id){
      $data =  Compras::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getComprasView($id){
      $compras = Compras::select(array('compras.*'));
      $compras->where('compras.id', $id);

      return $compras->get()[0];

    }

    public function updateStatus($id, $num){
      $compras = $this->getCompras($id);
      if(count($compras)){
        $compras->status = $num;
        $compras->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $compras = $this->getCompras($id);
      if(count($compras)){
        $img = public_path().'/uploads/'.$compras->featured_img;
            if($compras->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $compras->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getComprasData($per_page, $request, $sortBy, $order){
      $compras = Compras::select(array('compras.*'));

      //join


        if($request->input('proveedor_id') != "") {
          $compras->where('compras.proveedor_id', $request->input('proveedor_id'));
        }

        if($request->input('fecha_desde') != "" && $request->input('fecha_hasta')) {
          $compras->whereBetween('fecha_compra',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
        } elseif($request->input('fecha_desde') != "") {
          $compras->where('fecha_compra',$request->input('fecha_desde'));
        } elseif($request->input('fecha_hasta') != "") {
          $compras->where('fecha_compra',$request->input('fecha_hasta'));
        }

        // sort option
        $compras->orderBy('compras.id', 'desc');

        return $compras->paginate($per_page);
    }

    public function getComprasExport($request){
      $compras = Compras::select(array('compras.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $compras->where('compras.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $compras->orderBy('compras.id', 'desc');

        return $compras->get();
    }

    public function updateCompras($request){
      $id = $request->input('id');
      $compras = Compras::getCompras($id);
      if(count($compras)){

        $compras->user_id = Auth::user()->id;
      	$compras->proveedor_id = $request->input('proveedor_id')!="" ? $request->input('proveedor_id') : "";
      	$compras->fecha_compra = $request->input('fecha_compra')!="" ? $request->input('fecha_compra') : "";
      	$compras->subtotal = $request->input('subtotal')!="" ? $request->input('subtotal') : "";
      	$compras->impuestos = $request->input('impuestos')!="" ? $request->input('impuestos') : "";
      	$compras->total = $request->input('total')!="" ? $request->input('total') : "";
      	$compras->status = 1;

        $compras->save();

        foreach($request->input('compras') as $lista) {

          $detallado = new Compras_detalle;

          $detallado->compra_id    = $compras->id;
        	$detallado->producto_id  = $lista['producto_id'];
        	$detallado->cantidad     = $lista['cantidad'];
        	$detallado->precio       = $lista['precio'];
        	$detallado->importe      = $lista['importe'];
        	$detallado->status       = 1;
          $detallado->save();

        }

        return true;

      } else{
        return false;
      }
    }

    public function addCompras($request){

      $compras = new Compras;

      $compras->user_id       = Auth::user()->id;
      $compras->proveedor_id  = $request->input('proveedor_id')!="" ? $request->input('proveedor_id') : "";
      $compras->fecha_compra  = $request->input('fecha_compra')!="" ? $request->input('fecha_compra') : "";
      $compras->subtotal      = $request->input('subtotal')!="" ? $request->input('subtotal') : "";
      $compras->impuestos     = $request->input('impuestos')!="" ? $request->input('impuestos') : "";
      $compras->total         = $request->input('total')!="" ? $request->input('total') : "";
      $compras->status = 1;

      $compras->save();

      foreach($request->input('compras') as $lista) {

        $detallado = new Compras_detalle;

        $detallado->compra_id    = $compras->id;
        $detallado->producto_id  = $lista['producto_id'];
        $detallado->cantidad     = $lista['cantidad'];
        $detallado->precio       = $lista['precio'];
        $detallado->importe      = $lista['importe'];
        $detallado->status       = 1;
        $detallado->save();

        //Ingresamos del almacen destino
        $destino  = array(
          'producto_id'   => $lista['producto_id'],
          'operacion'     => 'S',
          'cantidad'      => $lista['cantidad'],
          'motivo'        => 'Compra de producto, folio <a href="' . url('admin/compras/view/' . $compras->id) . '"> # ' . $compras->id . '</a>',

        );

        \App\admin\Inventario::inventariar($destino);

      }
      return true;
    }

    public function proveedor(){
      return $this->hasOne('\App\admin\Proveedores', 'id', 'proveedor_id');
    }

}
