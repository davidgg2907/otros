<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Solicitados extends Model
{
    protected $table = 'farmacia_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

}


class Farmacia extends Model
{
    protected $table = 'farmacia';
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

    public function getFarmacia($id){
      $data =  Farmacia::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getFarmaciaView($id){
      $farmacia = Farmacia::select(array('farmacia.*' , 'cuartos.numero' , 'enfermeria.nombre' , 'medicos.nombre' , 'asistentes.nombre'));
      $farmacia->where('farmacia.id', $id);
      $farmacia->leftJoin('cuartos', 'farmacia.cuarto_id', '=','cuartos.id');$farmacia->leftJoin('enfermeria', 'farmacia.enfermera_id', '=','enfermeria.id');$farmacia->leftJoin('medicos', 'farmacia.medico_id', '=','medicos.id');$farmacia->leftJoin('asistentes', 'farmacia.asistente_id', '=','asistentes.id');
      return $farmacia->get()[0];

    }

    public function changeStatus($field, $id){
      $farmacia = $this->getFarmacia($id);
      if(count($farmacia)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $farmacia = $this->getFarmacia($id);
      if(count($farmacia)){
        $farmacia->status = $num;
        if($num ==2) {
          $farmacia->fecha_surtido = date('Y-m-d');
        }
        $farmacia->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $farmacia = $this->getFarmacia($id);
      if(count($farmacia)){
        $img = public_path().'/uploads/'.$farmacia->featured_img;
            if($farmacia->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $farmacia->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getFarmaciaData($per_page, $request, $sortBy, $order){
      $farmacia = Farmacia::select(array('farmacia.*' , 'cuartos.numero' , 'enfermeria.nombre' , 'medicos.nombre' , 'asistentes.nombre'));

      //join
        $farmacia->leftJoin('cuartos', 'farmacia.cuarto_id', '=','cuartos.id');$farmacia->leftJoin('enfermeria', 'farmacia.enfermera_id', '=','enfermeria.id');$farmacia->leftJoin('medicos', 'farmacia.medico_id', '=','medicos.id');$farmacia->leftJoin('asistentes', 'farmacia.asistente_id', '=','asistentes.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $farmacia->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $farmacia->orderBy($sortBy, $order);
        } else{
          $farmacia->orderBy('farmacia.id', 'desc');
        }

        return $farmacia->paginate($per_page);
    }

    public function getFarmaciaExport($searchBy, $searchValue, $sortBy, $order){
      $farmacia = Farmacia::select(array('farmacia.*' , 'cuartos.numero' , 'enfermeria.nombre' , 'medicos.nombre' , 'asistentes.nombre'));

      //join
        $farmacia->leftJoin('cuartos', 'farmacia.cuarto_id', '=','cuartos.id');$farmacia->leftJoin('enfermeria', 'farmacia.enfermera_id', '=','enfermeria.id');$farmacia->leftJoin('medicos', 'farmacia.medico_id', '=','medicos.id');$farmacia->leftJoin('asistentes', 'farmacia.asistente_id', '=','asistentes.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $farmacia->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $farmacia->orderBy($sortBy, $order);
        } else{
          $farmacia->orderBy('farmacia.id', 'desc');
        }
        return $farmacia->get();
    }

    public function updateFarmacia($request){
      $id = $request->input('id');
      $farmacia = Farmacia::getFarmacia($id);
      if(count($farmacia)){

        $farmacia->cuarto_id       = $request->input('cuarto_id')!="" ? $request->input('cuarto_id') : "";
        $farmacia->solicitado      = $request->input('solicitado')!="" ? $request->input('solicitado') : "";
        $farmacia->comentarios     = null;

          $farmacia->save();
          $this->addDetalle($request->input('solicitados'),$id);
          return true;
      } else{
        return false;
      }
    }

    public function addFarmacia($request){
      $farmacia = new Farmacia;

        $farmacia->cuarto_id       = $request->input('cuarto_id')!="" ? $request->input('cuarto_id') : "";
      	$farmacia->enfermera_id    = (int)Auth::user()->enfermera_id;
      	$farmacia->medico_id       = (int)Auth::user()->enfermera_id;
      	$farmacia->asistente_id    = (int)Auth::user()->enfermera_id;
        $farmacia->solicitante     = Auth::user()->name;
      	$farmacia->fecha_registro  = date('Y-m-d H:i:s');
        $farmacia->fecha_surtido   = null;
        $farmacia->solicitado      = $request->input('solicitado')!="" ? $request->input('solicitado') : "";
        $farmacia->comentarios     = null;
      	$farmacia->status          = 1;

        $farmacia->save();

        return true;

    }

    public function enfermera() {

      return $this->hasOne('\App\admin\Enfermeria', 'id', 'enfermera_id');

    }

    public function doctor() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');

    }

    public function cuarto() {

      return $this->hasOne('\App\admin\Cuartos', 'id', 'cuarto_id');

    }

    public function asistente() {

      return $this->hasOne('\App\admin\Asistentes', 'id', 'asistente_id');

    }

}
