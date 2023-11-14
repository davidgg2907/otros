<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getEmpresas($id){
      $data =  Empresas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getEmpresasView($id){
      $empresas = Empresas::select(array('empresas.*'));
      $empresas->where('empresas.id', $id);
      
      return $empresas->get()[0];

    }

    public function updateStatus($id, $num){
      $empresas = $this->getEmpresas($id);
      if(count($empresas)){
        $empresas->status = $num;
        $empresas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $empresas = $this->getEmpresas($id);
      if(count($empresas)){
        $img = public_path().'/uploads/'.$empresas->featured_img;
            if($empresas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $empresas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getEmpresasData($per_page, $request, $sortBy, $order){
      $empresas = Empresas::select(array('empresas.*'));

      //join
        

        // sort option
        $empresas->orderBy('empresas.id', 'desc');

        return $empresas->paginate($per_page);
    }

    public function updateEmpresas($request){
      $id = $request->input('id');
      $empresas = Empresas::getEmpresas($id);
      if(count($empresas)){

          $empresas->id = $request->input('id')!="" ? $request->input('id') : "";
	$empresas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$empresas->impuesto = $request->input('impuesto')!="" ? $request->input('impuesto') : "";
	$empresas->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
	$empresas->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
	$empresas->estado = $request->input('estado')!="" ? $request->input('estado') : "";
	$empresas->ciudad = $request->input('ciudad')!="" ? $request->input('ciudad') : "";
	$empresas->cp = $request->input('cp')!="" ? $request->input('cp') : "";
	$empresas->correo = $request->input('correo')!="" ? $request->input('correo') : "";
	$empresas->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$empresas->celular = $request->input('celular')!="" ? $request->input('celular') : "";
	$empresas->hospedaje = $request->input('hospedaje')!="" ? $request->input('hospedaje') : "";
	$empresas->hospedaje_iva = $request->input('hospedaje_iva')!="" ? $request->input('hospedaje_iva') : "";
	$empresas->twitter = $request->input('twitter')!="" ? $request->input('twitter') : "";
	$empresas->facebook = $request->input('facebook')!="" ? $request->input('facebook') : "";
	$empresas->instagram = $request->input('instagram')!="" ? $request->input('instagram') : "";
	$empresas->logotipo = $request->input('logotipo')!="" ? $request->input('logotipo') : "";
	$empresas->status = $request->input('status')!="" ? $request->input('status') : "";

          $empresas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addEmpresas($request){
      $empresas = new Empresas;

        $empresas->id = $request->input('id')!="" ? $request->input('id') : "";
	$empresas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$empresas->impuesto = $request->input('impuesto')!="" ? $request->input('impuesto') : "";
	$empresas->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
	$empresas->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
	$empresas->estado = $request->input('estado')!="" ? $request->input('estado') : "";
	$empresas->ciudad = $request->input('ciudad')!="" ? $request->input('ciudad') : "";
	$empresas->cp = $request->input('cp')!="" ? $request->input('cp') : "";
	$empresas->correo = $request->input('correo')!="" ? $request->input('correo') : "";
	$empresas->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$empresas->celular = $request->input('celular')!="" ? $request->input('celular') : "";
	$empresas->hospedaje = $request->input('hospedaje')!="" ? $request->input('hospedaje') : "";
	$empresas->hospedaje_iva = $request->input('hospedaje_iva')!="" ? $request->input('hospedaje_iva') : "";
	$empresas->twitter = $request->input('twitter')!="" ? $request->input('twitter') : "";
	$empresas->facebook = $request->input('facebook')!="" ? $request->input('facebook') : "";
	$empresas->instagram = $request->input('instagram')!="" ? $request->input('instagram') : "";
	$empresas->logotipo = $request->input('logotipo')!="" ? $request->input('logotipo') : "";
	$empresas->status = $request->input('status')!="" ? $request->input('status') : "";

        $empresas->save();
        return true;
    }
}
