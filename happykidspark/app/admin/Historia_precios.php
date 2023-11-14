<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Historia_precios extends Model
{
    protected $table = 'historia_precios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public static function ingresaPrecio($producto,$importe,$tipo) {

      $historia_precios = new Historia_precios;

        $historia_precios->producto_id  = $producto;
      	$historia_precios->fecha        = date('Y-m-d');
        $historia_precios->precio       = $importe;
        $historia_precios->tipo         = $tipo;
      	$historia_precios->status       = 1;
        $historia_precios->save();

    }

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getHistoria_precios($id){
      $data =  Historia_precios::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getHistoria_preciosView($id){
      $historia_precios = Historia_precios::select(array('historia_precios.*'));
      $historia_precios->where('historia_precios.id', $id);

      return $historia_precios->get()[0];

    }

    public function updateStatus($id, $num){
      $historia_precios = $this->getHistoria_precios($id);
      if(count($historia_precios)){
        $historia_precios->status = $num;
        $historia_precios->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $historia_precios = $this->getHistoria_precios($id);
      if(count($historia_precios)){
        $img = public_path().'/uploads/'.$historia_precios->featured_img;
            if($historia_precios->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $historia_precios->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getHistoria_preciosData($per_page, $request, $sortBy, $order){
      $historia_precios = Historia_precios::select(array('historia_precios.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $historia_precios->where('historia_precios.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $historia_precios->where('historia_precios.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $historia_precios->where('historia_precios.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $historia_precios->orderBy('historia_precios.id', 'desc');

        return $historia_precios->paginate($per_page);
    }

    public function getHistoria_preciosExport($request){
      $historia_precios = Historia_precios::select(array('historia_precios.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $historia_precios->where('historia_precios.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $historia_precios->orderBy('historia_precios.id', 'desc');

        return $historia_precios->get();
    }

    public function updateHistoria_precios($request){
      $id = $request->input('id');
      $historia_precios = Historia_precios::getHistoria_precios($id);
      if(count($historia_precios)){

          $historia_precios->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$historia_precios->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$historia_precios->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$historia_precios->venta = $request->input('venta')!="" ? $request->input('venta') : "";
	$historia_precios->status = $request->input('status')!="" ? $request->input('status') : "";

          $historia_precios->save();
          return true;
      } else{
        return false;
      }
    }

    public function addHistoria_precios($request){
      $historia_precios = new Historia_precios;

        $historia_precios->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$historia_precios->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$historia_precios->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$historia_precios->venta = $request->input('venta')!="" ? $request->input('venta') : "";
	$historia_precios->status = $request->input('status')!="" ? $request->input('status') : "";

        $historia_precios->save();
        return true;
    }
}
