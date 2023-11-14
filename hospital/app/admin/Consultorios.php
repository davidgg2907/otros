<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Consultorios extends Model
{
    protected $table = 'consultorios';
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

    public function getConsultorios($id){
      $data =  Consultorios::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getConsultoriosView($id){
      $consultorios = Consultorios::select(array('consultorios.*' , 'medicos.nombre' , 'enfermeria.nombre'));
      $consultorios->where('consultorios.id', $id);
      $consultorios->leftJoin('medicos', 'consultorios.medico_id', '=','medicos.id');$consultorios->leftJoin('enfermeria', 'consultorios.enfermera_id', '=','enfermeria.id');
      return $consultorios->get()[0];

    }

    public function changeStatus($field, $id){
      $consultorios = $this->getConsultorios($id);
      if(count($consultorios)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $consultorios = $this->getConsultorios($id);
      if(count($consultorios)){
        $consultorios->status = $num;
        $consultorios->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $consultorios = $this->getConsultorios($id);
      if(count($consultorios)){
        $img = public_path().'/uploads/'.$consultorios->featured_img;
            if($consultorios->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $consultorios->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getConsultoriosData($per_page, $request, $sortBy, $order){
      $consultorios = Consultorios::select(array('consultorios.*' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $consultorios->leftJoin('medicos', 'consultorios.medico_id', '=','medicos.id');
        $consultorios->leftJoin('enfermeria', 'consultorios.enfermera_id', '=','enfermeria.id');

        // where condition
        if($request->input('consultorio') != ""){
          $consultorios->where('numero','LIKE','%' . $request->input('consultorio') . '%');
        }

        if($request->input('descripcion') != ""){
          $consultorios->where('descripcion','LIKE','%' . $request->input('descripcion') . '%');
        }


        $consultorios->where('consultorios.status',1);

        if((int)Auth::user()->enfermera_id != 0) {

          $consultorios->where('enfermera_id',Auth::user()->enfermera_id);

        }

        if((int)Auth::user()->medico_id != 0) {

          $consultorios->where('medico_id',Auth::user()->medico_id);

        }

        // sort option
        if($sortBy!='' && $order!=''){
          $consultorios->orderBy($sortBy, $order);
        } else{
          $consultorios->orderBy('consultorios.id', 'desc');
        }

        return $consultorios->paginate($per_page);
    }

    public function getConsultoriosExport($searchBy, $searchValue, $sortBy, $order){
      $consultorios = Consultorios::select(array('consultorios.*' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $consultorios->leftJoin('medicos', 'consultorios.medico_id', '=','medicos.id');$consultorios->leftJoin('enfermeria', 'consultorios.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $consultorios->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $consultorios->orderBy($sortBy, $order);
        } else{
          $consultorios->orderBy('consultorios.id', 'desc');
        }
        return $consultorios->get();
    }

    public function updateConsultorios($request){
      $id = $request->input('id');
      $consultorios = Consultorios::getConsultorios($id);
      if(count($consultorios)){

        $consultorios->consultorio = $request->input('consultorio')!="" ? $request->input('consultorio') : "";
        $consultorios->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
      	$consultorios->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
      	$consultorios->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : "";
      	$consultorios->dia_laboral = $request->input('dia_laboral')!="" ? $request->input('dia_laboral') : "";
      	$consultorios->hora_inicio = $request->input('hora_inicio')!="" ? $request->input('hora_inicio') : "";
      	$consultorios->hora_fin = $request->input('hora_fin')!="" ? $request->input('hora_fin') : "";
      	$consultorios->status = $request->input('status')!="" ? $request->input('status') : "";

          $consultorios->save();
          return true;
      } else{
        return false;
      }
    }

    public function addConsultorios($request){
      $consultorios = new Consultorios;

        $consultorios->numero = $request->input('consultorio')!="" ? $request->input('consultorio') : "";
        $consultorios->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
      	$consultorios->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
      	$consultorios->enfermera_id = $request->input('enfermera_id')!="" ? $request->input('enfermera_id') : "";
      	$consultorios->dia_laboral = $request->input('dia_laboral')!="" ? $request->input('dia_laboral') : "";
      	$consultorios->hora_inicio = $request->input('hora_inicio')!="" ? $request->input('hora_inicio') : "";
      	$consultorios->hora_fin = $request->input('hora_fin')!="" ? $request->input('hora_fin') : "";
      	$consultorios->status = $request->input('status')!="" ? $request->input('status') : "";

        $consultorios->save();
        return true;
    }

    public function medico() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');

    }

    public function enfermeria() {

      return $this->hasOne('\App\admin\Enfermeria', 'id', 'enfermera_id');

    }

}
