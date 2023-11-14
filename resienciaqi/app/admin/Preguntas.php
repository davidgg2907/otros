<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    protected $table = 'preguntas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getPreguntas($id){
      $data =  Preguntas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPreguntasView($id){
      $preguntas = Preguntas::select(array('preguntas.*'));
      $preguntas->where('preguntas.id', $id);

      return $preguntas->get()[0];

    }

    public function updateStatus($id, $num){
      $preguntas = $this->getPreguntas($id);
      if(count($preguntas)){
        $preguntas->status = $num;
        $preguntas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $preguntas = $this->getPreguntas($id);
      if(count($preguntas)){
        $img = public_path().'/uploads/'.$preguntas->featured_img;
            if($preguntas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $preguntas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getPreguntasData($per_page, $request, $sortBy, $order){
      $preguntas = Preguntas::select(array('preguntas.*'));

      //join


        // sort option
        $preguntas->orderBy('preguntas.id', 'desc');

        return $preguntas->paginate($per_page);
    }

    public function updatePreguntas($request){
      $id = $request->input('id');
      $preguntas = Preguntas::getPreguntas($id);
      if(count($preguntas)){

          $preguntas->grupo_id = $request->input('grupo_id')!="" ? $request->input('grupo_id') : "";
        	$preguntas->pregunta = $request->input('pregunta')!="" ? $request->input('pregunta') : "";
        	$preguntas->status = $request->input('status')!="" ? $request->input('status') : "";

          $preguntas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPreguntas($request){
      $preguntas = new Preguntas;

        $preguntas->grupo_id = $request->input('grupo_id')!="" ? $request->input('grupo_id') : "";
      	$preguntas->pregunta = $request->input('pregunta')!="" ? $request->input('pregunta') : "";
      	$preguntas->status = $request->input('status')!="" ? $request->input('status') : "";

        $preguntas->save();
        return true;
    }

    public function grupo(){
      return $this->hasOne('\App\admin\Grupos', 'id', 'grupo_id');
    }


    public static function createQuiz() {

      $quiz = array();

      $grupos = \App\admin\Grupos::get();

      foreach($grupos as $group) {

        foreach (Preguntas::where('status',1)->where('grupo_id',$group->id)->get() as $value) {

          $ansQuiz = array();

          $quiz[$group->nombre]['preguntas'][$value->id]['id']      = $value->id;
          $quiz[$group->nombre]['preguntas'][$value->id]['nombre']  = $value->pregunta;

          foreach (Preguntas_respuestas::where('status',1)->where('pregunta_id',$value->id)->get() as $answer) {

            $quiz[$group->nombre]['preguntas'][$value->id]['id']      = $value->id;
            $quiz[$group->nombre]['preguntas'][$value->id]['nombre']  = $value->pregunta;


            $quiz[$group->nombre]['preguntas'][$value->id]['tipo']    = $answer->tipo;

            if($answer->tipo == 'O') {

              $quiz[$group->nombre]['preguntas'][$value->id]['answer_id']    = $answer->id;
              $quiz[$group->nombre]['preguntas'][$value->id]['label']        = $answer->label;

            } else {

              $quiz[$group->nombre]['preguntas'][$value->id]['answer_id']   = 0;
              $quiz[$group->nombre]['preguntas'][$value->id]['label']       = "";;


              $ansQuiz[] = array('id' => $answer->id,'title' => $answer->label);

            }

          }
          $quiz[$group->nombre]['preguntas'][$value->id]['answers'] = $ansQuiz;
        }

      }

      return $quiz;

    }


}
