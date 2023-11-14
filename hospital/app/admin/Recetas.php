<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Recetas_detalle extends Model
{
    protected $table = 'recetas_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function medicamentos() {

      return $this->hasMany('\App\admin\Medicamentos', 'medicamento_id', 'id');

    }

}

class Recetas extends Model
{
    protected $table = 'recetas';
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

    public function getRecetas($id){
      $data =  Recetas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getRecetasView($id){
      $recetas = Recetas::select(array('recetas.*' , 'pacientes.nombre' , 'modulos.id'));
      $recetas->where('recetas.id', $id);
      $recetas->leftJoin('pacientes', 'recetas.paciente_id', '=','pacientes.id');$recetas->leftJoin('modulos', 'recetas.medico_id', '=','modulos.id');
      return $recetas->get()[0];

    }

    public function changeStatus($field, $id){
      $recetas = $this->getRecetas($id);
      if(count($recetas)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $recetas = $this->getRecetas($id);
      if(count($recetas)){
        $recetas->status = $num;
        $recetas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $recetas = $this->getRecetas($id);
      if(count($recetas)){
        $img = public_path().'/uploads/'.$recetas->featured_img;
            if($recetas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $recetas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getRecetasData($per_page, $request, $sortBy, $order){
      $recetas = Recetas::select(array('recetas.*' , 'pacientes.nombre' , 'medicos.nombre'));

      //join
        $recetas->leftJoin('pacientes', 'recetas.paciente_id', '=','pacientes.id');
        $recetas->leftJoin('medicos', 'recetas.medico_id', '=','medicos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $recetas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        if((int)Auth::user()->enfermera_id != 0) {

          $recetas->where('recetas.enfermera_id',Auth::user()->enfermera_id);

        }

        if((int)Auth::user()->medico_id != 0) {

          $recetas->where('recetas.medico_id',Auth::user()->medico_id);

        }

        $recetas->where('recetas.status',1);

        $recetas->orderBy('recetas.id', 'desc');

        return $recetas->paginate($per_page);
    }

    public function getRecetasExport($searchBy, $searchValue, $sortBy, $order){
      $recetas = Recetas::select(array('recetas.*' , 'pacientes.nombre' , 'modulos.id'));

      //join
        $recetas->leftJoin('pacientes', 'recetas.paciente_id', '=','pacientes.id');$recetas->leftJoin('modulos', 'recetas.medico_id', '=','modulos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $recetas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $recetas->orderBy($sortBy, $order);
        } else{
          $recetas->orderBy('recetas.id', 'desc');
        }
        return $recetas->get();
    }

    public function updateRecetas($request){
      $id = $request->input('id');
      $recetas = Recetas::getRecetas($id);
      if(count($recetas)){

          $recetas->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
        	$recetas->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
        	$recetas->medicamentos = $request->input('medicamentos')!="" ? $request->input('medicamentos') : "";
          $recetas->status = $request->input('status')!="" ? $request->input('status') : "";
          $recetas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addRecetas($request,$consulta_id =0){
      $recetas = new Recetas;

      if($request->input('medico_id')!= null) {

        $medico_id = $request->input('medico_id');

      } else {

        $medico_id = $request->input('doctor_id');

      }

      $recetas->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
      $recetas->medico_id = $medico_id;
      $recetas->fecha = date('Y-m-d H:i:s');
      $recetas->medicamentos = $request->input('medicamentos')!="" ? $request->input('medicamentos') : "";
      $recetas->consulta_id = $consulta_id;
      $recetas->status = $request->input('status')!="" ? $request->input('status') : 1;

      $recetas->save();
      return $recetas->id;
    }

    public function paciente() {

      return $this->hasOne('\App\admin\Pacientes', 'id', 'paciente_id');

    }

    public function doctor() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');

    }

    public function citaMedica() {

      return $this->hasOne('\App\admin\Consultas', 'id', ' consulta_id');

    }

    public function medicinas() {

      return $this->hasMany('\App\admin\Recetas_detalle', 'receta_id', 'id');

    }
}
