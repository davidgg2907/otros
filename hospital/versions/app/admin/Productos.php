<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
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

    public function getProductos($id){
      $data =  Productos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getByScope($scope){
      $data =  Productos::where('scope', $scope)
                        ->where('status', 1)
                        ->get();
      if(count($data)){
        return $data;
      } else{
        return array();
      }
    }

    public function getProductosView($id){
      $productos = Productos::select(array('productos.*'));
      $productos->where('productos.id', $id);

      return $productos->get()[0];

    }

    public function changeStatus($field, $id){
      $productos = $this->getProductos($id);
      if(count($productos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $productos = $this->getProductos($id);
      if(count($productos)){
        $productos->status = $num;
        $productos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $productos = $this->getProductos($id);
      if(count($productos)){
        $img = public_path().'/uploads/'.$productos->featured_img;
            if($productos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $productos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getProductosData($per_page, $request, $sortBy, $order){
      $productos = Productos::select(array('productos.*'));

      //join


        // where condition
        if($request->input('nombre') !=''){
          $productos->where('descripcion', 'LIKE', '%' . $request->input('nombre') . '%');
        }

        if($request->input('scope') !=''){
          $productos->where('scope', 'LIKE', '%' . $request->input('scope') . '%');
        }

        $productos->where('status', 1);

        // sort option
        if($sortBy!='' && $order!=''){
          $productos->orderBy($sortBy, $order);
        } else{
          $productos->orderBy('productos.id', 'desc');
        }

        return $productos->paginate($per_page);
    }

    public function getProductosExport($searchBy, $searchValue, $sortBy, $order){
      $productos = Productos::select(array('productos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $productos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $productos->orderBy($sortBy, $order);
        } else{
          $productos->orderBy('productos.id', 'desc');
        }
        return $productos->get();
    }

    public function updateProductos($request){
      $id = $request->input('id');
      $productos = Productos::getProductos($id);
      if(count($productos)){

        $productos->scope = $request->input('scope')!="" ? $request->input('scope') : 0;
      	$productos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
      	$productos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
      	$productos->iva = $request->input('iva')!="" ? $request->input('iva') : "";
      	$productos->valor_iva = $request->input('valor_iva')!="" ? $request->input('valor_iva') : "";
      	$productos->precio_neto = $request->input('precio_neto')!="" ? $request->input('precio_neto') : "";
      	$productos->status = $request->input('status')!="" ? $request->input('status') : "";

          $productos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addProductos($request){
      $productos = new Productos;
      $productos->scope = $request->input('scope')!="" ? $request->input('scope') : "";
    	$productos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
    	$productos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
    	$productos->iva = $request->input('iva')!="" ? $request->input('iva') : "";
    	$productos->valor_iva = $request->input('valor_iva')!="" ? $request->input('valor_iva') : "";
    	$productos->precio_neto = $request->input('precio_neto')!="" ? $request->input('precio_neto') : "";
    	$productos->status = $request->input('status')!="" ? $request->input('status') : "";

        $productos->save();
        return true;
    }
}
