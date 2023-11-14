<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Resiliencia_resultados_detalle extends Model
{
    protected $table = 'resiliencia_resultados_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getResiliencia_resultados_detalle($id){
      $data =  Resiliencia_resultados_detalle::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getResiliencia_resultados_detalleView($id){
      $resiliencia_resultados_detalle = Resiliencia_resultados_detalle::select(array('resiliencia_resultados_detalle.*'));
      $resiliencia_resultados_detalle->where('resiliencia_resultados_detalle.id', $id);
      
      return $resiliencia_resultados_detalle->get()[0];

    }

    public function updateStatus($id, $num){
      $resiliencia_resultados_detalle = $this->getResiliencia_resultados_detalle($id);
      if(count($resiliencia_resultados_detalle)){
        $resiliencia_resultados_detalle->status = $num;
        $resiliencia_resultados_detalle->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $resiliencia_resultados_detalle = $this->getResiliencia_resultados_detalle($id);
      if(count($resiliencia_resultados_detalle)){
        $img = public_path().'/uploads/'.$resiliencia_resultados_detalle->featured_img;
            if($resiliencia_resultados_detalle->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $resiliencia_resultados_detalle->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getResiliencia_resultados_detalleData($per_page, $request, $sortBy, $order){
      $resiliencia_resultados_detalle = Resiliencia_resultados_detalle::select(array('resiliencia_resultados_detalle.*'));

      //join
        

        // sort option
        $resiliencia_resultados_detalle->orderBy('resiliencia_resultados_detalle.id', 'desc');

        return $resiliencia_resultados_detalle->paginate($per_page);
    }

    public function updateResiliencia_resultados_detalle($request){
      $id = $request->input('id');
      $resiliencia_resultados_detalle = Resiliencia_resultados_detalle::getResiliencia_resultados_detalle($id);
      if(count($resiliencia_resultados_detalle)){

          $resiliencia_resultados_detalle->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$resiliencia_resultados_detalle->fechadenacimiento = $request->input('fechadenacimiento')!="" ? $request->input('fechadenacimiento') : "";
	$resiliencia_resultados_detalle->edad = $request->input('edad')!="" ? $request->input('edad') : "";
	$resiliencia_resultados_detalle->fechaaplicacion = $request->input('fechaaplicacion')!="" ? $request->input('fechaaplicacion') : "";
	$resiliencia_resultados_detalle->area = $request->input('area')!="" ? $request->input('area') : "";
	$resiliencia_resultados_detalle->organizacion = $request->input('organizacion')!="" ? $request->input('organizacion') : "";

          $resiliencia_resultados_detalle->save();
          return true;
      } else{
        return false;
      }
    }

    public function addResiliencia_resultados_detalle($request){
      $resiliencia_resultados_detalle = new Resiliencia_resultados_detalle;

        $resiliencia_resultados_detalle->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$resiliencia_resultados_detalle->fechadenacimiento = $request->input('fechadenacimiento')!="" ? $request->input('fechadenacimiento') : "";
	$resiliencia_resultados_detalle->edad = $request->input('edad')!="" ? $request->input('edad') : "";
	$resiliencia_resultados_detalle->fechaaplicacion = $request->input('fechaaplicacion')!="" ? $request->input('fechaaplicacion') : "";
	$resiliencia_resultados_detalle->area = $request->input('area')!="" ? $request->input('area') : "";
	$resiliencia_resultados_detalle->organizacion = $request->input('organizacion')!="" ? $request->input('organizacion') : "";

        $resiliencia_resultados_detalle->save();
        return true;
    }
}
