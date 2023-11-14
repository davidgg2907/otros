<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;


class ResultadosDetalle extends Model
{
    protected $table = 'resultados_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

}


class Resultados extends Model
{
    protected $table = 'resultados';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getResultados($id){
      $data =  Resultados::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getResultadosView($id){
      $resultados = Resultados::select(array('resultados.*'));
      $resultados->where('resultados.id', $id);

      return $resultados->get()[0];

    }

    public function updateStatus($id, $num){
      $resultados = $this->getResultados($id);
      if(count($resultados)){
        $resultados->status = $num;
        $resultados->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $resultados = $this->getResultados($id);
      if(count($resultados)){
        $img = public_path().'/uploads/'.$resultados->featured_img;
            if($resultados->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $resultados->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getResultadosData($per_page, $request, $sortBy, $order){
      $resultados = Resultados::select(array('resultados.*'));

      //join


        // sort option
        $resultados->orderBy('resultados.id', 'desc');

        return $resultados->paginate($per_page);
    }

    public function updateResultados($request){
      $id = $request->input('id');
      $resultados = Resultados::getResultados($id);
      if(count($resultados)){

          $resultados->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
        	$resultados->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
        	$resultados->delegacion_id = $request->input('delegacion_id')!="" ? $request->input('delegacion_id') : "";
        	$resultados->area_id = $request->input('area_id')!="" ? $request->input('area_id') : "";
        	$resultados->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
        	$resultados->status = $request->input('status')!="" ? $request->input('status') : "";

          $resultados->save();
          return true;
      } else{
        return false;
      }
    }

    public function addResultados($request){
      $resultados = new Resultados;

        $resultados->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
      	$resultados->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
      	$resultados->delegacion_id = $request->input('delegacion_id')!="" ? $request->input('delegacion_id') : "";
      	$resultados->area_id = $request->input('area_id')!="" ? $request->input('area_id') : "";
      	$resultados->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
      	$resultados->status = $request->input('status')!="" ? $request->input('status') : "";

        $resultados->save();
        return true;
    }

    public static function bebedores($delegacion,$area) {

      $queryBebedores = ResultadosDetalle::join('resultados','resultados.id','resultados_detalle.resultado_id')
                                    ->join('pacientes','pacientes.id','resultados.paciente_id')
                                    ->where('resultados_detalle.pregunta_id',124)
                                    ->where('resultados_detalle.valor',554);

     $queryNobebedores = ResultadosDetalle::join('resultados','resultados.id','resultados_detalle.resultado_id')
                                   ->join('pacientes','pacientes.id','resultados.paciente_id')
                                   ->where('resultados_detalle.pregunta_id',124)
                                   ->where('resultados_detalle.valor',553);

      if($delegacion != 0) {

        $queryBebedores->where('resultados_detalle.delegacion_id',$delegacion);
        $queryNobebedores->where('resultados_detalle.delegacion_id',$delegacion);

      } elseif($area != 0) {

        $queryBebedores->where('resultados_detalle.area_id',$area);
        $queryNobebedores->where('resultados_detalle.area_id',$area);

      }

      $bebedores    = $queryBebedores->count();
      $nobebedores  = $queryNobebedores->count();

      $resultados['bebedores']     = $bebedores;

      $resultados['nobebedores']   = $nobebedores;

      return $resultados;

    }

    public static function fumadores($delegacion,$area) {

      $queryFumadores = ResultadosDetalle::join('resultados','resultados.id','resultados_detalle.resultado_id')
                                    ->join('pacientes','pacientes.id','resultados.paciente_id')
                                    ->where('resultados_detalle.pregunta_id',120)
                                    ->where('resultados_detalle.valor',549);

     $queryNofumadores = ResultadosDetalle::join('resultados','resultados.id','resultados_detalle.resultado_id')
                                   ->join('pacientes','pacientes.id','resultados.paciente_id')
                                   ->where('resultados_detalle.pregunta_id',120)
                                   ->where('resultados_detalle.valor',548);

     if($delegacion != 0) {

       $queryFumadores->where('resultados_detalle.delegacion_id',$delegacion);
       $queryNofumadores->where('resultados_detalle.delegacion_id',$delegacion);

     } elseif($area != 0) {

       $queryFumadores->where('resultados_detalle.area_id',$area);
       $queryNofumadores->where('resultados_detalle.area_id',$area);

     }

     $fumadores    = $queryFumadores->count();
     $nofumadores  = $queryNofumadores->count();

      $resultados['fumadores']     = $fumadores;

      $resultados['nofumadores']   = $nofumadores;

     return $resultados;

    }

    public static function promedioPreguntas($delegacion,$area,$pregunta) {


      $queryPromedio = ResultadosDetalle::join('resultados','resultados.id','resultados_detalle.resultado_id')
                                    ->join('pacientes','pacientes.id','resultados.paciente_id')
                                    ->where('resultados_detalle.pregunta_id',$pregunta)
                                    ->where('resultados_detalle.valor','!=',null);


      if($delegacion != 0) {
        $queryPromedio->where('pacientes.delegacion_id',$delegacion);
      } elseif($area != 0) {
        $queryPromedio->where('pacientes.area_id',$area);
      }

      $promedio = $queryPromedio->count();

      return $promedio;

    }

    public static function promedioPreguntasRespuestas($delegacion,$area,$pregunta,$respuesta) {


      $queryPromedio = ResultadosDetalle::join('resultados','resultados.id','resultados_detalle.resultado_id')
                                    ->join('pacientes','pacientes.id','resultados.paciente_id')
                                    ->where('resultados_detalle.pregunta_id',$pregunta)
                                    ->where('resultados_detalle.valor',$respuesta);


      if($delegacion != 0) {
        $queryPromedio->where('pacientes.delegacion_id',$delegacion);
      } elseif($area != 0) {
        $queryPromedio->where('pacientes.area_id',$area);
      }

      $promedio = $queryPromedio->count();

      return $promedio;

    }

    public function delegacion() {

      return $this->hasOne('\App\admin\Delegaciones', 'id', 'delegacion_id');

    }

    public function area() {

      return $this->hasOne('\App\admin\Areas', 'id', 'area_id');

    }

    public function paciente() {

      return $this->hasOne('\App\admin\Pacientes', 'id', 'paciente_id');

    }


    public function resultadosGeneral($rst_id) {

      $groups = \App\admin\Grupos::get();

      $results = array();

      foreach($groups as $group) {

        $rst = ResultadosDetalle::select('preguntas.*','preguntas_respuestas.label')
                              ->join('preguntas','preguntas.id','resultados_detalle.pregunta_id')
                              ->join('preguntas_respuestas','resultados_detalle.respuesta_id','preguntas_respuestas.id') 
                              ->where('resultados_detalle.resultado_id',$rst_id)
                              ->where('preguntas.grupo_id',$group->id) 
                              ->get();

         foreach($rst as $resultSet) {

           $results[$group->nombre][] = array(
            'pregunta'  => $resultSet->pregunta,
            
            'respuesta' => $resultSet->label,
           
          );

         }           

      }      

      return $results;

    }

    public function resultadosResilencia($rst_id) {

      $groups = \App\admin\Resiliencia_preguntas::select('grupo')->groupBy('grupo')->get();

      $results = array();

      foreach($groups as $group) {

        $rst = ResultadosDetalle::select('resiliencia_preguntas.*','resultados_detalle.valor')
                              ->join('resiliencia_preguntas','resiliencia_preguntas.id','resultados_detalle.pregunta_id')
                              ->where('resultados_detalle.resultado_id',$rst_id)
                              ->where('resiliencia_preguntas.grupo',$group->grupo) 
                              ->get();

         foreach($rst as $resultSet) {

           $results[$group->grupo][] = array(
            'pregunta'  => $resultSet->pregunta,
            
            'respuesta' => $resultSet->valor,
           
          );

         }           

      }      

      return $results;

    }

    public static function graficaEscalas($escala,$delegacion,$area_id =0) {

      $escala_valores = array();
      
      //Buscamos los resultados de este grupo y los contamos
      $preguntas_valor =  \App\admin\Resultados_detalle::select(DB::Raw('AVG(preguntas_respuestas.valor) AS promedio, grupos.nombre'))
                                                       ->join('resultados','resultados_detalle.resultado_id','resultados.id') 
                                                       ->join('preguntas_respuestas','preguntas_respuestas.id','resultados_detalle.respuesta_id')
                                                       ->join('preguntas','preguntas.id','preguntas_respuestas.pregunta_id')
                                                       ->join('grupos','grupos.id','preguntas.grupo_id')
                                                       ->where('grupos.escala',$escala)
                                                       ->where('resultados.tipo','general')
                                                       ->groupBy('grupos.nombre');
                                                       



      if($delegacion != 0) { $preguntas_valor->where('resultados_detalle.delegacion_id',$delegacion);

      } else if($area != 0) { $preguntas_valor->where('resultados_detalle.area_id',$area_id); } 

      $valores = $preguntas_valor->get(); 

      foreach($valores as $values) {
        $escala_valores[$values->nombre] = $values->promedio;
      }

      return $escala_valores;
    }

    public static function graficaGruposAreas($grupo_id,$delegacion) {

      $escala_valores = array();
      
      //Buscamos los resultados de este grupo y los contamos
      $preguntas_valor =  \App\admin\Resultados_detalle::select(DB::Raw('AVG(preguntas_respuestas.valor) AS promedio,areas.nombre'))
                                                       ->join('areas','areas.id','resultados_detalle.area_id')
                                                       ->join('resultados','resultados_detalle.resultado_id','resultados.id') 
                                                       ->join('preguntas_respuestas','preguntas_respuestas.id','resultados_detalle.respuesta_id')
                                                       ->join('preguntas','preguntas.id','preguntas_respuestas.pregunta_id')                                                      
                                                       ->where('preguntas.grupo_id',$grupo_id)
                                                       ->where('resultados.tipo','general')
                                                       ->groupBy('areas.nombre');
                                                       



      if($delegacion != 0) { $preguntas_valor->where('resultados_detalle.delegacion_id',$delegacion);

      } else if($area != 0) { $preguntas_valor->where('resultados_detalle.area_id',$area_id); } 

      $valores = $preguntas_valor->get(); 

      foreach($valores as $values) {
        $escala_valores[$values->nombre] = $values->promedio;
      }

      return $escala_valores;
    }

    public static function ponenciaPacientes($delegacion,$area_id=0) {

      $grupo          = array();
      $quemarse       = array();
      $riesgos        = array();
      $consecuencias  = array();
      $tables         = array();

      //Obtenemos las escala 1 de grupo
      foreach(\App\admin\Grupos::where('status',1)->where('escala',1)->orderBy('id','ASC')->get() as $group) {

        $preguntas_valor =  \App\admin\Resultados_detalle::select(DB::Raw('AVG(preguntas_respuestas.valor) AS promedio,pacientes.nombre,resultados.id'))
                                                       ->join('resultados','resultados_detalle.resultado_id','resultados.id') 
                                                       ->join('preguntas_respuestas','preguntas_respuestas.id','resultados_detalle.respuesta_id')
                                                       ->join('pacientes','pacientes.id','resultados.paciente_id')
                                                       ->join('preguntas','preguntas.id','preguntas_respuestas.pregunta_id')
                                                       ->where('resultados.tipo','general')
                                                       ->groupBy('pacientes.nombre','resultados.id')
                                                       ->where('preguntas.grupo_id',$group->id);

        if($delegacion != 0) { 
          $preguntas_valor->where('resultados_detalle.delegacion_id',$delegacion);
        } else if($area_id != 0) { 
          $preguntas_valor->where('resultados_detalle.area_id',$area_id); 
        }
  
        $valores = $preguntas_valor->get(); 
        
        $indice  = 1;
        $alto    = 0;
        $bajo    = 0;
        foreach($valores as $values) {

          $quemarse[$group->nombre]['detalle'][] = array(

            'participante'  => 'P' . $indice,
            'paciente'      => $values->paciente_id,
            'promedio'      => $values->promedio,

          );  

          $tables[$group->nombre][] = array(

            'participante'  => 'P' . $indice,
            'paciente'      => $values->nombre,
            'resultado_id'  => $values->id,
            'promedio'      => $values->promedio,

          );

          if($group->nombre == "ILUSION_POR_EL_TRABAJO") {

            if($values->promedio > 1.9) {
              $alto++;
              $altobg = 'green';
              $altolabel = 'ALTA';
            } else {
              $bajo++;
              $bajobg = 'red';
              $bajolabel = 'BAJA';
            }

          } else {
            if($values->promedio <= 1.9) {
              $bajo++;
              $bajobg = 'green';
              $bajolabel = 'ALTA';
            } else {
              $alto++;
              $altobg = 'red';
              $altolabel = 'BAJA';
            }
          }
                                              
          $quemarse[$group->nombre]['total']      = $indice;
          $quemarse[$group->nombre]['alto']       = round(($bajo / $indice * 100),0);
          $quemarse[$group->nombre]['bajo']       = round(($alto / $indice * 100),0);
          $quemarse[$group->nombre]['altobg']     = $bajobg;
          $quemarse[$group->nombre]['bajobg']     = $altobg;
          $quemarse[$group->nombre]['altolabel']  = $altolabel;
          $quemarse[$group->nombre]['bajolabel']  = $bajolabel;

          $indice++;

        }
        
      }

      //Obtenemos las escala 2 de grupo
      foreach(\App\admin\Grupos::where('status',1)->where('escala',2)->orderBy('id','ASC')->get() as $group) {

        $preguntas_valor =  \App\admin\Resultados_detalle::select(DB::Raw('AVG(preguntas_respuestas.valor) AS promedio,pacientes.nombre,resultados.id'))
                                                         ->join('resultados','resultados_detalle.resultado_id','resultados.id') 
                                                         ->join('preguntas_respuestas','preguntas_respuestas.id','resultados_detalle.respuesta_id')
                                                         ->join('pacientes','pacientes.id','resultados.paciente_id')
                                                         ->join('preguntas','preguntas.id','preguntas_respuestas.pregunta_id')
                                                         ->where('resultados.tipo','general')
                                                         ->groupBy('pacientes.nombre','resultados.id')
                                                         ->where('preguntas.grupo_id',$group->id);

        if($delegacion != 0) { 
          $preguntas_valor->where('resultados_detalle.delegacion_id',$delegacion);
        } else if($area_id != 0) { 
          $preguntas_valor->where('resultados_detalle.area_id',$area_id); 
        } 
  
        $valores = $preguntas_valor->get();

        $indice  = 1;
        $alto    = 0;
        $bajo    = 0;
        $medio   = 0;
        foreach($valores as $values) {

          $riesgos[$group->nombre]['detalle'][] = array(

            'participante'  => 'P' . $indice,
            'paciente'      => $values->paciente_id,
            'promedio'      => $values->promedio,

          );

          $tables[$group->nombre][] = array(

            'participante'  => 'P' . $indice,
            'paciente'      => $values->nombre,
            'resultado_id'  => $values->id,
            'promedio'      => $values->promedio,

          );

          if(in_array($group->nombre,array('AUTONOMIA','APOYO_SOCIAL','FEEDBACK','RECURSOS','AUTO_EFICACIA'))) {

            if($values->promedio <= 1.5) {
              $alto++;
              $altobg = "red";
              $altolabel = "BAJA";
            }elseif($values->promedio >= 1.6 && $values->promedio <= 1.9) {
              $medio++;
              $mediobg = "yellow";
              $mediobg  = "MEDIA";
            } else {
              $bajo++;
              $bajobg = "green";
              $bajolabel = "ALTA";
            }

          } else {

            if($values->promedio <= 1.5) {
              $bajo++;
              $bajobg = "green";
              $bajolabel = "BAJO";
            }elseif($values->promedio >= 1.6 && $values->promedio <= 2) {
              $medio++;
              $mediobg = "yellow";
              $mediolabel  = "MEDIA";
            } else {
              $alto++;
              $altobg = "red";
              $altolabel = "ALTA";
            }

          }                                    
          
          $riesgos[$group->nombre]['total']       = $indice;
          $riesgos[$group->nombre]['alto']        = round(($alto / $indice * 100));
          $riesgos[$group->nombre]['altobg']      = $altobg; 
          $riesgos[$group->nombre]['medio']       = round(($medio / $indice * 100));
          $riesgos[$group->nombre]['mediobg']     = $mediobg; 
          $riesgos[$group->nombre]['bajo']        = round(($bajo / $indice * 100));
          $riesgos[$group->nombre]['bajobg']      = $bajobg;
          $riesgos[$group->nombre]['mediolabel']  = $mediolabel;
          $riesgos[$group->nombre]['altolabel']   = $altolabel;
          $riesgos[$group->nombre]['bajolabel']   = $bajolabel;

          $indice++;

        }
        
      }

      //Obtenemos las escala 3 de grupo
      foreach(\App\admin\Grupos::where('status',1)->where('escala',3)->orderBy('id','ASC')->get() as $group) {

        $preguntas_valor =  \App\admin\Resultados_detalle::select(DB::Raw('AVG(preguntas_respuestas.valor) AS promedio,pacientes.nombre,resultados.id'))
                                                          ->join('resultados','resultados_detalle.resultado_id','resultados.id') 
                                                          ->join('preguntas_respuestas','preguntas_respuestas.id','resultados_detalle.respuesta_id')
                                                          ->join('pacientes','pacientes.id','resultados.paciente_id')
                                                          ->join('preguntas','preguntas.id','preguntas_respuestas.pregunta_id')
                                                          ->where('resultados.tipo','general')
                                                          ->groupBy('pacientes.nombre','resultados.id')
                                                          ->where('preguntas.grupo_id',$group->id);

        if($delegacion != 0) { 
          $preguntas_valor->where('resultados_detalle.delegacion_id',$delegacion);
        } else if($area_id != 0) { 
          $preguntas_valor->where('resultados_detalle.area_id',$area_id); 
        } 
  
        $valores = $preguntas_valor->get();

        $indice  = 1;
        $alto    = 0;
        $bajo    = 0;
        $medio   = 0;
        foreach($valores as $values) {

          $consecuencias[$group->nombre]['detalle'][] = array(

            'participante'  => 'P' . $indice,
            'paciente'      => $values->paciente_id,
            'promedio'      => $values->promedio,

          );

          $tables[$group->nombre][] = array(

            'participante'  => 'P' . $indice,
            'paciente'      => $values->nombre,
            'resultado_id'  => $values->id,
            'promedio'      => $values->promedio,

          );

          if($group->nombre == 'ABSENTISMO') {
          
            if($values->promedio <= 1.5) {
              $alto++;
              $algobg = "red";
              $altolabel = "ALTA";
            }elseif($values->promedio >= 1.6 && $values->promedio <= 1.9) {
              $medio++;
              $mediobg = "yellow";
              $mediolabel = "MEDIA";
            } else {
              $bajo++;
              $bajobg = "green";
              $bajolabel = "BAJA";
            }

          } else if($group->nombre == 'SATISFACCION_LABORAL') {
            
            if($values->promedio <= 1.5) {
              $alto++;
              $algobg = "red";
              $altolabel = "BAJA";
            }elseif($values->promedio >= 1.6 && $values->promedio <= 1.9) {
              $medio++;
              $mediobg = "yellow";
              $mediolabel = "MEDIA";
            } else {
              $bajo++;
              $bajobg = "green";
              $bajolabel = "ALTA";
            }

          } else {

            if($values->promedio <= 1.5) {
              $bajo++;
              $bajobg = "green";
              $bajolabel = "BAJO";
            }elseif($values->promedio >= 1.6 && $values->promedio <= 1.9) {
              $medio++;
              $mediobg = "yellow";
              $mediolabel = "MEDIO";
            } else {
              $alto++;
              $altobg = "red";
              $altolabel = "ALTO";
            }

          }
                    
          $consecuencias[$group->nombre]['total']   = $indice;
          $consecuencias[$group->nombre]['alto']    = round(($alto / $indice * 100));
          $consecuencias[$group->nombre]['altobg']  = $altobg; 
          $consecuencias[$group->nombre]['medio']   = round(($medio / $indice * 100));
          $consecuencias[$group->nombre]['mediobg'] = $mediobg; 
          $consecuencias[$group->nombre]['bajo']    = round(($bajo / $indice * 100));
          $consecuencias[$group->nombre]['bajobg']  = $bajobg;

          $consecuencias[$group->nombre]['mediolabel']  = $mediolabel;
          $consecuencias[$group->nombre]['altolabel']  = $altolabel;
          $consecuencias[$group->nombre]['bajolabel']  = $bajolabel;
          
          $indice++;

        }
        
      }

      $resultados = array(

        'tables'         => $tables,

        'quemarse'       => $quemarse,

        'riesgos'        => $riesgos,

        'consecuencias'  => $consecuencias,
        
      );

      return $resultados;
      
    }


}
