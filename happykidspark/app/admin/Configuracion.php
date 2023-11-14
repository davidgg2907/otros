<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public static function getConfig(){
      return Configuracion::find(1);
    }

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getConfiguracion($id){
      $data =  Configuracion::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getConfiguracionView($id){
      $configuracion = Configuracion::select(array('configuracion.*'));
      $configuracion->where('configuracion.id', $id);

      return $configuracion->get()[0];

    }

    public function updateStatus($id, $num){
      $configuracion = $this->getConfiguracion($id);
      if(count($configuracion)){
        $configuracion->status = $num;
        $configuracion->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $configuracion = $this->getConfiguracion($id);
      if(count($configuracion)){
        $img = public_path().'/uploads/'.$configuracion->featured_img;
            if($configuracion->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $configuracion->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getConfiguracionData($per_page, $request, $sortBy, $order){
      $configuracion = Configuracion::select(array('configuracion.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $configuracion->where('configuracion.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $configuracion->where('configuracion.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $configuracion->where('configuracion.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $configuracion->orderBy('configuracion.id', 'desc');

        return $configuracion->paginate($per_page);
    }

    public function getConfiguracionExport($request){
      $configuracion = Configuracion::select(array('configuracion.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $configuracion->where('configuracion.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $configuracion->orderBy('configuracion.id', 'desc');

        return $configuracion->get();
    }

    public function updateConfiguracion($request){
      $id = $request->input('id');
      $configuracion = Configuracion::getConfiguracion($id);
      if(count($configuracion)){

          $configuracion->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$configuracion->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
        	$configuracion->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
        	$configuracion->estado = $request->input('estado')!="" ? $request->input('estado') : "";
        	$configuracion->ciudad = $request->input('ciudad')!="" ? $request->input('ciudad') : "";
        	$configuracion->cp = $request->input('cp')!="" ? $request->input('cp') : "";
        	$configuracion->correo = $request->input('correo')!="" ? $request->input('correo') : "";
        	$configuracion->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        	$configuracion->ttraspaso = $request->input('ttraspaso')!="" ? $request->input('ttraspaso') : "";
        	$configuracion->ml_api = $request->input('ml_api')!="" ? $request->input('ml_api') : "";
        	$configuracion->ml_appkey = $request->input('ml_appkey')!="" ? $request->input('ml_appkey') : "";
        	$configuracion->ml_appsecret = $request->input('ml_appsecret')!="" ? $request->input('ml_appsecret') : "";
        	$configuracion->ml_code = $request->input('ml_code')!="" ? $request->input('ml_code') : "";
        	$configuracion->ml_token = $request->input('ml_token')!="" ? $request->input('ml_token') : "";
        	$configuracion->ml_rtoken = $request->input('ml_rtoken')!="" ? $request->input('ml_rtoken') : "";
        	$configuracion->ml_tokenexpire = $request->input('ml_tokenexpire')!="" ? $request->input('ml_tokenexpire') : "";
        	$configuracion->ml_usr = $request->input('ml_usr')!="" ? $request->input('ml_usr') : "";
        	$configuracion->ml_pws = $request->input('ml_pws')!="" ? $request->input('ml_pws') : "";
        	$configuracion->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$configuracion->iva = $request->input('iva')!="" ? $request->input('iva') : "";
          $photo_name='';
          $photo_file = $request->file('photo');
          if(!is_null($photo_file) && in_array($photo_file->getClientOriginalExtension(), $this->allow_image)){
              $photo_name = time().'_'.$photo_file->getClientOriginalName();
              $photo_file->move('uploads/empresa',$photo_name);
              $configuracion->logo = $photo_name;
          }
        	$configuracion->icono = $request->input('icono')!="" ? $request->input('icono') : "";
        	$configuracion->status = $request->input('status')!="" ? $request->input('status') : "";

          $configuracion->save();
          return true;
      } else{
        return false;
      }
    }

    public function addConfiguracion($request){
      $configuracion = new Configuracion;

        $configuracion->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$configuracion->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
	$configuracion->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
	$configuracion->estado = $request->input('estado')!="" ? $request->input('estado') : "";
	$configuracion->ciudad = $request->input('ciudad')!="" ? $request->input('ciudad') : "";
	$configuracion->cp = $request->input('cp')!="" ? $request->input('cp') : "";
	$configuracion->correo = $request->input('correo')!="" ? $request->input('correo') : "";
	$configuracion->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$configuracion->ttraspaso = $request->input('ttraspaso')!="" ? $request->input('ttraspaso') : "";
	$configuracion->ml_api = $request->input('ml_api')!="" ? $request->input('ml_api') : "";
	$configuracion->ml_appkey = $request->input('ml_appkey')!="" ? $request->input('ml_appkey') : "";
	$configuracion->ml_appsecret = $request->input('ml_appsecret')!="" ? $request->input('ml_appsecret') : "";
	$configuracion->ml_code = $request->input('ml_code')!="" ? $request->input('ml_code') : "";
	$configuracion->ml_token = $request->input('ml_token')!="" ? $request->input('ml_token') : "";
	$configuracion->ml_rtoken = $request->input('ml_rtoken')!="" ? $request->input('ml_rtoken') : "";
	$configuracion->ml_tokenexpire = $request->input('ml_tokenexpire')!="" ? $request->input('ml_tokenexpire') : "";
	$configuracion->ml_usr = $request->input('ml_usr')!="" ? $request->input('ml_usr') : "";
	$configuracion->ml_pws = $request->input('ml_pws')!="" ? $request->input('ml_pws') : "";
	$configuracion->celular = $request->input('celular')!="" ? $request->input('celular') : "";
	$configuracion->iva = $request->input('iva')!="" ? $request->input('iva') : "";
	$configuracion->logo = $request->input('logo')!="" ? $request->input('logo') : "";
	$configuracion->icono = $request->input('icono')!="" ? $request->input('icono') : "";
	$configuracion->status = $request->input('status')!="" ? $request->input('status') : "";

        $configuracion->save();
        return true;
    }
}
