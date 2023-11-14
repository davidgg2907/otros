<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Insumos extends Model
{
    protected $table = 'insumos';
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

    public function getInsumos($id){
      $data =  Insumos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getInsumosView($id){
      $insumos = Insumos::select(array('insumos.*'));
      $insumos->where('insumos.id', $id);

      return $insumos->get()[0];

    }

    public function changeStatus($field, $id){
      $insumos = $this->getInsumos($id);
      if(count($insumos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $insumos = $this->getInsumos($id);
      if(count($insumos)){
        $insumos->status = $num;
        $insumos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $insumos = $this->getInsumos($id);
      if(count($insumos)){
        $img = public_path().'/uploads/'.$insumos->featured_img;
            if($insumos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $insumos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getInsumosData($per_page, $request, $sortBy, $order){
      $insumos = Insumos::select(array('insumos.*'));

      //join


        // where condition
        if($request->input('nombre') != ""){
          $insumos->where('nombre','LIKE','%' . $request->input('nombre') . '%');
          $insumos->orWhere('descripcion','LIKE','%' . $request->input('nombre') . '%');
        }

        $insumos->where('status',1);

        // sort option
        if($sortBy!='' && $order!=''){
          $insumos->orderBy($sortBy, $order);
        } else{
          $insumos->orderBy('insumos.id', 'desc');
        }

        return $insumos->paginate($per_page);
    }

    public function getInsumosExport($searchBy, $searchValue, $sortBy, $order){
      $insumos = Insumos::select(array('insumos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $insumos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $insumos->orderBy($sortBy, $order);
        } else{
          $insumos->orderBy('insumos.id', 'desc');
        }
        return $insumos->get();
    }

    public function updateInsumos($request){
      $id = $request->input('id');
      $insumos = Insumos::getInsumos($id);
      if(count($insumos)){

          $insumos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$insumos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
	$insumos->caducidad = $request->input('caducidad')!="" ? $request->input('caducidad') : "";
	$insumos->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$insumos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$insumos->status = $request->input('status')!="" ? $request->input('status') : "";

          $insumos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addInsumos($request){
      $insumos = new Insumos;

        $insumos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$insumos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
	$insumos->caducidad = $request->input('caducidad')!="" ? $request->input('caducidad') : "";
	$insumos->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$insumos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$insumos->status = $request->input('status')!="" ? $request->input('status') : "";

        $insumos->save();
        return true;
    }
}
