<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Pertenencia extends Model
{
    protected $table = 'pacientes_asignacion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

}

class Pacientes extends Model
{
    protected $table = 'pacientes';
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

    public function changeStatus($field, $id){
      $pacientes = $this->getPacientes($id);
      if(count($pacientes)){

            return true;
      } else{
        return false;
      }
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
      $pacientes->leftJoin('pacientes_asignacion','pacientes_asignacion.paciente_id','pacientes.id');

        // where condition
        if($request->input('nombre') != ""){
          $pacientes->where("pacientes.nombre", 'LIKE', '%' . $request->input('nombre') . '%');
        }

        // where condition
        if($request->input('sexo') != ""){
          $pacientes->where("pacientes.sexo", $request->input('sexo'));
        }

        // where condition
        if($request->input('telefono') != ""){
          $pacientes->where("pacientes.telefono", 'LIKE', '%' . $request->input('telefono') . '%');
        }

        // where condition
        if($request->input('celular') != ""){
          $pacientes->where("pacientes.celular", 'LIKE', '%' . $request->input('celular') . '%');
        }

        // where condition
        if($request->input('tsangre') != ""){
          $pacientes->where("pacientes.tsangre", 'LIKE', '%' . $request->input('tsangre') . '%');
        }

        if((int)Auth::user()->medico_id != 0) {

          $pacientes->where('pacientes_asignacion.medico_id',Auth::user()->medico_id);

        }

        $pacientes->where('pacientes.status',1);


        // sort option
        if($sortBy!='' && $order!=''){
          $pacientes->orderBy($sortBy, $order);
        } else{
          $pacientes->orderBy('pacientes.id', 'desc');
        }

        return $pacientes->paginate($per_page);
    }

    public function getPacientesExport($searchBy, $searchValue, $sortBy, $order){
      $pacientes = Pacientes::select(array('pacientes.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $pacientes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $pacientes->orderBy($sortBy, $order);
        } else{
          $pacientes->orderBy('pacientes.id', 'desc');
        }
        return $pacientes->get();
    }

    public function updatePacientes($request){
      $id = $request->input('id');
      $pacientes = Pacientes::getPacientes($id);
      if(count($pacientes)){

          $pacientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$pacientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        	$pacientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$pacientes->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
        	$pacientes->tsangre = $request->input('tsangre')!="" ? $request->input('tsangre') : "";
        	$pacientes->sexo = $request->input('sexo')!="" ? $request->input('sexo') : "";
        	$pacientes->nacimiento = $request->input('nacimiento')!="" ? date('Y-m-d',strtotime($request->input('nacimiento'))) : null;
        	$pacientes->alergias = $request->input('alergias')!="" ? $request->input('alergias') : "";
        	$pacientes->hereditarias = $request->input('hereditarias')!="" ? $request->input('hereditarias') : "";
        	$pacientes->cirugias = $request->input('cirugias')!="" ? $request->input('cirugias') : "";
        	$pacientes->vicios = $request->input('vicios')!="" ? $request->input('vicios') : "";
          $pacientes->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
          $pacientes->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

          // image upload code
          $fotografia_name='';
          $fotografia_file = $request->file('fotografia');
          if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
              $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
              $fotografia_file->move('uploads/pacientes',$fotografia_name);
              $pacientes->fotografia = $fotografia_name;
          }


        	$pacientes->status = $request->input('status')!="" ? $request->input('status') : "";

          $pacientes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPacientes($request){
      $pacientes = new Pacientes;

        $pacientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$pacientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
      	$pacientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      	$pacientes->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
      	$pacientes->tsangre = $request->input('tsangre')!="" ? $request->input('tsangre') : "";
      	$pacientes->sexo = $request->input('sexo')!="" ? $request->input('sexo') : "";
      	$pacientes->nacimiento = $request->input('nacimiento')!="" ? date('Y-m-d',strtotime($request->input('nacimiento'))) : null;
      	$pacientes->alergias = $request->input('alergias')!="" ? $request->input('alergias') : "";
      	$pacientes->hereditarias = $request->input('hereditarias')!="" ? $request->input('hereditarias') : "";
      	$pacientes->cirugias = $request->input('cirugias')!="" ? $request->input('cirugias') : "";
      	$pacientes->vicios = $request->input('vicios')!="" ? $request->input('vicios') : "";
        $pacientes->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
        $pacientes->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

        // image upload code
        $fotografia_name='';
        $fotografia_file = $request->file('fotografia');
        if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
            $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
            $fotografia_file->move('uploads/pacientes',$fotografia_name);
            $pacientes->fotografia = $fotografia_name;
        }

      	$pacientes->status = $request->input('status')!="" ? $request->input('status') : "";

        $pacientes->save();

        $paciente_id = $pacientes->id;
        //Validamos si el que esta activo es un medico
        if(Auth::user()->medico_id != 0) {

          DB::table('pacientes_asignacion')->insert([

            'medico_id'         => Auth::user()->medico_id,

            'paciente_id'       => $paciente_id,

            'fecha_asignacion'  => date('Y-m-d H:i:s'),

            'status'            => 1

          ]);
        }


        return $paciente_id;
    }

    public function misMedicos() {

      return $this->hasMany('\App\admin\Consultorios', 'paciente_id', 'id');

    }

    public function misConsultas() {

      return $this->hasMany('\App\admin\Consultas', 'paciente_id', 'id');

    }

    public function misHospitalizaciones() {

      return $this->hasMany('\App\admin\Hospitalizacion', 'paciente_id', 'id');

    }

    public function misAnalisis() {

      return $this->hasMany('\App\admin\Laboratorio', 'paciente_id', 'id');

    }


    public function misRecetas() {

      return $this->hasMany('\App\admin\Recetas', 'paciente_id', 'id');

    }

    public function misNotas() {

      return $this->hasMany('\App\admin\Notas', 'paciente_id', 'id');

    }

    public function ultimaConsulta($id) {

      $consultas = \App\admin\Consultas::where('paciente_id',$id)->whereRaw('id = (select max(`id`) from consultas)')->get();

      if(count($consultas)) {
        return $consultas[0];
      } else {
        return array();
      }

    }

    public function ultimaHospitalizacion() {

      $ingreso = \App\admin\Hospitalizacion::where('paciente_id',$id)->whereRaw('id = (select max(`id`) from hospitalizacion)')->get();

      if(count($ingreso)) {
        return $ingreso[0];
      } else {
        return array();
      }

    }
}
