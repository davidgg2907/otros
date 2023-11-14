<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Adjuntos extends Model
{
    protected $table = 'adjuntos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getAdjuntos($id){
      $data =  Adjuntos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAdjuntosView($id){
      $adjuntos = Adjuntos::select(array('adjuntos.*'));
      $adjuntos->where('adjuntos.id', $id);

      return $adjuntos->get()[0];

    }

    public function updateStatus($id, $num){
      $adjuntos = $this->getAdjuntos($id);
      if(count($adjuntos)){
        $adjuntos->status = $num;
        $adjuntos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $adjuntos = $this->getAdjuntos($id);
      if(count($adjuntos)){
        $img = public_path().'/uploads/'.$adjuntos->featured_img;
            if($adjuntos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $adjuntos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAdjuntosData($per_page, $request, $sortBy, $order){
      $adjuntos = Adjuntos::select(array('adjuntos.*'));

      //join
      $adjuntos->where('status', 1);

        // sort option
        $adjuntos->orderBy('adjuntos.id', 'desc');

        return $adjuntos->paginate($per_page);
    }

    public function getAdjuntosExport($request){
      $adjuntos = Adjuntos::select(array('adjuntos.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $adjuntos->where('adjuntos.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $adjuntos->orderBy('adjuntos.id', 'desc');

        return $adjuntos->get();
    }

    public function updateAdjuntos($request){
      $id = $request->input('id');
      $adjuntos = Adjuntos::getAdjuntos($id);
      if(count($adjuntos)){

          $adjuntos->id = $request->input('id')!="" ? $request->input('id') : "";
	$adjuntos->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$adjuntos->producto_adjunto_id = $request->input('producto_adjunto_id')!="" ? $request->input('producto_adjunto_id') : "";
	$adjuntos->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$adjuntos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$adjuntos->status = $request->input('status')!="" ? $request->input('status') : "";

          $adjuntos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAdjuntos($request){
      $adjuntos = new Adjuntos;

        $adjuntos->id = $request->input('id')!="" ? $request->input('id') : "";
	$adjuntos->producto_id = $request->input('producto_id')!="" ? $request->input('producto_id') : "";
	$adjuntos->producto_adjunto_id = $request->input('producto_adjunto_id')!="" ? $request->input('producto_adjunto_id') : "";
	$adjuntos->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$adjuntos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$adjuntos->status = $request->input('status')!="" ? $request->input('status') : "";

        $adjuntos->save();
        return true;
    }

    public function adjunto(){
      return $this->hasOne('\App\admin\Productos', 'id', 'producto_adjunto_id');
    }
}
