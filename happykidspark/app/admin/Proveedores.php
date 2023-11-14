<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getProveedores($id){
      $data =  Proveedores::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getProveedoresView($id){
      $proveedores = Proveedores::select(array('proveedores.*'));
      $proveedores->where('proveedores.id', $id);

      return $proveedores->get()[0];

    }

    public function updateStatus($id, $num){
      $proveedores = $this->getProveedores($id);
      if(count($proveedores)){
        $proveedores->status = $num;
        $proveedores->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $proveedores = $this->getProveedores($id);
      if(count($proveedores)){
        $img = public_path().'/uploads/'.$proveedores->featured_img;
            if($proveedores->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $proveedores->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getProveedoresData($per_page, $request, $sortBy, $order){
      $proveedores = Proveedores::select(array('proveedores.*'));

      //join
      if($request->input('nombre') != "") {
        $proveedores->where('nombre', 'LIKE', '%' . $request->input('nombre') . '%');
      }

      if($request->input('vendedor') != "") {
        $proveedores->where('vendedor', 'LIKE', '%' . $request->input('vendedor') . '%');
      }

      if($request->input('telefono') != "") {
        $proveedores->where('celular', 'LIKE', '%' . $request->input('telefono') . '%');
      }

      if($request->input('celular') != "") {
        $proveedores->where('vededor_celular', 'LIKE', '%' . $request->input('celular') . '%');
      }

      if($request->input('correo') != "") {
        $proveedores->where('vendedor_correo', 'LIKE', '%' . $request->input('correo') . '%');
      }

      // sort option
      $proveedores->orderBy('proveedores.id', 'desc');

      return $proveedores->paginate($per_page);
    }

    public function getProveedoresExport($request){
      $proveedores = Proveedores::select(array('proveedores.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $proveedores->where('proveedores.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $proveedores->orderBy('proveedores.id', 'desc');

        return $proveedores->get();
    }

    public function updateProveedores($request){
      $id = $request->input('id');
      $proveedores = Proveedores::getProveedores($id);
      if(count($proveedores)){

          $proveedores->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$proveedores->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
	$proveedores->celular = $request->input('celular')!="" ? $request->input('celular') : "";
	$proveedores->correo = $request->input('correo')!="" ? $request->input('correo') : "";
	$proveedores->vendedor = $request->input('vendedor')!="" ? $request->input('vendedor') : "";
	$proveedores->vededor_celular = $request->input('vededor_celular')!="" ? $request->input('vededor_celular') : "";
	$proveedores->vendedor_correo = $request->input('vendedor_correo')!="" ? $request->input('vendedor_correo') : "";
	$proveedores->status = $request->input('status')!="" ? $request->input('status') : "";

          $proveedores->save();
          return true;
      } else{
        return false;
      }
    }

    public function addProveedores($request){
      $proveedores = new Proveedores;

        $proveedores->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$proveedores->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
	$proveedores->celular = $request->input('celular')!="" ? $request->input('celular') : "";
	$proveedores->correo = $request->input('correo')!="" ? $request->input('correo') : "";
	$proveedores->vendedor = $request->input('vendedor')!="" ? $request->input('vendedor') : "";
	$proveedores->vededor_celular = $request->input('vededor_celular')!="" ? $request->input('vededor_celular') : "";
	$proveedores->vendedor_correo = $request->input('vendedor_correo')!="" ? $request->input('vendedor_correo') : "";
	$proveedores->status = $request->input('status')!="" ? $request->input('status') : "";

        $proveedores->save();
        return true;
    }
}
