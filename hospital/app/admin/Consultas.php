<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Consultas extends Model
{
    protected $table = 'consultas';
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

    public function getConsultas($id){
      $data =  Consultas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getConsultasView($id){
      $consultas = Consultas::select(array('consultas.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));
      $consultas->where('consultas.id', $id);
      $consultas->leftJoin('pacientes', 'consultas.paciente_id', '=','pacientes.id');$consultas->leftJoin('medicos', 'consultas.doctor_id', '=','medicos.id');$consultas->leftJoin('enfermeria', 'consultas.enfermera_id', '=','enfermeria.id');
      return $consultas->get()[0];

    }

    public function changeStatus($field, $id){
      $consultas = $this->getConsultas($id);
      if(count($consultas)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $consultas = $this->getConsultas($id);
      if(count($consultas)){
        $consultas->status = $num;
        $consultas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $consultas = $this->getConsultas($id);
      if(count($consultas)){
        $img = public_path().'/uploads/'.$consultas->featured_img;
            if($consultas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $consultas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getConsultasData($per_page, $request, $sortBy, $order){
      $consultas = Consultas::select(array('consultas.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $consultas->leftJoin('pacientes', 'consultas.paciente_id', '=','pacientes.id');$consultas->leftJoin('medicos', 'consultas.doctor_id', '=','medicos.id');$consultas->leftJoin('enfermeria', 'consultas.enfermera_id', '=','enfermeria.id');

        // where condition
        if($request->input('paciente') != ""){
          $consultas->where("pacientes.nombre", 'LIKE', '%' . $request->input('paciente') . '%');
        }

        if($request->input('doctor') != ""){
          $consultas->where("medicos.nombre", 'LIKE', '%' . $request->input('doctor') . '%');
        }

        if($request->input('fecha') != ""){
          $consultas->where("consultas.fecha", $request->input('fecha'));
        }

        if($request->input('descripcion') != ""){
          $consultas->where("consultas.razon_visita", 'LIKE', '%' . $request->input('descripcion') . '%');
          $consultas->orWhere("consultas.diagnostico", 'LIKE', '%' . $request->input('descripcion') . '%');
        }

        if((int)Auth::user()->enfermera_id != 0) {

          $consultas->where('consultas.enfermera_id',Auth::user()->enfermera_id);

        }

        if((int)Auth::user()->medico_id != 0) {
          $consultas->where('consultas.doctor_id',Auth::user()->medico_id);

        }

        $consultas->where('consultas.status',1);


        // sort option
        $consultas->orderBy('consultas.id', 'desc');

        return $consultas->paginate($per_page);
    }

    public function getConsultasExport($searchBy, $searchValue, $sortBy, $order){
      $consultas = Consultas::select(array('consultas.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $consultas->leftJoin('pacientes', 'consultas.paciente_id', '=','pacientes.id');$consultas->leftJoin('medicos', 'consultas.doctor_id', '=','medicos.id');$consultas->leftJoin('enfermeria', 'consultas.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $consultas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $consultas->orderBy($sortBy, $order);
        } else{
          $consultas->orderBy('consultas.id', 'desc');
        }
        return $consultas->get();
    }

    public function updateConsultas($request){
      $id = $request->input('id');
      $consultas = Consultas::getConsultas($id);
      if(count($consultas)){

        $consultas->cita_id = $request->input('cita_id')!="" ? $request->input('cita_id') : 0;
      	$consultas->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : 0;
      	$consultas->doctor_id = $request->input('doctor_id')!="" ? $request->input('doctor_id') : 0;
      	$consultas->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : 0;
      	$consultas->signos_id = $request->input('signos_id')!="" ? $request->input('signos_id') : 0;

        $consultas->fc = $request->input('fc')!="" ? $request->input('fc') : 0;
        $consultas->fr = $request->input('fr')!="" ? $request->input('fr') : 0;
        $consultas->temperatura = $request->input('temperatura')!="" ? $request->input('temperatura') : 0;
        $consultas->peso = $request->input('peso')!="" ? $request->input('peso') : 0;
        $consultas->talla = $request->input('talla')!="" ? $request->input('talla') : 0;
        $consultas->ta1 = $request->input('ta1')!="" ? $request->input('ta1') : 0;
        $consultas->ta2 = $request->input('ta2')!="" ? $request->input('ta2') : 0;
        $consultas->sato2 = $request->input('sato2')!="" ? $request->input('sato2') : 0;

        $consultas->fecha = date('Y-m-d');
        $consultas->costo = $request->input('costo')!="" ? $request->input('costo') : 0;
      	$consultas->razon_visita = $request->input('razon_visita')!="" ? $request->input('razon_visita') : "";
      	$consultas->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
        $consultas->tratamiento = $request->input('tratamiento')!="" ? $request->input('tratamiento') : "";
        $consultas->recomendaciones = $request->input('recomendaciones')!="" ? $request->input('recomendaciones') : "";
      	$consultas->status = $request->input('status')!="" ? $request->input('status') : 1;

          $consultas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addConsultas($request){
      $consultas = new Consultas;

        $consultas->cita_id = $request->input('cita_id')!="" ? $request->input('cita_id') : 0;
      	$consultas->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : 0;
      	$consultas->doctor_id = $request->input('doctor_id')!="" ? $request->input('doctor_id') : 0;
      	$consultas->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : 0;
      	$consultas->signos_id = $request->input('signos_id')!="" ? $request->input('signos_id') : 0;

        $consultas->fc = $request->input('fc')!="" ? $request->input('fc') : 0;
        $consultas->fr = $request->input('fr')!="" ? $request->input('fr') : 0;
        $consultas->temperatura = $request->input('temperatura')!="" ? $request->input('temperatura') : 0;
        $consultas->peso = $request->input('peso')!="" ? $request->input('peso') : 0;
        $consultas->talla = $request->input('talla')!="" ? $request->input('talla') : 0;
        $consultas->ta1 = $request->input('t1')!="" ? $request->input('t1') : 0;
        $consultas->ta2 = $request->input('t2')!="" ? $request->input('t2') : 0;
        $consultas->sato2 = $request->input('sato2')!="" ? $request->input('sato2') : 0;

        $consultas->fecha = date('Y-m-d');
        $consultas->costo = $request->input('costo')!="" ? $request->input('costo') : 0;
      	$consultas->razon_visita = $request->input('razon_visita')!="" ? $request->input('razon_visita') : "";
      	$consultas->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
        $consultas->tratamiento = $request->input('tratamiento')!="" ? $request->input('tratamiento') : "";
        $consultas->recomendaciones = $request->input('recomendaciones')!="" ? $request->input('recomendaciones') : "";
      	$consultas->status = $request->input('status')!="" ? $request->input('status') : 1;

        $consultas->save();
        return $consultas->id;
    }

    public function doctor() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'doctor_id');

    }

    public function paciente() {

      return $this->hasOne('\App\admin\Pacientes', 'id', 'paciente_id');

    }

    public function receta() {

      return $this->hasOne('\App\admin\Recetas', 'consulta_id', 'id');

    }
}
