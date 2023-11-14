<?php

  namespace App\admin;
  use DB;
  use Auth;
  use Illuminate\Database\Eloquent\Model;

  class Ventas extends Model
  {
      protected $table = 'ventas';
      protected $primaryKey = 'id';
      public $timestamps = false;
      public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

      public function getAll($table){
        return DB::table($table)->where('status',1)->get();
      }

      public function getVentas($id){
        $data =  Ventas::where('id', $id)->get();
        if(count($data)){
          return $data[0];
        } else{
          return array();
        }
      }

      public function getVentasView($id){
        $ventas = Ventas::select(array('ventas.*'));
        $ventas->where('ventas.id', $id);

        return $ventas->get()[0];

      }

      public function updateStatus($id, $num){
        $ventas = $this->getVentas($id);
        if(count($ventas)){
          $ventas->status = $num;
          $ventas->save();
          return true;
        } else{
          return false;
        }
      }


      public function deleteOne($id){
        $ventas = $this->getVentas($id);
        if(count($ventas)){
          $img = public_path().'/uploads/'.$ventas->featured_img;
              if($ventas->featured_img!='' && file_exists($img)){
                  unlink($img);
              }
              $ventas->delete();
          return true;
        } else{
          return false;
        }
      }

      public function getVentasData($per_page, $request, $sortBy, $order){
        $ventas = Ventas::select(array('ventas.*'));

        //join

        if($request->input('cliente_id') != "") {
          $ventas->where('cliente_id', $request->input('cliente_id'));
        }

        if($request->input('fecha_desde') != "" && $request->input('fecha_hasta')) {
          $ventas->whereBetween('fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
        } elseif($request->input('fecha_desde') != "") {
          $ventas->where('fecha',$request->input('fecha_desde'));
        } elseif($request->input('fecha_hasta') != "") {
          $ventas->where('fecha',$request->input('fecha_hasta'));
        }

          // sort option
          $ventas->orderBy('ventas.id', 'desc');

          return $ventas->paginate($per_page);
      }

      public function getVentasExport($request){
        $ventas = Ventas::select(array('ventas.*'));

        //join


          // where condition
          if(Auth::user()->empresa_id != 0) {
            $ventas->where('ventas.empresa_id', Auth::user()->empresa_id);
          }

          // sort option
          $ventas->orderBy('ventas.id', 'desc');

          return $ventas->get();
      }

      public function updateVentas($request){
        $id = $request->input('id');
        $ventas = Ventas::getVentas($id);
        if(count($ventas)){

            $ventas->cliente_id = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
  	$ventas->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
  	$ventas->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
  	$ventas->hora = $request->input('hora')!="" ? $request->input('hora') : "";
  	$ventas->subtotal = $request->input('subtotal')!="" ? $request->input('subtotal') : "";
  	$ventas->impuesto = $request->input('impuesto')!="" ? $request->input('impuesto') : "";
  	$ventas->totald = $request->input('totald')!="" ? $request->input('totald') : "";
  	$ventas->status = $request->input('status')!="" ? $request->input('status') : "";

            $ventas->save();
            return true;
        } else{
          return false;
        }
      }

      public function addVentas($request){
        $ventas = new Ventas;

          $ventas->cliente_id   = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "";
        	$ventas->caja_id      = 0;
          $ventas->user_id      = Auth::user()->id;
        	$ventas->fecha        = date('Y-m-d');
        	$ventas->hora         = date('G:i:s');
        	$ventas->subtotal     = $request->input('subtotal')!="" ? $request->input('subtotal') : "0";
        	$ventas->impuesto     = $request->input('impuestos')!="" ? $request->input('impuestos') : "0";
        	$ventas->totald       = $request->input('total')!="" ? $request->input('total') : "0";
        	$ventas->status       = $request->input('status')!="" ? $request->input('status') : "1";

          $ventas->save();

          foreach($request->input('compras') as $lista) {

            $detallado = new Venta_detalle;

            $detallado->venta_id        = $ventas->id;
            $detallado->temporizador_id = 0;
            $detallado->producto_id     = $lista['producto_id'];
            $detallado->cantidad        = $lista['cantidad'];
            $detallado->precio          = $lista['precio'];
            $detallado->importe         = $lista['importe'];
            $detallado->status          = 1;
            $detallado->save();

            //Ingresamos del almacen destino
            $destino  = array(
              'producto_id'   => $lista['producto_id'],
              'operacion'     => 'R',
              'cantidad'      => $lista['cantidad'],
              'motivo'        => 'Venta de producto, folio <a href="' . url('admin/compras/view/' . $ventas->id) . '"> # ' . $ventas->id . '</a>',
            );

            \App\admin\Inventario::inventariar($destino);


          }

          return true;
      }

      public function cliente(){
        return $this->hasOne('\App\admin\Clientes', 'id', 'cliente_id');
      }

      public function caja(){
        return $this->hasOne('\App\admin\Cajas', 'id', 'caja_id');
      }

      public function user(){
        return $this->hasOne('\App\admin\Users', 'id', 'user_id');
      }

      public function cancelcode(){
        return $this->hasOne('\App\admin\Codigos', 'id', 'codigo_id');
      }

  }
