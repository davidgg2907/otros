<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Ambulancias extends Model
{
    protected $table = 'ambulancias';
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

    public function getAmbulancias($id){
      $data =  Ambulancias::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAmbulanciasView($id){
      $ambulancias = Ambulancias::select(array('ambulancias.*'));
      $ambulancias->where('ambulancias.id', $id);

      return $ambulancias->get()[0];

    }

    public function changeStatus($field, $id){
      $ambulancias = $this->getAmbulancias($id);
      if(count($ambulancias)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $ambulancias = $this->getAmbulancias($id);
      if(count($ambulancias)){
        $ambulancias->status = $num;
        $ambulancias->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $ambulancias = $this->getAmbulancias($id);
      if(count($ambulancias)){
        $img = public_path().'/uploads/'.$ambulancias->featured_img;
            if($ambulancias->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $ambulancias->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAmbulanciasData($per_page, $request, $sortBy, $order){

      $ambulancias = Ambulancias::select(array('ambulancias.*'));

        // where condition
        if($request->input('servicio') != ''){
          $ambulancias->where('ambulancias.servicio', 'like', '%' . $request->input('servicio') . '%');
        }

        if($request->input('unidad') != ''){
          $ambulancias->where('ambulancias.unidad', 'like', '%' . $request->input('unidad') . '%');
        }

        if($request->input('chofer') != ''){
          $ambulancias->where('ambulancias.chofer', 'like', '%' . $request->input('chofer') . '%');
        }

        if($request->input('enfermera') != ''){
          $ambulancias->where('ambulancias.enfermera', 'like', '%' . $request->input('enfermera') . '%');
        }

        if($request->input('medico') != ''){
          $ambulancias->where('ambulancias.medico', 'like', '%' . $request->input('medico') . '%');
        }

        if($request->input('paciente') != ''){
          $ambulancias->where('ambulancias.paciente', 'like', '%' . $request->input('paciente') . '%');
        }

        if($request->input('origen') != ''){
          $ambulancias->where('ambulancias.origen', 'like', '%' . $request->input('origen') . '%');
        }

        if($request->input('destino') != ''){
          $ambulancias->where('ambulancias.destino', 'like', '%' . $request->input('destino') . '%');
        }

        $ambulancias->where('ambulancias.status', 1);

        $ambulancias->orderBy('ambulancias.id', 'desc');


        return $ambulancias->paginate($per_page);
    }

    public function getAmbulanciasExport($searchBy, $searchValue, $sortBy, $order){
      $ambulancias = Ambulancias::select(array('ambulancias.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $ambulancias->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $ambulancias->orderBy($sortBy, $order);
        } else{
          $ambulancias->orderBy('ambulancias.id', 'desc');
        }
        return $ambulancias->get();
    }

    public function updateAmbulancias($request){
      $id = $request->input('id');
      $ambulancias = Ambulancias::getAmbulancias($id);
      if(count($ambulancias)){

      	$ambulancias->servicio = $request->input('servicio')!="" ? $request->input('servicio') : "";
      	$ambulancias->unidad = $request->input('unidad')!="" ? $request->input('unidad') : "";
      	$ambulancias->chofer = $request->input('chofer')!="" ? $request->input('chofer') : "";
      	$ambulancias->enfermera = $request->input('enfermera')!="" ? $request->input('enfermera') : "";
      	$ambulancias->medico = $request->input('medico')!="" ? $request->input('medico') : "";
      	$ambulancias->paciente = $request->input('paciente')!="" ? $request->input('paciente') : "";
      	$ambulancias->acompanante = $request->input('acompanante')!="" ? $request->input('acompanante') : "";
      	$ambulancias->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
      	$ambulancias->origen = $request->input('origen')!="" ? $request->input('origen') : "";
      	$ambulancias->destino = $request->input('destino')!="" ? $request->input('destino') : "";
      	$ambulancias->comentario = $request->input('comentario')!="" ? $request->input('comentario') : "";

        $ambulancias->save();
        return true;
      } else{
        return false;
      }
    }

    public function addAmbulancias($request){
      $ambulancias = new Ambulancias;

        $ambulancias->fecha = date('Y-m-d');
      	$ambulancias->servicio = $request->input('servicio')!="" ? $request->input('servicio') : "";
      	$ambulancias->unidad = $request->input('unidad')!="" ? $request->input('unidad') : "";
      	$ambulancias->chofer = $request->input('chofer')!="" ? $request->input('chofer') : "";
      	$ambulancias->enfermera = $request->input('enfermera')!="" ? $request->input('enfermera') : "";
      	$ambulancias->medico = $request->input('medico')!="" ? $request->input('medico') : "";
      	$ambulancias->paciente = $request->input('paciente')!="" ? $request->input('paciente') : "";
      	$ambulancias->acompanante = $request->input('acompanante')!="" ? $request->input('acompanante') : "";
      	$ambulancias->diagnostico = $request->input('diagnostico')!="" ? $request->input('diagnostico') : "";
      	$ambulancias->origen = $request->input('origen')!="" ? $request->input('origen') : "";
      	$ambulancias->destino = $request->input('destino')!="" ? $request->input('destino') : "";
      	$ambulancias->comentario = $request->input('comentario')!="" ? $request->input('comentario') : "";
      	$ambulancias->status = 1;

        $ambulancias->save();
        return true;
    }
}
