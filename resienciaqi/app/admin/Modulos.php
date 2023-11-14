<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $table = 'modulos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getModulos($id){
      $data =  Modulos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getModulosView($id){
      $modulos = Modulos::select(array('modulos.*'));
      $modulos->where('modulos.id', $id);
      
      return $modulos->get()[0];

    }

    public function updateStatus($id, $num){
      $modulos = $this->getModulos($id);
      if(count($modulos)){
        $modulos->status = $num;
        $modulos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $modulos = $this->getModulos($id);
      if(count($modulos)){
        $img = public_path().'/uploads/'.$modulos->featured_img;
            if($modulos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $modulos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getModulosData($per_page, $request, $sortBy, $order){
      $modulos = Modulos::select(array('modulos.*'));

      //join
        

        // sort option
        $modulos->orderBy('modulos.id', 'desc');

        return $modulos->paginate($per_page);
    }

    public function updateModulos($request){
      $id = $request->input('id');
      $modulos = Modulos::getModulos($id);
      if(count($modulos)){

          $modulos->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$modulos->padre_id = $request->input('padre_id')!="" ? $request->input('padre_id') : "";
	$modulos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$modulos->url = $request->input('url')!="" ? $request->input('url') : "";
	$modulos->icon = $request->input('icon')!="" ? $request->input('icon') : "";
	$modulos->orden = $request->input('orden')!="" ? $request->input('orden') : "";
	$modulos->status = $request->input('status')!="" ? $request->input('status') : "";

          $modulos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addModulos($request){
      $modulos = new Modulos;

        $modulos->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$modulos->padre_id = $request->input('padre_id')!="" ? $request->input('padre_id') : "";
	$modulos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$modulos->url = $request->input('url')!="" ? $request->input('url') : "";
	$modulos->icon = $request->input('icon')!="" ? $request->input('icon') : "";
	$modulos->orden = $request->input('orden')!="" ? $request->input('orden') : "";
	$modulos->status = $request->input('status')!="" ? $request->input('status') : "";

        $modulos->save();
        return true;
    }
}
