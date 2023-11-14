<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getClientes($id){
      $data =  Clientes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getClientesView($id){
      $clientes = Clientes::select(array('clientes.*'));
      $clientes->where('clientes.id', $id);

      return $clientes->get()[0];

    }

    public function updateStatus($id, $num){
      $clientes = $this->getClientes($id);
      if(count($clientes)){
        $clientes->status = $num;
        $clientes->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $clientes = $this->getClientes($id);
      if(count($clientes)){
        $img = public_path().'/uploads/'.$clientes->featured_img;
            if($clientes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $clientes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getClientesData($per_page, $request, $sortBy, $order){
      $clientes = Clientes::select(array('clientes.*'));

      //join
        $clientes->where('status', 1);

        // sort option
        $clientes->orderBy('clientes.id', 'desc');

        return $clientes->paginate($per_page);
    }

    public function getClientesExport($request){
      $clientes = Clientes::select(array('clientes.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $clientes->where('clientes.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $clientes->orderBy('clientes.id', 'desc');

        return $clientes->get();
    }

    public function updateClientes($request){
      $id = $request->input('id');
      $clientes = Clientes::getClientes($id);
      if(count($clientes)){

          $clientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$clientes->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
	$clientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$clientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
	$clientes->status = $request->input('status')!="" ? $request->input('status') : "";

          $clientes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addClientes($request){
      $clientes = new Clientes;

        $clientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$clientes->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
	$clientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$clientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
	$clientes->status = $request->input('status')!="" ? $request->input('status') : "";

        $clientes->save();
        return true;
    }
}
