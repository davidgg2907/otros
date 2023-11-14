<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Almacenes extends Model
{
    protected $table = 'almacenes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getAlmacenes($id){
      $data =  Almacenes::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAlmacenesView($id){
      $almacenes = Almacenes::select(array('almacenes.*'));
      $almacenes->where('almacenes.id', $id);

      return $almacenes->get()[0];

    }

    public function updateStatus($id, $num){
      $almacenes = $this->getAlmacenes($id);
      if(count($almacenes)){
        $almacenes->status = $num;
        $almacenes->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $almacenes = $this->getAlmacenes($id);
      if(count($almacenes)){
        $img = public_path().'/uploads/'.$almacenes->featured_img;
            if($almacenes->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $almacenes->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAlmacenesData($per_page, $request, $sortBy, $order){
      $almacenes = Almacenes::select(array('almacenes.*'));

      //join
      if($request->input('tienda_id') != "") {
        $almacenes->where('tienda_id',$request->input('tienda_id'));
      }

      if($request->input('nombre') != "") {
        $almacenes->where('nombre','LIKE','%' . $request->input('nombre') . '%');
      }

      if($request->input('fisico_digital') != "") {
        $almacenes->where('fisico_digital',$request->input('fisico_digital'));
      }

      $almacenes->where('status',1);
        // sort option
        $almacenes->orderBy('almacenes.id', 'desc');

        return $almacenes->paginate($per_page);
    }

    public function getAlmacenesExport($request){
      $almacenes = Almacenes::select(array('almacenes.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $almacenes->where('almacenes.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $almacenes->orderBy('almacenes.id', 'desc');

        return $almacenes->get();
    }

    public function updateAlmacenes($request){
      $id = $request->input('id');
      $almacenes = Almacenes::getAlmacenes($id);
      if(count($almacenes)){

          $almacenes->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : "";
        	$almacenes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$almacenes->fisico_digital = $request->input('fisico_digital')!="" ? $request->input('fisico_digital') : "";

          $almacenes->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAlmacenes($request){
      $almacenes = new Almacenes;

        $almacenes->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : "";
      	$almacenes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$almacenes->fisico_digital = $request->input('fisico_digital')!="" ? $request->input('fisico_digital') : "";
      	$almacenes->status = $request->input('status')!="" ? $request->input('status') : "1";

        $almacenes->save();
        return true;
    }

    public function tienda() {
      return $this->hasOne(\App\admin\Tiendas::class,'id','tienda_id');
    }

}
