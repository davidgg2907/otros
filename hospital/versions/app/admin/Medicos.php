<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    protected $table = 'medicos';
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

    public function getMedicos($id){
      $data =  Medicos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getMedicosView($id){
      $medicos = Medicos::select(array('medicos.*'));
      $medicos->where('medicos.id', $id);

      return $medicos->get()[0];

    }

    public function changeStatus($field, $id){
      $medicos = $this->getMedicos($id);
      if(count($medicos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $medicos = $this->getMedicos($id);
      if(count($medicos)){
        $medicos->status = $num;
        $medicos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $medicos = $this->getMedicos($id);
      if(count($medicos)){
        $img = public_path().'/uploads/'.$medicos->featured_img;
            if($medicos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $medicos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getMedicosData($per_page, $request, $sortBy, $order){
      $medicos = Medicos::select(array('medicos.*'));

        // where condition
        if($request->input('nombre') != ""){
          $medicos->where('nombre','LIKE','%' . $request->input('nombre') . '%');
        }

        if($request->input('especialidad') != ""){
          $medicos->where('especialidad','LIKE','%' . $request->input('especialidad') . '%');
        }

        if($request->input('cedula') != ""){
          $medicos->where('cedula','LIKE','%' . $request->input('cedula') . '%');
        }

        if($request->input('celular') != ""){
          $medicos->where('celular','LIKE','%' . $request->input('celular') . '%');
        }

        $medicos->where('status',1);

        // sort option
        if($sortBy!='' && $order!=''){
          $medicos->orderBy($sortBy, $order);
        } else{
          $medicos->orderBy('medicos.id', 'desc');
        }

        return $medicos->paginate($per_page);
    }

    public function getMedicosExport($searchBy, $searchValue, $sortBy, $order){
      $medicos = Medicos::select(array('medicos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $medicos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $medicos->orderBy($sortBy, $order);
        } else{
          $medicos->orderBy('medicos.id', 'desc');
        }
        return $medicos->get();
    }

    public function updateMedicos($request){
      $id = $request->input('id');
      $medicos = Medicos::getMedicos($id);
      if(count($medicos)){

          $medicos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$medicos->especialidad = $request->input('especialidad')!="" ? $request->input('especialidad') : "";
        	$medicos->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$medicos->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
        	$medicos->cedula = $request->input('cedula')!="" ? $request->input('cedula') : "";
        	$medicos->curp = $request->input('curp')!="" ? $request->input('curp') : "";
        	$medicos->honorarios = $request->input('honorarios')!="" ? $request->input('honorarios') : 0;
        	$medicos->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
        	$medicos->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

                    // image upload code
                    $fotografia_name='';
                    $fotografia_file = $request->file('fotografia');
                    if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
                        $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
                        $fotografia_file->move('uploads/medicos',$fotografia_name);
                        $medicos->fotografia = $fotografia_name;
                    }

          $medicos->status = $request->input('status')!="" ? $request->input('status') : "";

          $medicos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addMedicos($request){

      $medicos = new Medicos;

      $medicos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
    	$medicos->especialidad = $request->input('especialidad')!="" ? $request->input('especialidad') : "";
    	$medicos->celular = $request->input('celular')!="" ? $request->input('celular') : "";
    	$medicos->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
    	$medicos->cedula = $request->input('cedula')!="" ? $request->input('cedula') : "";
    	$medicos->curp = $request->input('curp')!="" ? $request->input('curp') : "";
    	$medicos->honorarios = $request->input('honorarios')!="" ? $request->input('honorarios') : 0;
    	$medicos->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
    	$medicos->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

      // image upload code
      $fotografia_name='';
      $fotografia_file = $request->file('fotografia');
      if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
          $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
          $fotografia_file->move('uploads/medicos',$fotografia_name);
          $medicos->fotografia = $fotografia_name;
      }

    	$medicos->status = $request->input('status')!="" ? $request->input('status') : "";

      $medicos->save();
      return $medicos->id;

    }

    public function misConsultorios($id) {

      $consultorios = DB::table('consultorios')->where('status',1);

      $consultorios->where('medico_id',$id);

      return $consultorios->get();

    }

    public function misConsultas($id) {

      $consultorios = DB::table('consultas')->where('status',1);

      $consultorios->where('doctor_id',$id);

      return $consultorios->get();

    }

    public function misHospitalizaciones($id) {


    }


    public function misRecetas($id) {


    }

    public function misCitas($id) {

      $citas = DB::table('citas')->select(array('citas.*',
                                                       'pacientes.nombre AS paciente',
                                                       'consultorios.descripcion AS consultorio','consultorios.numero'));

      $citas->join('pacientes','pacientes.id','citas.paciente_id');
      $citas->join('consultorios','consultorios.id','citas.consultorio_id');
      $citas->leftjoin('enfermeria','enfermeria.id','citas.enfermera_id');

      $citas->where('citas.status','!=',0);

      $citas->where('citas.medico_id',$id);

      return $citas->get();

    }

    public function misPacientes($id) {

      $pacientes = DB::table('pacientes')->select(array('pacientes.*'));

      $pacientes->join('pacientes_asignacion','pacientes_asignacion.paciente_id','pacientes.id');

      $pacientes->where('pacientes_asignacion.medico_id',$id);

      return $pacientes->get();

    }
}
