<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getCategorias($id){
      $data =  Categorias::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getCategoriasView($id){
      $categorias = Categorias::select(array('categorias.*'));
      $categorias->where('categorias.id', $id);

      return $categorias->get()[0];

    }

    public function updateStatus($id, $num){
      $categorias = $this->getCategorias($id);
      if(count($categorias)){
        $categorias->status = $num;
        $categorias->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $categorias = $this->getCategorias($id);
      if(count($categorias)){
        $img = public_path().'/uploads/'.$categorias->featured_img;
            if($categorias->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $categorias->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getCategoriasData($per_page, $request, $sortBy, $order){
      $categorias = Categorias::select(array('categorias.*'));
      $categorias->where('status', 1);
      //join


        // sort option
        $categorias->orderBy('categorias.id', 'desc');

        return $categorias->paginate($per_page);
    }

    public function getCategoriasExport($request){
      $categorias = Categorias::select(array('categorias.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $categorias->where('categorias.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $categorias->orderBy('categorias.id', 'desc');

        return $categorias->get();
    }

    public function updateCategorias($request){
      $id = $request->input('id');
      $categorias = Categorias::getCategorias($id);
      if(count($categorias)){

          $categorias->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$categorias->status = $request->input('status')!="" ? $request->input('status') : "";

          $categorias->save();
          return true;
      } else{
        return false;
      }
    }

    public function addCategorias($request){
      $categorias = new Categorias;

        $categorias->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$categorias->status = $request->input('status')!="" ? $request->input('status') : "";

        $categorias->save();
        return true;
    }
}
