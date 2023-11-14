<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    protected $table = 'ordenes';
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

    public function getOrdenes($id){
      $data =  Ordenes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getOrdenesView($id){
      $ordenes = Ordenes::select(array('ordenes.*' , 'medicos.nombre' , 'enfermeria.nombre'));
      $ordenes->where('ordenes.id', $id);
      $ordenes->leftJoin('medicos', 'ordenes.medico_id', '=','medicos.id');$ordenes->leftJoin('enfermeria', 'ordenes.paciente_id', '=','enfermeria.id');
      return $ordenes->get()[0];

    }

    public function changeStatus($field, $id){
      $ordenes = $this->getOrdenes($id);
      if(count($ordenes)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $ordenes = $this->getOrdenes($id);
      if(count($ordenes)){
        $ordenes->status = $num;
        $ordenes->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $ordenes = $this->getOrdenes($id);
      if(count($ordenes)){
        $img = public_path().'/uploads/'.$ordenes->featured_img;
            if($ordenes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $ordenes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getOrdenesData($per_page, $request, $sortBy, $order){
      $ordenes = Ordenes::select(array('ordenes.*' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $ordenes->leftJoin('medicos', 'ordenes.medico_id', '=','medicos.id');$ordenes->leftJoin('enfermeria', 'ordenes.paciente_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $ordenes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $ordenes->orderBy($sortBy, $order);
        } else{
          $ordenes->orderBy('ordenes.id', 'desc');
        }

        return $ordenes->paginate($per_page);
    }

    public function getOrdenesExport($searchBy, $searchValue, $sortBy, $order){
      $ordenes = Ordenes::select(array('ordenes.*' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $ordenes->leftJoin('medicos', 'ordenes.medico_id', '=','medicos.id');$ordenes->leftJoin('enfermeria', 'ordenes.paciente_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $ordenes->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $ordenes->orderBy($sortBy, $order);
        } else{
          $ordenes->orderBy('ordenes.id', 'desc');
        }
        return $ordenes->get();
    }

    public function updateOrdenes($request){
      $id = $request->input('id');
      $ordenes = Ordenes::getOrdenes($id);
      if(count($ordenes)){

          $ordenes->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$ordenes->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$ordenes->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$ordenes->fecha_solicitud = $request->input('fecha_solicitud')!="" ? $request->input('fecha_solicitud') : "";
	$ordenes->fecha_aplicacion = $request->input('fecha_aplicacion')!="" ? $request->input('fecha_aplicacion') : "";
	$ordenes->comentarios = $request->input('comentarios')!="" ? $request->input('comentarios') : "";
	$ordenes->status = $request->input('status')!="" ? $request->input('status') : "";

          $ordenes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addOrdenes($request){
      $ordenes = new Ordenes;

        $ordenes->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$ordenes->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$ordenes->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$ordenes->fecha_solicitud = $request->input('fecha_solicitud')!="" ? $request->input('fecha_solicitud') : "";
	$ordenes->fecha_aplicacion = $request->input('fecha_aplicacion')!="" ? $request->input('fecha_aplicacion') : "";
	$ordenes->comentarios = $request->input('comentarios')!="" ? $request->input('comentarios') : "";
	$ordenes->status = $request->input('status')!="" ? $request->input('status') : "";

        $ordenes->save();
        return true;
    }
}
