<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Efectivo extends Model
{
    protected $table = 'efectivo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getEfectivo($id){
      $data =  Efectivo::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getEfectivoView($id){
      $efectivo = Efectivo::select(array('efectivo.*'));
      $efectivo->where('efectivo.id', $id);
      
      return $efectivo->get()[0];

    }

    public function updateStatus($id, $num){
      $efectivo = $this->getEfectivo($id);
      if(count($efectivo)){
        $efectivo->status = $num;
        $efectivo->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $efectivo = $this->getEfectivo($id);
      if(count($efectivo)){
        $img = public_path().'/uploads/'.$efectivo->featured_img;
            if($efectivo->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $efectivo->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getEfectivoData($per_page, $request, $sortBy, $order){
      $efectivo = Efectivo::select(array('efectivo.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $efectivo->where('efectivo.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $efectivo->where('efectivo.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $efectivo->where('efectivo.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $efectivo->orderBy('efectivo.id', 'desc');

        return $efectivo->paginate($per_page);
    }

    public function getEfectivoExport($request){
      $efectivo = Efectivo::select(array('efectivo.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $efectivo->where('efectivo.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $efectivo->orderBy('efectivo.id', 'desc');

        return $efectivo->get();
    }

    public function updateEfectivo($request){
      $id = $request->input('id');
      $efectivo = Efectivo::getEfectivo($id);
      if(count($efectivo)){

          $efectivo->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$efectivo->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$efectivo->concepto = $request->input('concepto')!="" ? $request->input('concepto') : "";
	$efectivo->status = $request->input('status')!="" ? $request->input('status') : "";

          $efectivo->save();
          return true;
      } else{
        return false;
      }
    }

    public function addEfectivo($request){
      $efectivo = new Efectivo;

        $efectivo->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$efectivo->importe = $request->input('importe')!="" ? $request->input('importe') : "";
	$efectivo->concepto = $request->input('concepto')!="" ? $request->input('concepto') : "";
	$efectivo->status = $request->input('status')!="" ? $request->input('status') : "";

        $efectivo->save();
        return true;
    }
}
