<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Citas extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getPermissions($id){
      $data =  Permissions::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPermissionsView($id){
      $permissions = Permissions::select(array('permissions.*'));
      $permissions->where('permissions.id', $id);

      return $permissions->get()[0];

    }

    public function getCitas($id){
      $data =  Citas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCitasView($id){
      $citas = Citas::select(array('citas.*' , 'pacientes.nombre' , 'consultorios.id' , 'medicos.nombre' , 'enfermeria.nombre'));
      $citas->where('citas.id', $id);
      $citas->leftJoin('pacientes', 'citas.paciente_id', '=','pacientes.id');$citas->leftJoin('consultorios', 'citas.consultorio_id', '=','consultorios.id');$citas->leftJoin('medicos', 'citas.medico_id', '=','medicos.id');$citas->leftJoin('enfermeria', 'citas.enfermera_id', '=','enfermeria.id');
      return $citas->get()[0];

    }

    public function changeStatus($field, $id){
      $citas = $this->getCitas($id);
      if(count($citas)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $citas = $this->getCitas($id);
      if(count($citas)){
        $citas->status = $num;
        $citas->save();
        return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $citas = $this->getCitas($id);
      if(count($citas)){
        $img = public_path().'/uploads/'.$citas->featured_img;
            if($citas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $citas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getUltimas() {

      $citas = Citas::limit(5)->orderBy('id','DESC');

      return $citas->get();

    }

    public function getCitasData($per_page, $request, $sortBy, $order){
      $citas = Citas::select(array('citas.*' , 'pacientes.nombre' , 'consultorios.numero' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $citas->leftJoin('pacientes', 'citas.paciente_id', '=','pacientes.id');
        $citas->leftJoin('consultorios', 'citas.consultorio_id', '=','consultorios.id');
        $citas->leftJoin('medicos', 'citas.medico_id', '=','medicos.id');
        $citas->leftJoin('enfermeria', 'citas.enfermera_id', '=','enfermeria.id');

        if((int)Auth::user()->enfermera_id != 0) {

          $citas->where('citas.enfermera_id',Auth::user()->enfermera_id);

        }

        if((int)Auth::user()->medico_id != 0) {

          $citas->where('citas.medico_id',Auth::user()->medico_id);

        }

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $citas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $citas->where('citas.status', 1);

        // sort option
        if($sortBy!='' && $order!=''){
          $citas->orderBy($sortBy, $order);
        } else{
          $citas->orderBy('citas.id', 'desc');
        }

        return $citas->paginate($per_page);
    }

    public function getCitasExport($searchBy, $searchValue, $sortBy, $order){
      $citas = Citas::select(array('citas.*' , 'pacientes.nombre' , 'consultorios.id' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $citas->leftJoin('pacientes', 'citas.paciente_id', '=','pacientes.id');$citas->leftJoin('consultorios', 'citas.consultorio_id', '=','consultorios.id');$citas->leftJoin('medicos', 'citas.medico_id', '=','medicos.id');$citas->leftJoin('enfermeria', 'citas.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $citas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $citas->orderBy($sortBy, $order);
        } else{
          $citas->orderBy('citas.id', 'desc');
        }
        return $citas->get();
    }

    public function updateCitas($request){
      $id = $request->input('id');
      $citas = Citas::getCitas($id);
      if(count($citas)){

        $citas->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
        $citas->consultorio_id = $request->input('consultorio_id')!="" ? $request->input('consultorio_id') : 0;
        $citas->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
        $citas->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : 0.;
        $citas->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
        $citas->hora = $request->input('hora')!="" ? $request->input('hora') : "";
        $citas->comentarios = $request->input('comentarios')!="" ? $request->input('comentarios') : "";
      	$citas->status = $request->input('status')!="" ? $request->input('status') : "";

        $citas->save();
        return true;

      } else{
        return false;
      }
    }

    public function addCitas($request){
      $citas = new Citas;

      $citas->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
      $citas->consultorio_id = $request->input('consultorio_id')!="" ? $request->input('consultorio_id') : 0;
      $citas->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
      $citas->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : 0.;
      $citas->fecha = $request->input('fecha')!="" ? date('Y-m-d',strtotime($request->input('fecha'))) : "";
      $citas->hora = $request->input('hora')!="" ? $request->input('hora') : "";
      $citas->comentarios = $request->input('comentarios')!="" ? $request->input('comentarios') : "";
    	$citas->status = $request->input('status')!="" ? $request->input('status') : "";

      $citas->save();
      return true;

    }

    public function conteoCitas() {

        $conteo = Citas::select(DB::raw('count(*) as total, status'));

        if(Auth::user()->medico_id != 0) {
          $conteo->where('medico_id', Auth::user()->medico_id);
        }

        if(Auth::user()->asistente_id != 0) {

          $asistente = \App\admin\Asistentes::find(Auth::user()->asistente_id);

          $doctores = explode(',',$asistente->doctores);

          $conteo->whereIn('medico_id', $doctores);

        }

        $conteo->groupBy('status');

        $data = $conteo->get();

        if(count($data)) {
          return $data;
        } else {
          return array();
        }
    }

    public function desactivaPasadas(){

      $data = Citas::where('fecha', '<', date('Y-m-d'))->get();

      foreach($data as $value) {

        $value->status = 0;
        $value->save();

      }

    }

    public function paciente() {

      return $this->hasOne('\App\admin\Pacientes', 'id', 'paciente_id');

    }

    public function medico() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');

    }

    public function enfermeria() {

      return $this->hasOne('\App\admin\Enfermeria', 'id', 'enfermera_id');

    }

    public function consultorio() {

      return $this->hasOne('\App\admin\Consultorios', 'id', 'consultorio_id');

    }
}
