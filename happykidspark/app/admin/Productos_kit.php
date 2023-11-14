<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Productos_kit extends Model
{
    protected $table = 'productos_kit';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getProductos_kit($id){
      $data =  Productos_kit::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getProductos_kitView($id){
      $productos_kit = Productos_kit::select(array('productos_kit.*'));
      $productos_kit->where('productos_kit.id', $id);

      return $productos_kit->get()[0];

    }

    public function updateStatus($id, $num){
      $productos_kit = $this->getProductos_kit($id);
      if(count($productos_kit)){
        $productos_kit->status = $num;
        $productos_kit->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $productos_kit = $this->getProductos_kit($id);
      if(count($productos_kit)){
        $img = public_path().'/uploads/'.$productos_kit->featured_img;
            if($productos_kit->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $productos_kit->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getProductos_kitData($per_page, $request, $sortBy, $order){
      $productos_kit = Productos_kit::select(array('productos_kit.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $productos_kit->where('productos_kit.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $productos_kit->where('productos_kit.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $productos_kit->where('productos_kit.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $productos_kit->orderBy('productos_kit.id', 'desc');

        return $productos_kit->paginate($per_page);
    }

    public function getProductos_kitExport($request){
      $productos_kit = Productos_kit::select(array('productos_kit.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $productos_kit->where('productos_kit.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $productos_kit->orderBy('productos_kit.id', 'desc');

        return $productos_kit->get();
    }

    public function updateProductos_kit($request){
      $id = $request->input('id');
      $productos_kit = Productos_kit::getProductos_kit($id);
      if(count($productos_kit)){

          $productos_kit->id = $request->input('id')!="" ? $request->input('id') : "";
	$productos_kit->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$productos_kit->prod_adjunto_id = $request->input('prod_adjunto_id')!="" ? $request->input('prod_adjunto_id') : "";
	$productos_kit->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$productos_kit->precio_unit = $request->input('precio_unit')!="" ? $request->input('precio_unit') : "";
	$productos_kit->precio_paquete = $request->input('precio_paquete')!="" ? $request->input('precio_paquete') : "";
	$productos_kit->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$productos_kit->status = $request->input('status')!="" ? $request->input('status') : "";

          $productos_kit->save();
          return true;
      } else{
        return false;
      }
    }

    public function addProductos_kit($request){
      $productos_kit = new Productos_kit;

        $productos_kit->id = $request->input('id')!="" ? $request->input('id') : "";
	$productos_kit->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$productos_kit->prod_adjunto_id = $request->input('prod_adjunto_id')!="" ? $request->input('prod_adjunto_id') : "";
	$productos_kit->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$productos_kit->precio_unit = $request->input('precio_unit')!="" ? $request->input('precio_unit') : "";
	$productos_kit->precio_paquete = $request->input('precio_paquete')!="" ? $request->input('precio_paquete') : "";
	$productos_kit->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$productos_kit->status = $request->input('status')!="" ? $request->input('status') : "";

        $productos_kit->save();
        return true;
    }


    public function producto() {
      return $this->hasOne(\App\admin\Productos::class,'id','producto_id');
    }

    public function adjunto() {
      return $this->hasOne(\App\admin\Productos::class,'id','prod_adjunto_id');
    }

}
