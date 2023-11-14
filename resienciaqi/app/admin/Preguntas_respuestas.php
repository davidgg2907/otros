<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Preguntas_respuestas extends Model
{
    protected $table = 'preguntas_respuestas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getPreguntas_respuestas($id){
      $data =  Preguntas_respuestas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPreguntas_respuestasView($id){
      $preguntas_respuestas = Preguntas_respuestas::select(array('preguntas_respuestas.*'));
      $preguntas_respuestas->where('preguntas_respuestas.id', $id);
      
      return $preguntas_respuestas->get()[0];

    }

    public function updateStatus($id, $num){
      $preguntas_respuestas = $this->getPreguntas_respuestas($id);
      if(count($preguntas_respuestas)){
        $preguntas_respuestas->status = $num;
        $preguntas_respuestas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $preguntas_respuestas = $this->getPreguntas_respuestas($id);
      if(count($preguntas_respuestas)){
        $img = public_path().'/uploads/'.$preguntas_respuestas->featured_img;
            if($preguntas_respuestas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $preguntas_respuestas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getPreguntas_respuestasData($per_page, $request, $sortBy, $order){
      $preguntas_respuestas = Preguntas_respuestas::select(array('preguntas_respuestas.*'));

      //join
        

        // sort option
        $preguntas_respuestas->orderBy('preguntas_respuestas.id', 'desc');

        return $preguntas_respuestas->paginate($per_page);
    }

    public function updatePreguntas_respuestas($request){
      $id = $request->input('id');
      $preguntas_respuestas = Preguntas_respuestas::getPreguntas_respuestas($id);
      if(count($preguntas_respuestas)){

          $preguntas_respuestas->pregunta_id = $request->input('pregunta_id')!="" ? $request->input('pregunta_id') : "";
	$preguntas_respuestas->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$preguntas_respuestas->valor = $request->input('valor')!="" ? $request->input('valor') : "";
	$preguntas_respuestas->label = $request->input('label')!="" ? $request->input('label') : "";
	$preguntas_respuestas->status = $request->input('status')!="" ? $request->input('status') : "";

          $preguntas_respuestas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPreguntas_respuestas($request){
      $preguntas_respuestas = new Preguntas_respuestas;

        $preguntas_respuestas->pregunta_id = $request->input('pregunta_id')!="" ? $request->input('pregunta_id') : "";
	$preguntas_respuestas->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$preguntas_respuestas->valor = $request->input('valor')!="" ? $request->input('valor') : "";
	$preguntas_respuestas->label = $request->input('label')!="" ? $request->input('label') : "";
	$preguntas_respuestas->status = $request->input('status')!="" ? $request->input('status') : "";

        $preguntas_respuestas->save();
        return true;
    }
}
