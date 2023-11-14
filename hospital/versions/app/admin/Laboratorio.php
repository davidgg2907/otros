<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Laboratorio extends Model
{
    protected $table = 'laboratorio';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif', 'pdf');

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

    public function getLaboratorio($id){
      $data =  Laboratorio::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getLaboratorioView($id){
      $laboratorio = Laboratorio::select(array('laboratorio.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));
      $laboratorio->where('laboratorio.id', $id);
      $laboratorio->leftJoin('pacientes', 'laboratorio.paciente_id', '=','pacientes.id');$laboratorio->leftJoin('medicos', 'laboratorio.medico_id', '=','medicos.id');$laboratorio->leftJoin('enfermeria', 'laboratorio.enfermera_id', '=','enfermeria.id');
      return $laboratorio->get()[0];

    }

    public function changeStatus($field, $id){
      $laboratorio = $this->getLaboratorio($id);
      if(count($laboratorio)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $laboratorio = $this->getLaboratorio($id);
      if(count($laboratorio)){
        $laboratorio->status = $num;
        $laboratorio->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $laboratorio = $this->getLaboratorio($id);
      if(count($laboratorio)){
        $img = public_path().'/uploads/'.$laboratorio->featured_img;
            if($laboratorio->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $laboratorio->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getLaboratorioData($per_page, $request, $sortBy, $order){
      $laboratorio = Laboratorio::select(array('laboratorio.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $laboratorio->leftJoin('pacientes', 'laboratorio.paciente_id', '=','pacientes.id');$laboratorio->leftJoin('medicos', 'laboratorio.medico_id', '=','medicos.id');$laboratorio->leftJoin('enfermeria', 'laboratorio.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $laboratorio->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        if((int)Auth::user()->enfermera_id != 0) {

          $laboratorio->where('laboratorio.enfermera_id',Auth::user()->enfermera_id);

        }

        if((int)Auth::user()->medico_id != 0) {

          $laboratorio->where('laboratorio.medico_id',Auth::user()->medico_id);

        }

        // sort option
        if($sortBy!='' && $order!=''){
          $laboratorio->orderBy($sortBy, $order);
        } else{
          $laboratorio->orderBy('laboratorio.id', 'desc');
        }

        return $laboratorio->paginate($per_page);
    }

    public function getLaboratorioExport($searchBy, $searchValue, $sortBy, $order){
      $laboratorio = Laboratorio::select(array('laboratorio.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $laboratorio->leftJoin('pacientes', 'laboratorio.paciente_id', '=','pacientes.id');$laboratorio->leftJoin('medicos', 'laboratorio.medico_id', '=','medicos.id');$laboratorio->leftJoin('enfermeria', 'laboratorio.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $laboratorio->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $laboratorio->orderBy($sortBy, $order);
        } else{
          $laboratorio->orderBy('laboratorio.id', 'desc');
        }
        return $laboratorio->get();
    }

    public function updateLaboratorio($request){
      $id = $request->input('id');
      $laboratorio = Laboratorio::getLaboratorio($id);
      if(count($laboratorio)){

          $laboratorio->orden_id = $request->input('orden_id')!="" ? $request->input('orden_id') : "";
	$laboratorio->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$laboratorio->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$laboratorio->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : "";
	$laboratorio->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$laboratorio->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$laboratorio->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
	$laboratorio->archivo = $request->input('archivo')=="" ? $request->input('old_archivo') : $request->input('archivo') ;

                    // image upload code
                    $archivo_name='';
                    $archivo_file = $request->file('archivo');
                    if(!is_null($archivo_file) && in_array($archivo_file->getClientOriginalExtension(), $this->allow_image)){
                        $archivo_name = time().'_'.$archivo_file->getClientOriginalName();
                        $archivo_file->move('uploads/Laboratorio',$archivo_name);
                        $laboratorio->archivo = $archivo_name;
                    }

	$laboratorio->status = $request->input('status')!="" ? $request->input('status') : "";

          $laboratorio->save();
          return true;
      } else{
        return false;
      }
    }

    public function addLaboratorio($request){
      $laboratorio = new Laboratorio;

        $laboratorio->orden_id = $request->input('orden_id')!="" ? $request->input('orden_id') : "";
	$laboratorio->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$laboratorio->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$laboratorio->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : "";
	$laboratorio->fecha = $request->input('fecha')!="" ? date('Y-m-d',strtotime($request->input('fecha'))) : "";
	$laboratorio->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$laboratorio->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
	$laboratorio->archivo = $request->input('archivo')=="" ? $request->input('old_archivo') : $request->input('archivo') ;

                    // image upload code
                    $archivo_name='';
                    $archivo_file = $request->file('archivo');
                    if(!is_null($archivo_file) && in_array($archivo_file->getClientOriginalExtension(), $this->allow_image)){
                        $archivo_name = time().'_'.$archivo_file->getClientOriginalName();
                        $archivo_file->move('uploads/Laboratorio',$archivo_name);
                        $laboratorio->archivo = $archivo_name;
                    }

	$laboratorio->status = $request->input('status')!="" ? $request->input('status') : "";

        $laboratorio->save();
        return true;
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
}
