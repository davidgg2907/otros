<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Bandas extends Model
{
    protected $table = 'bandas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getBandas($id){
      $data =  Bandas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getBandasView($id){
      $bandas = Bandas::select(array('bandas.*'));
      $bandas->where('bandas.id', $id);

      return $bandas->get()[0];

    }

    public function updateStatus($id, $num){
      $bandas = $this->getBandas($id);
      if(count($bandas)){
        $bandas->status = $num;
        $bandas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $bandas = $this->getBandas($id);
      if(count($bandas)){
        $img = public_path().'/uploads/'.$bandas->featured_img;
            if($bandas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $bandas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getBandasData($per_page, $request, $sortBy, $order){
      $bandas = Bandas::select(array('bandas.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $bandas->where('bandas.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $bandas->where('bandas.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $bandas->where('bandas.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $bandas->orderBy('bandas.id', 'desc');

        return $bandas->paginate($per_page);
    }

    public function getBandasExport($request){
      $bandas = Bandas::select(array('bandas.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $bandas->where('bandas.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $bandas->orderBy('bandas.id', 'desc');

        return $bandas->get();
    }

    public function updateBandas($request){
      $id = $request->input('id');
      $bandas = Bandas::getBandas($id);
      if(count($bandas)){

        $bandas->color = $request->input('color')!="" ? $request->input('color') : "";
        $bandas->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
        $bandas->termina = $request->input('termina')!="" ? $request->input('termina') : "";
        $bandas->rgb = $request->input('rgb')!="" ? $request->input('rgb') : "";
        $bandas->serie = $request->input('serie')!="" ? $request->input('serie') : "";
        $bandas->unidades = $request->input('unidades')!="" ? $request->input('unidades') : "";

          $bandas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addBandas($request){
      $bandas = new Bandas;

        $bandas->fecha_inicio = date('Y-m-d');
        $bandas->color = $request->input('color')!="" ? $request->input('color') : "";
      	$bandas->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
      	$bandas->termina = $request->input('termina')!="" ? $request->input('termina') : "";
      	$bandas->usadas = $request->input('usadas')!="" ? $request->input('usadas') : "";
      	$bandas->actual = $request->input('inicia')!="" ? $request->input('inicia') : "";
      	$bandas->rgb = $request->input('rgb')!="" ? $request->input('rgb') : "";
      	$bandas->serie = $request->input('serie')!="" ? $request->input('serie') : "";
        $bandas->unidades = $request->input('unidades')!="" ? $request->input('unidades') : "";
      	$bandas->status = "1";

        $bandas->save();
        return true;
    }
}
