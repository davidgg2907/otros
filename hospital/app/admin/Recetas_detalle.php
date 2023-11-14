<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Recetas_detalle extends Model
{
    protected $table = 'recetas_detalle';
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

    public function getRecetas_detalle($id){
      $data =  Recetas_detalle::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getRecetas_detalleView($id){
      $recetas_detalle = Recetas_detalle::select(array('recetas_detalle.*' , 'medicamentos.comercial'));
      $recetas_detalle->where('recetas_detalle.id', $id);
      $recetas_detalle->leftJoin('medicamentos', 'recetas_detalle.receta_id', '=','medicamentos.id');
      return $recetas_detalle->get()[0];

    }

    public function changeStatus($field, $id){
      $recetas_detalle = $this->getRecetas_detalle($id);
      if(count($recetas_detalle)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $recetas_detalle = $this->getRecetas_detalle($id);
      if(count($recetas_detalle)){
        $recetas_detalle->status = $num;
        $recetas_detalle->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $recetas_detalle = $this->getRecetas_detalle($id);
      if(count($recetas_detalle)){
        $img = public_path().'/uploads/'.$recetas_detalle->featured_img;
            if($recetas_detalle->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $recetas_detalle->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getRecetas_detalleData($per_page, $request, $sortBy, $order){
      $recetas_detalle = Recetas_detalle::select(array('recetas_detalle.*' , 'medicamentos.comercial'));

      //join
        $recetas_detalle->leftJoin('medicamentos', 'recetas_detalle.receta_id', '=','medicamentos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $recetas_detalle->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $recetas_detalle->orderBy($sortBy, $order);
        } else{
          $recetas_detalle->orderBy('recetas_detalle.id', 'desc');
        }

        return $recetas_detalle->paginate($per_page);
    }

    public function getRecetas_detalleExport($searchBy, $searchValue, $sortBy, $order){
      $recetas_detalle = Recetas_detalle::select(array('recetas_detalle.*' , 'medicamentos.comercial'));

      //join
        $recetas_detalle->leftJoin('medicamentos', 'recetas_detalle.receta_id', '=','medicamentos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $recetas_detalle->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $recetas_detalle->orderBy($sortBy, $order);
        } else{
          $recetas_detalle->orderBy('recetas_detalle.id', 'desc');
        }
        return $recetas_detalle->get();
    }

    public function updateRecetas_detalle($request){
      $id = $request->input('id');
      $recetas_detalle = Recetas_detalle::getRecetas_detalle($id);
      if(count($recetas_detalle)){

          $recetas_detalle->receta_id = $request->input('receta_id')!="" ? $request->input('receta_id') : "";
	$recetas_detalle->medicamento_id = $request->input('medicamento_id')!="" ? $request->input('medicamento_id') : "";
	$recetas_detalle->dosificacion = $request->input('dosificacion')!="" ? $request->input('dosificacion') : "";
	$recetas_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

          $recetas_detalle->save();
          return true;
      } else{
        return false;
      }
    }

    public function addRecetas_detalle($request){
      $recetas_detalle = new Recetas_detalle;

        $recetas_detalle->receta_id = $request->input('receta_id')!="" ? $request->input('receta_id') : "";
	$recetas_detalle->medicamento_id = $request->input('medicamento_id')!="" ? $request->input('medicamento_id') : "";
	$recetas_detalle->dosificacion = $request->input('dosificacion')!="" ? $request->input('dosificacion') : "";
	$recetas_detalle->status = $request->input('status')!="" ? $request->input('status') : "";

        $recetas_detalle->save();
        return true;
    }
}
