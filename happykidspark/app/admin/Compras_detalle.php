<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Compras_detalle extends Model
{
    protected $table = 'compras_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getCompras_detalle($id){
      $data =  Compras_detalle::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCompras_detalleView($id){
      $compras_detalle = Compras_detalle::select(array('compras_detalle.*'));
      $compras_detalle->where('compras_detalle.id', $id);
      
      return $compras_detalle->get()[0];

    }

    public function updateStatus($id, $num){
      $compras_detalle = $this->getCompras_detalle($id);
      if(count($compras_detalle)){
        $compras_detalle->status = $num;
        $compras_detalle->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $compras_detalle = $this->getCompras_detalle($id);
      if(count($compras_detalle)){
        $img = public_path().'/uploads/'.$compras_detalle->featured_img;
            if($compras_detalle->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $compras_detalle->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCompras_detalleData($per_page, $request, $sortBy, $order){
      $compras_detalle = Compras_detalle::select(array('compras_detalle.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $compras_detalle->where('compras_detalle.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $compras_detalle->where('compras_detalle.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $compras_detalle->where('compras_detalle.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $compras_detalle->orderBy('compras_detalle.id', 'desc');

        return $compras_detalle->paginate($per_page);
    }

    public function getCompras_detalleExport($request){
      $compras_detalle = Compras_detalle::select(array('compras_detalle.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $compras_detalle->where('compras_detalle.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $compras_detalle->orderBy('compras_detalle.id', 'desc');

        return $compras_detalle->get();
    }

    public function updateCompras_detalle($request){
      $id = $request->input('id');
      $compras_detalle = Compras_detalle::getCompras_detalle($id);
      if(count($compras_detalle)){

          $compras_detalle->compra_id = $request->input('compra_id')!="" ? $request->input('compra_id') : "";
	$compras_detalle->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$compras_detalle->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$compras_detalle->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$compras_detalle->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$compras_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

          $compras_detalle->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCompras_detalle($request){
      $compras_detalle = new Compras_detalle;

        $compras_detalle->compra_id = $request->input('compra_id')!="" ? $request->input('compra_id') : "";
	$compras_detalle->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$compras_detalle->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$compras_detalle->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$compras_detalle->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$compras_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

        $compras_detalle->save();
        return true;
    }
}
