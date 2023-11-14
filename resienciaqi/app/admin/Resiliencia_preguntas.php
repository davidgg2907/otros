<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Resiliencia_preguntas extends Model
{
    protected $table = 'resiliencia_preguntas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getResiliencia_preguntas($id){
      $data =  Resiliencia_preguntas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getResiliencia_preguntasView($id){
      $resiliencia_preguntas = Resiliencia_preguntas::select(array('resiliencia_preguntas.*'));
      $resiliencia_preguntas->where('resiliencia_preguntas.id', $id);
      
      return $resiliencia_preguntas->get()[0];

    }

    public function updateStatus($id, $num){
      $resiliencia_preguntas = $this->getResiliencia_preguntas($id);
      if(count($resiliencia_preguntas)){
        $resiliencia_preguntas->status = $num;
        $resiliencia_preguntas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $resiliencia_preguntas = $this->getResiliencia_preguntas($id);
      if(count($resiliencia_preguntas)){
        $img = public_path().'/uploads/'.$resiliencia_preguntas->featured_img;
            if($resiliencia_preguntas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $resiliencia_preguntas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getResiliencia_preguntasData($per_page, $request, $sortBy, $order){
      $resiliencia_preguntas = Resiliencia_preguntas::select(array('resiliencia_preguntas.*'));

      //join
        

        // sort option
        $resiliencia_preguntas->orderBy('resiliencia_preguntas.id', 'desc');

        return $resiliencia_preguntas->paginate($per_page);
    }

    public function updateResiliencia_preguntas($request){
      $id = $request->input('id');
      $resiliencia_preguntas = Resiliencia_preguntas::getResiliencia_preguntas($id);
      if(count($resiliencia_preguntas)){

          $resiliencia_preguntas->pregunta = $request->input('pregunta')!="" ? $request->input('pregunta') : "";
	$resiliencia_preguntas->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$resiliencia_preguntas->grupo = $request->input('grupo')!="" ? $request->input('grupo') : "";
	$resiliencia_preguntas->status = $request->input('status')!="" ? $request->input('status') : "";

          $resiliencia_preguntas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addResiliencia_preguntas($request){
      $resiliencia_preguntas = new Resiliencia_preguntas;

        $resiliencia_preguntas->pregunta = $request->input('pregunta')!="" ? $request->input('pregunta') : "";
	$resiliencia_preguntas->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$resiliencia_preguntas->grupo = $request->input('grupo')!="" ? $request->input('grupo') : "";
	$resiliencia_preguntas->status = $request->input('status')!="" ? $request->input('status') : "";

        $resiliencia_preguntas->save();
        return true;
    }
}
