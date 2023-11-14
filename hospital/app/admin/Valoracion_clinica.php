<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Valoracion_clinica extends Model
{
    protected $table = 'valoracion_clinica';
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

    public function getValoracion_clinica($id){
      $data =  Valoracion_clinica::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getValoracion_clinicaView($id){
      $valoracion_clinica = Valoracion_clinica::select(array('valoracion_clinica.*' , 'pacientes.nombre' , 'medicos.nombre'));
      $valoracion_clinica->where('valoracion_clinica.id', $id);
      $valoracion_clinica->leftJoin('pacientes', 'valoracion_clinica.paciente_id', '=','pacientes.id');$valoracion_clinica->leftJoin('medicos', 'valoracion_clinica.medico_id', '=','medicos.id');
      return $valoracion_clinica->get()[0];

    }

    public function changeStatus($field, $id){
      $valoracion_clinica = $this->getValoracion_clinica($id);
      if(count($valoracion_clinica)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $valoracion_clinica = $this->getValoracion_clinica($id);
      if(count($valoracion_clinica)){
        $valoracion_clinica->status = $num;
        $valoracion_clinica->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $valoracion_clinica = $this->getValoracion_clinica($id);
      if(count($valoracion_clinica)){
        $img = public_path().'/uploads/'.$valoracion_clinica->featured_img;
            if($valoracion_clinica->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $valoracion_clinica->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getValoracion_clinicaData($per_page, $request, $sortBy, $order){
      $valoracion_clinica = Valoracion_clinica::select(array('valoracion_clinica.*' , 'pacientes.nombre' , 'medicos.nombre'));

      //join
        $valoracion_clinica->leftJoin('pacientes', 'valoracion_clinica.paciente_id', '=','pacientes.id');$valoracion_clinica->leftJoin('medicos', 'valoracion_clinica.medico_id', '=','medicos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $valoracion_clinica->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $valoracion_clinica->orderBy($sortBy, $order);
        } else{
          $valoracion_clinica->orderBy('valoracion_clinica.id', 'desc');
        }

        return $valoracion_clinica->paginate($per_page);
    }

    public function getValoracion_clinicaExport($searchBy, $searchValue, $sortBy, $order){
      $valoracion_clinica = Valoracion_clinica::select(array('valoracion_clinica.*' , 'pacientes.nombre' , 'medicos.nombre'));

      //join
        $valoracion_clinica->leftJoin('pacientes', 'valoracion_clinica.paciente_id', '=','pacientes.id');$valoracion_clinica->leftJoin('medicos', 'valoracion_clinica.medico_id', '=','medicos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $valoracion_clinica->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $valoracion_clinica->orderBy($sortBy, $order);
        } else{
          $valoracion_clinica->orderBy('valoracion_clinica.id', 'desc');
        }
        return $valoracion_clinica->get();
    }

    public function updateValoracion_clinica($request){
      $id = $request->input('id');
      $valoracion_clinica = Valoracion_clinica::getValoracion_clinica($id);
      if(count($valoracion_clinica)){

          $valoracion_clinica->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$valoracion_clinica->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$valoracion_clinica->cita_id = $request->input('cita_id')!="" ? $request->input('cita_id') : "";
	$valoracion_clinica->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$valoracion_clinica->valoracion = $request->input('valoracion')!="" ? $request->input('valoracion') : "";
	$valoracion_clinica->status = $request->input('status')!="" ? $request->input('status') : "";

          $valoracion_clinica->save();
          return true;
      } else{
        return false;
      }
    }

    public function addValoracion_clinica($request){
      $valoracion_clinica = new Valoracion_clinica;

        $valoracion_clinica->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$valoracion_clinica->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$valoracion_clinica->cita_id = $request->input('cita_id')!="" ? $request->input('cita_id') : "";
	$valoracion_clinica->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$valoracion_clinica->valoracion = $request->input('valoracion')!="" ? $request->input('valoracion') : "";
	$valoracion_clinica->status = $request->input('status')!="" ? $request->input('status') : "";

        $valoracion_clinica->save();
        return true;
    }
}
