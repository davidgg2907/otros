<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    const TIPOS = array(
      '1' => 'Costo por Unidad',
      '2' => 'Costo por Tiempo',
    );

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getProductos($id){
      $data =  Productos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getProductosView($id){
      $productos = Productos::select(array('productos.*'));
      $productos->where('productos.id', $id);

      return $productos->get()[0];

    }

    public function updateStatus($id, $num){
      $productos = $this->getProductos($id);
      if(count($productos)){
        $productos->status = $num;
        $productos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $productos = $this->getProductos($id);
      if(count($productos)){
        $img = public_path().'/uploads/'.$productos->featured_img;
            if($productos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $productos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getProductosData($per_page, $request, $sortBy, $order){
      $productos = Productos::select(array('productos.*'));

      //join
      $productos->where('status', 1);


        if(Auth::user()->comercio_id != 0) {
          $productos->where('productos.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $productos->where('productos.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $productos->where('productos.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $productos->orderBy('productos.id', 'desc');

        return $productos->paginate($per_page);
    }

    public function getProductosExport($request){
      $productos = Productos::select(array('productos.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $productos->where('productos.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $productos->orderBy('productos.id', 'desc');

        return $productos->get();
    }

    public function updateProductos($request){
      $id = $request->input('id');
      $productos = Productos::getProductos($id);
      if(count($productos)){

      	$productos->categoria_id = $request->input('categoria_id')!="" ? $request->input('categoria_id') : "0";
      	$productos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$productos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";

        // image upload code
        $imagen_name='';
        $imagen_file = $request->file('imagen');
        if(!is_null($imagen_file) && in_array($imagen_file->getClientOriginalExtension(), $this->allow_image)){
            $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
            $imagen_file->move('uploads',$imagen_name);
            $productos->imagen = $imagen_name;
        }

      	$productos->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "1";
      	$productos->precio = $request->input('precio')!="" ? $request->input('precio') : "0";
      	$productos->impuesto = $request->input('impuesto')!="" ? $request->input('impuesto') : "0";
        $productos->inventariable = $request->input('inventariable')!="" ? $request->input('inventariable') : "0";
      	$productos->status = $request->input('status')!="" ? $request->input('status') : "1";

        $productos->save();

        if($request->input('tipo') == "2") {

          if(count($request->input('adjuntos')) > 0) {

            Adjuntos::where('producto_id',$id)->delete();
            foreach($request->input('adjuntos') as $value) {

              if($value['producto_id'] != "") {
                $productos_kit = new Adjuntos;
              	$productos_kit->producto_id = $productos->id;
              	$productos_kit->producto_adjunto_id = $value['producto_id'];
              	$productos_kit->cantidad = $value['cantidad'];
              	$productos_kit->precio = null;
              	$productos_kit->status = 1;
                $productos_kit->save();
              }
            }

          }

        }

          return true;
      } else{
        return false;
      }
    }

    public function addProductos($request){
      $productos = new Productos;

    	$productos->categoria_id = $request->input('categoria_id')!="" ? $request->input('categoria_id') : "0";
    	$productos->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
    	$productos->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
    	$productos->imagen = $request->input('imagen')=="" ? $request->input('old_imagen') : $request->input('imagen') ;

      // image upload code
      $imagen_name='';
      $imagen_file = $request->file('imagen');
      if(!is_null($imagen_file) && in_array($imagen_file->getClientOriginalExtension(), $this->allow_image)){
          $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
          $imagen_file->move('uploads',$imagen_name);
          $productos->imagen = $imagen_name;
      }

      $productos->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "1";
      $productos->precio = $request->input('precio')!="" ? $request->input('precio') : "0";
      $productos->impuesto = $request->input('impuesto')!="" ? $request->input('impuesto') : "0";
      $productos->inventariable = $request->input('inventariable')!="" ? $request->input('inventariable') : "0";
      $productos->status = $request->input('status')!="" ? $request->input('status') : "1";

        $productos->save();

      if($request->input('tipo') == "2") {

        foreach($request->input('adjuntos') as $value) {

          $productos_kit = new Adjuntos;
        	$productos_kit->producto_id = $productos->id;
        	$productos_kit->producto_adjunto_id = $value['producto_id'];
        	$productos_kit->cantidad = $value['cantidad'];
        	$productos_kit->precio = null;
        	$productos_kit->status = 1;
          $productos_kit->save();
        }

      }
      return true;
    }

    public function categoria(){
      return $this->hasOne('\App\admin\Categorias', 'id', 'categoria_id');
    }

}
