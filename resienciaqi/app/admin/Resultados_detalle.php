<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Resultados_detalle extends Model
{
    protected $table = 'resultados_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getResultados_detalle($id){
      $data =  Resultados_detalle::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getResultados_detalleView($id){
      $resultados_detalle = Resultados_detalle::select(array('resultados_detalle.*'));
      $resultados_detalle->where('resultados_detalle.id', $id);
      
      return $resultados_detalle->get()[0];

    }

    public function updateStatus($id, $num){
      $resultados_detalle = $this->getResultados_detalle($id);
      if(count($resultados_detalle)){
        $resultados_detalle->status = $num;
        $resultados_detalle->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $resultados_detalle = $this->getResultados_detalle($id);
      if(count($resultados_detalle)){
        $img = public_path().'/uploads/'.$resultados_detalle->featured_img;
            if($resultados_detalle->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $resultados_detalle->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getResultados_detalleData($per_page, $request, $sortBy, $order){
      $resultados_detalle = Resultados_detalle::select(array('resultados_detalle.*'));

      //join
        

        // sort option
        $resultados_detalle->orderBy('resultados_detalle.id', 'desc');

        return $resultados_detalle->paginate($per_page);
    }

    public function updateResultados_detalle($request){
      $id = $request->input('id');
      $resultados_detalle = Resultados_detalle::getResultados_detalle($id);
      if(count($resultados_detalle)){

          $resultados_detalle->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$resultados_detalle->resultado_id = $request->input('resultado_id')!="" ? $request->input('resultado_id') : "";
	$resultados_detalle->pregunta_id = $request->input('pregunta_id')!="" ? $request->input('pregunta_id') : "";
	$resultados_detalle->respuesta_id = $request->input('respuesta_id')!="" ? $request->input('respuesta_id') : "";
	$resultados_detalle->valor = $request->input('valor')!="" ? $request->input('valor') : "";
	$resultados_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

          $resultados_detalle->save();
          return true;
      } else{
        return false;
      }
    }

    public function addResultados_detalle($request){
      $resultados_detalle = new Resultados_detalle;

        $resultados_detalle->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$resultados_detalle->resultado_id = $request->input('resultado_id')!="" ? $request->input('resultado_id') : "";
	$resultados_detalle->pregunta_id = $request->input('pregunta_id')!="" ? $request->input('pregunta_id') : "";
	$resultados_detalle->respuesta_id = $request->input('respuesta_id')!="" ? $request->input('respuesta_id') : "";
	$resultados_detalle->valor = $request->input('valor')!="" ? $request->input('valor') : "";
	$resultados_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

        $resultados_detalle->save();
        return true;
    }
}
