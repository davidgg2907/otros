<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table = 'gastos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getGastos($id){
      $data =  Gastos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getGastosView($id){
      $gastos = Gastos::select(array('gastos.*'));
      $gastos->where('gastos.id', $id);

      return $gastos->get()[0];

    }

    public function updateStatus($id, $num){
      $gastos = $this->getGastos($id);
      if(count($gastos)){
        $gastos->status = $num;
        $gastos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $gastos = $this->getGastos($id);
      if(count($gastos)){
        $img = public_path().'/uploads/'.$gastos->featured_img;
            if($gastos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $gastos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getGastosData($per_page, $request, $sortBy, $order){
      $gastos = Gastos::select(array('gastos.*'));

      //join
      if($request->input('tienda_id') != "") {
        $gastos->where('tienda_id',$request->input('tienda_id'));
      }

      if($request->input('clasificacion') != "") {
        $gastos->where('clasificacion',$request->input('clasificacion'));
      }

      if($request->input('fgasto') != "") {
        $gastos->where('fgasto',$request->input('fgasto'));
      }


        // sort option
        $gastos->orderBy('gastos.id', 'desc');

        return $gastos->paginate($per_page);
    }

    public function getGastosExport($request){
      $gastos = Gastos::select(array('gastos.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $gastos->where('gastos.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $gastos->orderBy('gastos.id', 'desc');

        return $gastos->get();
    }

    public function updateGastos($request){
      $id = $request->input('id');
      $gastos = Gastos::getGastos($id);
      if(count($gastos)){

        $gastos->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : 0;
        $gastos->registro = date('Y-m-d');
        $gastos->clasificacion = $request->input('clasificacion')!="" ? $request->input('clasificacion') : null;
        $gastos->fgasto = $request->input('fgasto')!="" ? $request->input('fgasto') : date('Y-m-d');
        $gastos->concepto = $request->input('concepto')!="" ? $request->input('concepto') : "";
        $gastos->importe = $request->input('importe')!="" ? $request->input('importe') : "0";
        $gastos->status = $request->input('status')!="" ? $request->input('status') : "1";

        $gastos->save();
        return true;

      } else{
        return false;
      }
    }

    public function addGastos($request){
      $gastos = new Gastos;

      $gastos->registro = date('Y-m-d');
      $gastos->tienda_id = $request->input('tienda_id')!="" ? $request->input('tienda_id') : 0;
      $gastos->clasificacion = $request->input('clasificacion')!="" ? $request->input('clasificacion') : null;
      $gastos->fgasto = $request->input('fgasto')!="" ? $request->input('fgasto') : date('Y-m-d');
      $gastos->concepto = $request->input('concepto')!="" ? $request->input('concepto') : "";
      $gastos->importe = $request->input('importe')!="" ? $request->input('importe') : "0";
      $gastos->status = $request->input('status')!="" ? $request->input('status') : "1";

        $gastos->save();
        return true;
    }

    public function tienda(){
      return $this->hasOne('\App\admin\Tiendas', 'id', 'tienda_id');
    }

}
