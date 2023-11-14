<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Tiendas extends Model
{
    protected $table = 'tiendas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getTiendas($id){
      $data =  Tiendas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getTiendasView($id){
      $tiendas = Tiendas::select(array('tiendas.*'));
      $tiendas->where('tiendas.id', $id);

      return $tiendas->get()[0];

    }

    public function updateStatus($id, $num){
      $tiendas = $this->getTiendas($id);
      if(count($tiendas)){
        $tiendas->status = $num;
        $tiendas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $tiendas = $this->getTiendas($id);
      if(count($tiendas)){
        $img = public_path().'/uploads/'.$tiendas->featured_img;
            if($tiendas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $tiendas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getTiendasData($per_page, $request, $sortBy, $order){
      $tiendas = Tiendas::select(array('tiendas.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $tiendas->where('tiendas.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $tiendas->where('tiendas.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $tiendas->where('tiendas.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $tiendas->orderBy('tiendas.id', 'desc');

        return $tiendas->paginate($per_page);
    }

    public function getTiendasExport($request){
      $tiendas = Tiendas::select(array('tiendas.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $tiendas->where('tiendas.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $tiendas->orderBy('tiendas.id', 'desc');

        return $tiendas->get();
    }

    public function updateTiendas($request){
      $id = $request->input('id');
      $tiendas = Tiendas::getTiendas($id);
      if(count($tiendas)){

      	$tiendas->plataforma = $request->input('plataforma')!="" ? $request->input('plataforma') : "";
      	$tiendas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        $tiendas->save();
        return true;
      } else{
        return false;
      }
    }

    public function addTiendas($request){
      $tiendas = new Tiendas;

    	$tiendas->plataforma = $request->input('plataforma')!="" ? $request->input('plataforma') : "";
    	$tiendas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
    	$tiendas->status = $request->input('status')!="" ? $request->input('status') : "";

        $tiendas->save();
        return true;
    }
}
