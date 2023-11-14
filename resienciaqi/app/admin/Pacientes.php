<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    const ESTATUS = array(

      '1' => 'Ninguna',
      '2' => 'Primaria',
      '3' => 'Secundaria',
      '4' => 'Preparatoria',
      '5' => 'Licenciatura',
      '6' => 'Maestria',
      '7' => 'Doctorado',     
    );

    const GENERO = array(

      '1' => 'Femenino',
      '2' => 'Masculino',      
    );

    const EDOCIVIL = array(

      '1' => 'Con Pareja Estable',
      '2' => 'Sin Pareja Estable',      
    );

    const CONTRATO = array(

      '1' => 'Contrato por tiempo indefinido',
      '2' => 'Contrato por tiempo determinado o fijo',
      '3' => 'Contratado a prueba',
      '4' => 'Contratado por horas',
      '5' => 'Contrato de capacitacion inicial',
    );

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getPacientes($id){
      $data =  Pacientes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPacientesView($id){
      $pacientes = Pacientes::select(array('pacientes.*'));
      $pacientes->where('pacientes.id', $id);

      return $pacientes->get()[0];

    }

    public function updateStatus($id, $num){
      $pacientes = $this->getPacientes($id);
      if(count($pacientes)){
        $pacientes->status = $num;
        $pacientes->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $pacientes = $this->getPacientes($id);
      if(count($pacientes)){
        $img = public_path().'/uploads/'.$pacientes->featured_img;
            if($pacientes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $pacientes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getPacientesData($per_page, $request, $sortBy, $order){
      $pacientes = Pacientes::select(array('pacientes.*'));

      //join


        // sort option
        $pacientes->orderBy('pacientes.id', 'desc');

        return $pacientes->paginate($per_page);
    }

    public function updatePacientes($request){
      $id = $request->input('id');
      $pacientes = Pacientes::getPacientes($id);
      if(count($pacientes)){

          $pacientes->delegacion_id = $request->input('delegacion_id')!="" ? $request->input('delegacion_id') : "";
        	$pacientes->area_id = $request->input('area_id')!="" ? $request->input('area_id') : "";
        	$pacientes->no_expediente = $request->input('no_expediente')!="" ? $request->input('no_expediente') : "";
        	$pacientes->genero_id = $request->input('genero_id')!="" ? $request->input('genero_id') : "";
        	$pacientes->educacion_id = $request->input('educacion_id')!="" ? $request->input('educacion_id') : "";
        	$pacientes->ocupacion_id = $request->input('ocupacion_id')!="" ? $request->input('ocupacion_id') : "";
        	$pacientes->edo_civil_id = $request->input('edo_civil_id')!="" ? $request->input('edo_civil_id') : "";
        	$pacientes->familiologo = $request->input('familiologo')!="" ? $request->input('familiologo') : "";
        	$pacientes->psicopedagogia = $request->input('psicopedagogia')!="" ? $request->input('psicopedagogia') : "";
        	$pacientes->medico = $request->input('medico')!="" ? $request->input('medico') : "";
        	$pacientes->psicologo = $request->input('psicologo')!="" ? $request->input('psicologo') : "";
        	$pacientes->trabsocial = $request->input('trabsocial')!="" ? $request->input('trabsocial') : "";
        	$pacientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$pacientes->curp = $request->input('curp')!="" ? $request->input('curp') : "";
        	$pacientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        	$pacientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$pacientes->tipo_ocupacion = $request->input('tipo_ocupacion')!="" ? $request->input('tipo_ocupacion') : "";
        	$pacientes->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
        	$pacientes->sexo = $request->input('sexo')!="" ? $request->input('sexo') : "";
        	$pacientes->nacimiento = $request->input('nacimiento')!="" ? $request->input('nacimiento') : "";
        	$pacientes->edad = $request->input('edad')!="" ? $request->input('edad') : "";
        	$pacientes->hijos = $request->input('hijos')!="" ? $request->input('hijos') : "";
        	$pacientes->lugar_nacimiento = $request->input('lugar_nacimiento')!="" ? $request->input('lugar_nacimiento') : "";
        	$pacientes->residencia = $request->input('residencia')!="" ? $request->input('residencia') : "";
        	$pacientes->canalizado = $request->input('canalizado')!="" ? $request->input('canalizado') : "";
        	$pacientes->fotografia = $request->input('fotografia')!="" ? $request->input('fotografia') : "";
        	$pacientes->status = $request->input('status')!="" ? $request->input('status') : "";

          $pacientes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPacientes($request){
      $pacientes = new Pacientes;

        $pacientes->delegacion_id = $request->input('delegacion_id')!="" ? $request->input('delegacion_id') : "";
      	$pacientes->area_id = $request->input('area_id')!="" ? $request->input('area_id') : "";
      	$pacientes->no_expediente = $request->input('no_expediente')!="" ? $request->input('no_expediente') : "";
      	$pacientes->genero_id = $request->input('genero_id')!="" ? $request->input('genero_id') : "";
      	$pacientes->educacion_id = $request->input('educacion_id')!="" ? $request->input('educacion_id') : "";
      	$pacientes->ocupacion_id = $request->input('ocupacion_id')!="" ? $request->input('ocupacion_id') : "";
      	$pacientes->edo_civil_id = $request->input('edo_civil_id')!="" ? $request->input('edo_civil_id') : "";
      	$pacientes->familiologo = $request->input('familiologo')!="" ? $request->input('familiologo') : "";
      	$pacientes->psicopedagogia = $request->input('psicopedagogia')!="" ? $request->input('psicopedagogia') : "";
      	$pacientes->medico = $request->input('medico')!="" ? $request->input('medico') : "";
      	$pacientes->psicologo = $request->input('psicologo')!="" ? $request->input('psicologo') : "";
      	$pacientes->trabsocial = $request->input('trabsocial')!="" ? $request->input('trabsocial') : "";
      	$pacientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$pacientes->curp = $request->input('curp')!="" ? $request->input('curp') : "";
      	$pacientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
      	$pacientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      	$pacientes->tipo_ocupacion = $request->input('tipo_ocupacion')!="" ? $request->input('tipo_ocupacion') : "";
      	$pacientes->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
      	$pacientes->sexo = $request->input('sexo')!="" ? $request->input('sexo') : "";
      	$pacientes->nacimiento = $request->input('nacimiento')!="" ? $request->input('nacimiento') : "";
      	$pacientes->edad = $request->input('edad')!="" ? $request->input('edad') : "";
      	$pacientes->hijos = $request->input('hijos')!="" ? $request->input('hijos') : "";
      	$pacientes->lugar_nacimiento = $request->input('lugar_nacimiento')!="" ? $request->input('lugar_nacimiento') : "";
      	$pacientes->residencia = $request->input('residencia')!="" ? $request->input('residencia') : "";
      	$pacientes->canalizado = $request->input('canalizado')!="" ? $request->input('canalizado') : "";
      	$pacientes->fotografia = $request->input('fotografia')!="" ? $request->input('fotografia') : "";
      	$pacientes->status = $request->input('status')!="" ? $request->input('status') : "";

        $pacientes->save();
        return true;
    }

    public function delegacion(){
      return $this->hasOne('\App\admin\Delegaciones', 'id', 'delegacion_id');
    }

    public function area(){
      return $this->hasOne('\App\admin\Areas', 'id', 'area_id');
    }


        public static function countSexos($delegacion,$area) {

          $resultados = array();

          if($delegacion != 0) {
            $resultados['femenino']   = Pacientes::where('genero_id',1)->where('delegacion_id',$delegacion)->count();
            $resultados['masculino']  = Pacientes::where('genero_id',2)->where('delegacion_id',$delegacion)->count();
          } else if($area != 0) {
            $resultados['femenino']   = Pacientes::where('genero_id',1)->where('area_id',$area)->count();
            $resultados['masculino']  = Pacientes::where('genero_id',2)->where('area_id',$area)->count();
          } else {
            $resultados['femenino']   = 0;
            $resultados['masculino']  = 0;
          }

          return $resultados;
        }

        public static function countEducacion($delegacion,$area) {

          $resultados = array();

          if($delegacion != 0) {
            $resultados['ninguno']        = Pacientes::where('educacion_id',1)->where('delegacion_id',$delegacion)->count();
            $resultados['primaria']       = Pacientes::where('educacion_id',2)->where('delegacion_id',$delegacion)->count();
            $resultados['secundaria']     = Pacientes::where('educacion_id',3)->where('delegacion_id',$delegacion)->count();
            $resultados['preparatoria']   = Pacientes::where('educacion_id',4)->where('delegacion_id',$delegacion)->count();
            $resultados['licenciatura']   = Pacientes::where('educacion_id',5)->where('delegacion_id',$delegacion)->count();
            $resultados['maestria']       = Pacientes::where('educacion_id',6)->where('delegacion_id',$delegacion)->count();
            $resultados['doctorado']      = Pacientes::where('educacion_id',7)->where('delegacion_id',$delegacion)->count();
          } else if($area != 0) {
            $resultados['ninguno']        = Pacientes::where('educacion_id',1)->where('area_id',$area)->count();
            $resultados['primaria']       = Pacientes::where('educacion_id',2)->where('area_id',$area)->count();
            $resultados['secundaria']     = Pacientes::where('educacion_id',3)->where('area_id',$area)->count();
            $resultados['preparatoria']   = Pacientes::where('educacion_id',4)->where('area_id',$area)->count();
            $resultados['licenciatura']   = Pacientes::where('educacion_id',5)->where('area_id',$area)->count();
            $resultados['maestria']       = Pacientes::where('educacion_id',6)->where('area_id',$area)->count();
            $resultados['doctorado']      = Pacientes::where('educacion_id',7)->where('area_id',$area)->count();
          } else {
            $resultados['ninguno']        = 0;
            $resultados['primaria']       = 0;
            $resultados['secundaria']     = 0;
            $resultados['preparatoria']   = 0;
            $resultados['licenciatura']   = 0;
            $resultados['maestria']       = 0;
            $resultados['doctorado']      = 0;
          }

          return $resultados;
        }

        public static function countEdoCivil($delegacion,$area) {

          $resultados = array();

          if($delegacion != 0) {
            $resultados['solo']   = Pacientes::where('edo_civil_id',2)->where('delegacion_id',$delegacion)->count();
            $resultados['pareja']  = Pacientes::where('edo_civil_id',1)->where('delegacion_id',$delegacion)->count();
          } else if($area != 0) {
            $resultados['solo']   = Pacientes::where('edo_civil_id',2)->where('area_id',$area)->count();
            $resultados['pareja']  = Pacientes::where('edo_civil_id',1)->where('area_id',$area)->count();
          } else {
            $resultados['solo']    = 0;
            $resultados['pareja']  = 0;
          }

          return $resultados;
        }

        public static function countCttos($delegacion,$area) {

          $resultados = array();

          if($delegacion != 0) {
            $resultados['indefinido']     = Pacientes::where('ocupacion_id',1)->where('delegacion_id',$delegacion)->count();
            $resultados['definido']       = Pacientes::where('ocupacion_id',2)->where('delegacion_id',$delegacion)->count();
            $resultados['prueba']         = Pacientes::where('ocupacion_id',3)->where('delegacion_id',$delegacion)->count();
            $resultados['horas']          = Pacientes::where('ocupacion_id',4)->where('delegacion_id',$delegacion)->count();
            $resultados['capacitacion']   = Pacientes::where('ocupacion_id',5)->where('delegacion_id',$delegacion)->count();
          } else if($area != 0) {
            $resultados['indefinido']     = Pacientes::where('ocupacion_id',1)->where('area_id',$area)->count();
            $resultados['definido']       = Pacientes::where('ocupacion_id',2)->where('area_id',$area)->count();
            $resultados['prueba']         = Pacientes::where('ocupacion_id',3)->where('area_id',$area)->count();
            $resultados['horas']          = Pacientes::where('ocupacion_id',4)->where('area_id',$area)->count();
            $resultados['capacitacion']   = Pacientes::where('ocupacion_id',5)->where('area_id',$area)->count();
          } else {
            $resultados['indefinido']     = 0;
            $resultados['definido']       = 0;
            $resultados['prueba']         = 0;
            $resultados['horas']          = 0;
            $resultados['capacitacion']   = 0;
          }


          return $resultados;
        }

}
