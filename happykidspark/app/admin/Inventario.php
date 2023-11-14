<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getInventarioData($per_page, $request, $sortBy, $order){
      $inventario = Inventario::select(array('inventario.*'));

      //join
      if($request->input('tienda_id') != "") {
        $inventario->where('inventario.producto_id', $request->input('tienda_id'));
      }

      // sort option
      $inventario->orderBy('inventario.id', 'desc');

      return $inventario->paginate($per_page);

    }

    public static function inventariar($data) {


      $prod_info = \App\admin\Productos::find($data['producto_id']);

      if($prod_info->tipo == 1 && $prod_info->inventariable == 1) {

        //El producto es por unidad y es inventaruable lo mandamos directo
        Inventario::aplicaMovimiento($data);

      } else {
        //El producto es por tiempo, determinamos si tiene adjuntos
        $adjuntos = \App\admin\Adjuntos::where('producto_id',$data['producto_id'])->get();

        foreach($adjuntos as $adds) {

          $adjuntos = array(

            'producto_id' => $adds->producto_adjunto_id,

            'operacion'   => $data['operacion'],

            'cantidad'    => ($data['cantidad'] * $adds->cantidad),

            'motivo'      => $data['motivo']

          );

          Inventario::aplicaMovimiento($adjuntos);

        }

      }

    }

    public static function aplicaMovimiento($data) {

      $existente = Inventario::where('producto_id',$data['producto_id'])
                             ->where('status',1)
                             ->get();

      $data['anterior'] = $inventario->cantidad;

      if(count($existente)) {
        $inventario = $existente[0];

        if($data['operacion'] == "S") {
          $data['posterior'] = $inventario->cantidad + (int)$data['cantidad'];
          $inventario->cantidad = (int)$inventario->cantidad + (int)$data['cantidad'];
        } else if($data['operacion'] == "R") {
          $data['posterior'] = $inventario->cantidad - (int)$data['cantidad'];
          $inventario->cantidad = (int)$inventario->cantidad - (int)$data['cantidad'];
        } else {
          $inventario->cantidad = (int)$data['cantidad'];
        }
        $inventario->save();

      } else {
        $inventario = new Inventario;
        $inventario->producto_id = (int)$data['producto_id'];
        if($data['operacion'] == "S") {
          $data['posterior'] = $inventario->cantidad + (int)$data['cantidad'];
          $inventario->cantidad = (int)$inventario->cantidad + (int)$data['cantidad'];
        } else if($data['operacion'] == "R") {
          $data['posterior'] = $inventario->cantidad - (int)$data['cantidad'];
          $inventario->cantidad = (int)$inventario->cantidad - (int)$data['cantidad'];
        } else {
          $inventario->producto_id = (int)$data['cantidad'];
        }
        $inventario->status = 1;
        $inventario->save();
      }


      Inventario::generaLog($data);

    }

    public function producto(){
      return $this->hasOne('\App\admin\Productos', 'id', 'producto_id');
    }

    public static function generaLog($data) {

      $log = new InvLog;

      $log->usr_id        = Auth::user()->id;
      $log->fecha         = date('Y-m-d H:i:s');
      $log->producto_id   = $data['producto_id'];
      $log->movimiento    = $data['operacion'];
      $log->anterior      = $data['anterior'];
      $log->posterior     = $data['posterior'];
      $log->cantidad      = $data['cantidad'];
      $log->descripcion   = $data['motivo'];
      $log->status        = 1;
      $log->save();

    }
}
