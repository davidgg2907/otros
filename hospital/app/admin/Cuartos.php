<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cuartos extends Model
{
    protected $table = 'cuartos';
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

    public function getCuartos($id){
      $data =  Cuartos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCuartosView($id){
      $cuartos = Cuartos::select(array('cuartos.*'));
      $cuartos->where('cuartos.id', $id);

      return $cuartos->get()[0];

    }

    public function changeStatus($field, $id){
      $cuartos = $this->getCuartos($id);
      if(count($cuartos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $cuartos = $this->getCuartos($id);
      if(count($cuartos)){
        $cuartos->status = $num;
        $cuartos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $cuartos = $this->getCuartos($id);
      if(count($cuartos)){
        $img = public_path().'/uploads/'.$cuartos->featured_img;
            if($cuartos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $cuartos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCuartosData($per_page, $request, $sortBy, $order){
      $cuartos = Cuartos::select(array('cuartos.*'));

      //join
      if($request->input('descripcion') != ""){
        $cuartos->where("descripcion", 'LIKE', '%' . $request->input('descripcion') . '%');
      }

      if($request->input('numero') != ""){
        $cuartos->where("numero", 'LIKE', '%' . $request->input('numero') . '%');
      }

        $cuartos->where('status','!=',0);

        // sort option
        if($sortBy!='' && $order!=''){
          $cuartos->orderBy($sortBy, $order);
        } else{
          $cuartos->orderBy('cuartos.id', 'desc');
        }

        return $cuartos->paginate($per_page);
    }

    public function getCuartosExport($searchBy, $searchValue, $sortBy, $order){
      $cuartos = Cuartos::select(array('cuartos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $cuartos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $cuartos->orderBy($sortBy, $order);
        } else{
          $cuartos->orderBy('cuartos.id', 'desc');
        }
        return $cuartos->get();
    }

    public function updateCuartos($request){
      $id = $request->input('id');
      $cuartos = Cuartos::getCuartos($id);
      if(count($cuartos)){

          $cuartos->numero = $request->input('numero')!="" ? $request->input('numero') : "";
        	$cuartos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
        	$cuartos->amenidades = $request->input('amenidades')!="" ? $request->input('amenidades') : "";
        	$cuartos->equipo = $request->input('equipo')!="" ? $request->input('equipo') : "";
        	$cuartos->costo_dia = $request->input('costo_dia')!="" ? $request->input('costo_dia') : "";

          $cuartos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCuartos($request){
      $cuartos = new Cuartos;

        $cuartos->numero = $request->input('numero')!="" ? $request->input('numero') : "";
	$cuartos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
	$cuartos->amenidades = $request->input('amenidades')!="" ? $request->input('amenidades') : "";
	$cuartos->equipo = $request->input('equipo')!="" ? $request->input('equipo') : "";
	$cuartos->costo_dia = $request->input('costo_dia')!="" ? $request->input('costo_dia') : "";
	$cuartos->status = $request->input('status')!="" ? $request->input('status') : "";

        $cuartos->save();
        return true;
    }
}
