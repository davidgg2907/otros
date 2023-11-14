<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Productos_precios extends Model
{
    protected $table = 'productos_precios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getProductos_precios($id){
      $data =  Productos_precios::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getProductos_preciosView($id){
      $productos_precios = Productos_precios::select(array('productos_precios.*'));
      $productos_precios->where('productos_precios.id', $id);
      
      return $productos_precios->get()[0];

    }

    public function updateStatus($id, $num){
      $productos_precios = $this->getProductos_precios($id);
      if(count($productos_precios)){
        $productos_precios->status = $num;
        $productos_precios->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $productos_precios = $this->getProductos_precios($id);
      if(count($productos_precios)){
        $img = public_path().'/uploads/'.$productos_precios->featured_img;
            if($productos_precios->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $productos_precios->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getProductos_preciosData($per_page, $request, $sortBy, $order){
      $productos_precios = Productos_precios::select(array('productos_precios.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $productos_precios->where('productos_precios.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $productos_precios->where('productos_precios.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $productos_precios->where('productos_precios.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $productos_precios->orderBy('productos_precios.id', 'desc');

        return $productos_precios->paginate($per_page);
    }

    public function getProductos_preciosExport($request){
      $productos_precios = Productos_precios::select(array('productos_precios.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $productos_precios->where('productos_precios.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $productos_precios->orderBy('productos_precios.id', 'desc');

        return $productos_precios->get();
    }

    public function updateProductos_precios($request){
      $id = $request->input('id');
      $productos_precios = Productos_precios::getProductos_precios($id);
      if(count($productos_precios)){

          $productos_precios->id = $request->input('id')!="" ? $request->input('id') : "";
	$productos_precios->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$productos_precios->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$productos_precios->venta = $request->input('venta')!="" ? $request->input('venta') : "";
	$productos_precios->fecha_inicio = $request->input('fecha_inicio')!="" ? $request->input('fecha_inicio') : "";
	$productos_precios->fecha_termino = $request->input('fecha_termino')!="" ? $request->input('fecha_termino') : "";
	$productos_precios->status = $request->input('status')!="" ? $request->input('status') : "";

          $productos_precios->save();
          return true;
      } else{
        return false;
      }
    }

    public function addProductos_precios($request){
      $productos_precios = new Productos_precios;

        $productos_precios->id = $request->input('id')!="" ? $request->input('id') : "";
	$productos_precios->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$productos_precios->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$productos_precios->venta = $request->input('venta')!="" ? $request->input('venta') : "";
	$productos_precios->fecha_inicio = $request->input('fecha_inicio')!="" ? $request->input('fecha_inicio') : "";
	$productos_precios->fecha_termino = $request->input('fecha_termino')!="" ? $request->input('fecha_termino') : "";
	$productos_precios->status = $request->input('status')!="" ? $request->input('status') : "";

        $productos_precios->save();
        return true;
    }
}
