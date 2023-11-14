<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Signos_vitales extends Model
{
    protected $table = 'signos_vitales';
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

    public function getSignos_vitales($id){
      $data =  Signos_vitales::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getSignos_vitalesView($id){
      $signos_vitales = Signos_vitales::select(array('signos_vitales.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));
      $signos_vitales->where('signos_vitales.id', $id);
      $signos_vitales->leftJoin('pacientes', 'signos_vitales.paciente_id', '=','pacientes.id');$signos_vitales->leftJoin('medicos', 'signos_vitales.medico_id', '=','medicos.id');$signos_vitales->leftJoin('enfermeria', 'signos_vitales.enfermera_id', '=','enfermeria.id');
      return $signos_vitales->get()[0];

    }

    public function changeStatus($field, $id){
      $signos_vitales = $this->getSignos_vitales($id);
      if(count($signos_vitales)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $signos_vitales = $this->getSignos_vitales($id);
      if(count($signos_vitales)){
        $signos_vitales->status = $num;
        $signos_vitales->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $signos_vitales = $this->getSignos_vitales($id);
      if(count($signos_vitales)){
        $img = public_path().'/uploads/'.$signos_vitales->featured_img;
            if($signos_vitales->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $signos_vitales->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getSignos_vitalesData($per_page, $request, $sortBy, $order){
      $signos_vitales = Signos_vitales::select(array('signos_vitales.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $signos_vitales->leftJoin('pacientes', 'signos_vitales.paciente_id', '=','pacientes.id');$signos_vitales->leftJoin('medicos', 'signos_vitales.medico_id', '=','medicos.id');$signos_vitales->leftJoin('enfermeria', 'signos_vitales.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $signos_vitales->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $signos_vitales->where('status',1);

        // sort option
        if($sortBy!='' && $order!=''){
          $signos_vitales->orderBy($sortBy, $order);
        } else{
          $signos_vitales->orderBy('signos_vitales.id', 'desc');
        }

        return $signos_vitales->paginate($per_page);
    }

    public function getSignos_vitalesExport($searchBy, $searchValue, $sortBy, $order){
      $signos_vitales = Signos_vitales::select(array('signos_vitales.*' , 'pacientes.nombre' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $signos_vitales->leftJoin('pacientes', 'signos_vitales.paciente_id', '=','pacientes.id');$signos_vitales->leftJoin('medicos', 'signos_vitales.medico_id', '=','medicos.id');$signos_vitales->leftJoin('enfermeria', 'signos_vitales.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $signos_vitales->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $signos_vitales->orderBy($sortBy, $order);
        } else{
          $signos_vitales->orderBy('signos_vitales.id', 'desc');
        }
        return $signos_vitales->get();
    }

    public function updateSignos_vitales($request){
      $id = $request->input('id');
      $signos_vitales = Signos_vitales::getSignos_vitales($id);
      if(count($signos_vitales)){

          $signos_vitales->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$signos_vitales->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$signos_vitales->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : "";
	$signos_vitales->cita_id = $request->input('cita_id')!="" ? $request->input('cita_id') : "";
	$signos_vitales->hospitalizacion_id = $request->input('hospitalizacion_id')!="" ? $request->input('hospitalizacion_id') : "";
	$signos_vitales->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$signos_vitales->presion = $request->input('presion')!="" ? $request->input('presion') : "";
	$signos_vitales->temperatura = $request->input('temperatura')!="" ? $request->input('temperatura') : "";
	$signos_vitales->pulsaciones = $request->input('pulsaciones')!="" ? $request->input('pulsaciones') : "";
	$signos_vitales->altura = $request->input('altura')!="" ? $request->input('altura') : "";
	$signos_vitales->peso = $request->input('peso')!="" ? $request->input('peso') : "";
	$signos_vitales->comentarios = $request->input('comentarios')!="" ? $request->input('comentarios') : "";
	$signos_vitales->status = $request->input('status')!="" ? $request->input('status') : "";

          $signos_vitales->save();
          return true;
      } else{
        return false;
      }
    }

    public function addSignos_vitales($request){
      $signos_vitales = new Signos_vitales;

        $signos_vitales->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$signos_vitales->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$signos_vitales->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : "";
	$signos_vitales->cita_id = $request->input('cita_id')!="" ? $request->input('cita_id') : "";
	$signos_vitales->hospitalizacion_id = $request->input('hospitalizacion_id')!="" ? $request->input('hospitalizacion_id') : "";
	$signos_vitales->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$signos_vitales->presion = $request->input('presion')!="" ? $request->input('presion') : "";
	$signos_vitales->temperatura = $request->input('temperatura')!="" ? $request->input('temperatura') : "";
	$signos_vitales->pulsaciones = $request->input('pulsaciones')!="" ? $request->input('pulsaciones') : "";
	$signos_vitales->altura = $request->input('altura')!="" ? $request->input('altura') : "";
	$signos_vitales->peso = $request->input('peso')!="" ? $request->input('peso') : "";
	$signos_vitales->comentarios = $request->input('comentarios')!="" ? $request->input('comentarios') : "";
	$signos_vitales->status = $request->input('status')!="" ? $request->input('status') : "";

        $signos_vitales->save();
        return true;
    }
}
