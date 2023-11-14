<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Cajas extends Model
{
    protected $table = 'cajas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getCajas($id){
      $data =  Cajas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCajasView($id){
      $cajas = Cajas::select(array('cajas.*'));
      $cajas->where('cajas.id', $id);

      return $cajas->get()[0];

    }

    public function updateStatus($id, $num){
      $cajas = $this->getCajas($id);
      if(count($cajas)){
        $cajas->status = $num;
        $cajas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $cajas = $this->getCajas($id);
      if(count($cajas)){
        $img = public_path().'/uploads/'.$cajas->featured_img;
            if($cajas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $cajas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCajasData($per_page, $request, $sortBy, $order){
      $cajas = Cajas::select(array('cajas.*'));
      //join
      if($request->input('tienda_id') != "") {
        $cajas->where('user_id', $request->input('tienda_id'));
      }


      if($request->input('inicio_desde') != "" && $request->input('inicio_hasta')) {

        $inicio_desde = date('Y-m-d 00:00:00',strtotime($request->input('inicio_desde')));
        $inicio_hasta = date('Y-m-d 23:59:59',strtotime($request->input('inicio_hasta')));;
        $cajas->whereBetween('inicia',[$inicio_desde,$inicio_hasta]);

      } elseif($request->input('inicio_desde') != "") {
        $cajas->where('inicia','LIKE',$request->input('inicio_desde') . '%');
      } elseif($request->input('inicio_hasta') != "") {
        $cajas->where('inicia','LIKE',$request->input('inicio_hasta') . '%');
      }

      if($request->input('termino_desde') != "" && $request->input('termino_hasta')) {

        $termino_desde = date('Y-m-d 00:00:00',strtotime($request->input('termino_desde')));
        $termino_hasta = date('Y-m-d 23:59:59',strtotime($request->input('termino_hasta')));;
        $cajas->whereBetween('termina',[$termino_desde,$termino_hasta]);

      } elseif($request->input('termino_desde') != "") {
        $cajas->where('termina','LIKE',$request->input('termino_desde') . '%');
      } elseif($request->input('termino_hasta') != "") {
        $cajas->where('termina','LIKE',$request->input('termino_hasta') . '%');
      }
        // sort option
        $cajas->orderBy('cajas.id', 'desc');

        return $cajas->paginate($per_page);
    }

    public function getCajasExport($request){
      $cajas = Cajas::select(array('cajas.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $cajas->where('cajas.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $cajas->orderBy('cajas.id', 'desc');

        return $cajas->get();
    }

    public function updateCajas($request){
      $id = $request->input('id');
      $cajas = Cajas::getCajas($id);
      if(count($cajas)){

          $cajas->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
	$cajas->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
	$cajas->termina = $request->input('termina')!="" ? $request->input('termina') : "";
	$cajas->monto_inicial = $request->input('monto_inicial')!="" ? $request->input('monto_inicial') : "";
	$cajas->monto_final = $request->input('monto_final')!="" ? $request->input('monto_final') : "";
	$cajas->ventas = $request->input('ventas')!="" ? $request->input('ventas') : "";
	$cajas->cancelaciones = $request->input('cancelaciones')!="" ? $request->input('cancelaciones') : "";
	$cajas->temporizadores = $request->input('temporizadores')!="" ? $request->input('temporizadores') : "";
	$cajas->status = $request->input('status')!="" ? $request->input('status') : "";

          $cajas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCajas($request){
      $cajas = new Cajas;

        $cajas->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
      	$cajas->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
      	$cajas->termina = $request->input('termina')!="" ? $request->input('termina') : "";
      	$cajas->monto_inicial = $request->input('monto_inicial')!="" ? $request->input('monto_inicial') : "";
      	$cajas->monto_final = $request->input('monto_final')!="" ? $request->input('monto_final') : "";
      	$cajas->ventas = $request->input('ventas')!="" ? $request->input('ventas') : "";
      	$cajas->cancelaciones = $request->input('cancelaciones')!="" ? $request->input('cancelaciones') : "";
      	$cajas->temporizadores = $request->input('temporizadores')!="" ? $request->input('temporizadores') : "";
      	$cajas->status = $request->input('status')!="" ? $request->input('status') : "";

        $cajas->save();
        return true;
    }

    public function cajero(){
      return $this->hasOne('\App\admin\Users', 'id', 'user_id');
    }

}
