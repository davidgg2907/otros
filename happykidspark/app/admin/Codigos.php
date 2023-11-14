<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Codigos extends Model
{
    protected $table = 'codigos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getCodigos($id){
      $data =  Codigos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCodigosView($id){
      $codigos = Codigos::select(array('codigos.*'));
      $codigos->where('codigos.id', $id);

      return $codigos->get()[0];

    }

    public function updateStatus($id, $num){
      $codigos = $this->getCodigos($id);
      if(count($codigos)){
        $codigos->status = $num;
        $codigos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $codigos = $this->getCodigos($id);
      if(count($codigos)){
        $img = public_path().'/uploads/'.$codigos->featured_img;
            if($codigos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $codigos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCodigosData($per_page, $request, $sortBy, $order){
      $codigos = Codigos::select(array('codigos.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $codigos->where('codigos.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $codigos->where('codigos.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $codigos->where('codigos.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $codigos->orderBy('codigos.id', 'desc');

        return $codigos->paginate($per_page);
    }

    public function getCodigosExport($request){
      $codigos = Codigos::select(array('codigos.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $codigos->where('codigos.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $codigos->orderBy('codigos.id', 'desc');

        return $codigos->get();
    }

    public function updateCodigos($request){
      $id = $request->input('id');
      $codigos = Codigos::getCodigos($id);
      if(count($codigos)){

          $codigos->usr_crea_id = $request->input('usr_crea_id')!="" ? $request->input('usr_crea_id') : "";
	$codigos->usr_usa_id = $request->input('usr_usa_id')!="" ? $request->input('usr_usa_id') : "";
	$codigos->creado = $request->input('creado')!="" ? $request->input('creado') : "";
	$codigos->caducado = $request->input('caducado')!="" ? $request->input('caducado') : "";
	$codigos->status = $request->input('status')!="" ? $request->input('status') : "";

          $codigos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCodigos(){
      $codigos = new Codigos;

      $inicia = date('Y-m-d g:i:s');
      $caduca = date('Y-m-d g:i:s',strtotime($inicia . ' + 15 minutes'));

      $code = $this->generarCodigo(6);

      $codigos->usr_crea_id = Auth::user()->id;
      $codigos->usr_usa_id  = 0;
      $codigos->codigo      = $code;
      $codigos->creado      = $inicia;
      $codigos->caducado    = $caduca;
      $codigos->status      = 1;
      $codigos->save();
      return $code;
    }

    function generarCodigo($longitud) {
      $key = '';
      $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $max = strlen($pattern)-1;
      for($i=0;$i < $longitud;$i++) {
        $key .= substr($pattern,mt_rand(0,$max),1);
      }
      return $key;
    }

    public function creador(){
      return $this->hasOne('\App\admin\Users', 'id', 'usr_crea_id');
    }


    public function ejecutor(){
      return $this->hasOne('\App\admin\Users', 'id', 'usr_usa_id');
    }
}
