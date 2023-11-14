<?php

namespace App\Imports;

use Auth;

use App\admin\Productos;
use App\admin\Clientes;
use App\admin\Envios;
use App\admin\Ventas;
use App\admin\Ventas_detalle;
use App\admin\Ventas_facturacion  ;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Session;

class MercadoLibre implements ToModel, WithValidation, WithHeadingRow
{

    public $tienda_id = 0;

    public $restringir = array('de','h','hs','hs.');

    public $meses = array(
      'enero'       => '01',
      'febrero'     => '02',
      'marzo'       => '03',
      'abril'       => '04',
      'mayo'        => '05',
      'junio'       => '06',
      'julio'       => '07',
      'agosto'      => '08',
      'septiembre'  => '09',
      'octubre'     => '10',
      'noviembre'   => '11',
      'diciembre'   => '12',
    );

    public function  __construct($almacen) {
      $this->tienda_id= $almacen;
    }


    public function model(array $row) {

      if ($row[1] != "" && $row[1] != "Fecha de venta") {

        foreach($row as $line) {
          $folioml = trim($line);
          break;
        }

        //Validamos si el producto existe
        $producto = Productos::where('sku',$row[13])->where('status',1)->first();

        if(!count($producto)) {

          //El producto no existe lo creamos
          $producto = new Productos;

          $producto->proveedor_id = 0;
          $producto->sku          = $row[13] != "" ? $row[13] : null;
          $producto->descripcion  = $row[16] != "" ? $row[16] : null;
          $producto->modelo       = null;
          $producto->precio       = $row[11] != "" ? (float)$row[11] : null;
          $producto->status       = 1;
          $producto->save();

          $producto_id    = $producto->id;
          $costo_producto =  0;
          $es_kit         = "NO";

        } else {

          $producto_id    = $producto->id;
          $costo_producto =  $producto->costo;
          $es_kit         = $producto->kit;
        }

        //Creamos o validamos si el cliente existe
        $cliente = Clientes::where('nombre',$row[25])->first();

        if(!count($cliente)) {

          //El producto no existe lo creamos
          $cliente = new Clientes;

          $cliente->nombre          = $row[25] != "" ? $row[25] : null;
          $cliente->identificacion  = $row[26] != "" ? $row[26] : null;
          $cliente->domicilio       = $row[27] != "" ? $row[27] : null;
          $cliente->ciudad          = $row[28] != "" ? $row[28] : null;
          $cliente->estado          = $row[29] != "" ? $row[29] : null;
          $cliente->cp              = $row[30] != "" ? $row[30] : null;
          $cliente->pais            = $row[31] != "" ? $row[31] : null;
          $cliente->status          = 1;
          $cliente->save();

          $cliente_id = $cliente->id;

        } else { $cliente_id = $cliente->id; }

        //Obtenemos la fecha real de venta
        $cells = explode(' ',$row[1]);

        $date = "";

        foreach($cells as $c) {

          if(!in_array($c,$this->restringir)) {

            $mes = $this->meses[$c];

            if($mes != "") {
              $date .= $mes . '-';
            } else {

              if(strlen($c) <2) {
                $date .= '0' . $c . '-';
              } else {
                $date .= $c . '-';
              }

            }

          }

        }

        $fecha_movimiento = date('Y-m-d',strtotime(substr($date,0,10)));

        if(trim($row['14']) == "") {
          //EL REGISTRO PERTENECE A UNA VENTA DE CARRITO, LA ANEXAMOS
          //Y GUARDAMOS EL ID EN UNA VARIABLE DE SESION TEMPORAL

          $venta_id = $this->createVenta($row,$folioml,$cliente_id,$fecha_movimiento);

          //creamos el detalle de envio
          if($row[32] != "") { $this->createEnvio($row,$venta_id,$cliente_id); }

          //creamos el detalle de facturacion
          if(trim($row[20]) != "") { $this->createFacturacion($row,$venta_id,$cliente_id); }

          Session::put('venta_carrito_id',$venta_id);

        } else {

          if((int)$row['6'] == 0) {
            //GENERAMOS EL DETALLE APARTIR DE LA VENTA DE CARRITO
            $this->creaDetalle($row,Session::get('venta_carrito_id'),$producto_id,$costo_producto,$es_kit,$folioml);

          } else {
            //LA CANTIDAD SI EXISTE Y TAMBIEN EL ID DE PUBLICIDAD ENTONCES GENERAMOS TODO
            //PREGUNTANDO ANTES SI LA VENTA EXISTE O NO
            $venta = \App\admin\Ventas::where('status',1)->where('folioml',$folioml)->first();

            if(!count($venta)) {
              //LA VENTA NO EXISTE LA CREAMOS DESDE CERO
              $venta_id = $this->createVenta($row,$folioml,$cliente_id,$fecha_movimiento);

              //creamos el detalle de envio
              if($row[32] != "") { $this->createEnvio($row,$venta_id,$cliente_id); }

              //creamos el detalle de facturacion
              if(trim($row[20]) != "") { $this->createFacturacion($row,$venta_id,$cliente_id); }

              $this->creaDetalle($row,$venta_id,$producto_id,$costo_producto,$es_kit);

            } else {
              //LA VENTA EXISTE LA EDITAMOS UNICAMENTE A NIVEL DETALLE
              $this->creaDetalle($row,$venta->id,$producto_id,$costo_producto,$es_kit,$folioml);
            }

          }
          //

        }

      }

    }

    public function rules(): array
    {
        return [
           // Can also use callback validation rules
           '0' => function($attribute, $value, $onFailure) {
                if ($value !== '# de vta') {
                     $onFailure('Numero de venta erroneo');
                }
            }
        ];
    }

    private function createVenta($row,$folioml,$cliente_id,$fecha_movimiento) {

      $ventas = new Ventas;

      $ventas->usr_id             = Auth::user()->id;
      $ventas->cliente_id         = $cliente_id;
      $ventas->tienda_id          = $this->tienda_id;
      $ventas->folioml            = $folioml;
      $ventas->estadoml           = $row[2] != "" ? $row[2] : null;
      $ventas->descedoml          = $row[3] != "" ? $row[3] : null;
      $ventas->fecha              = $fecha_movimiento;
      $ventas->fecha_texto        = $row[1] != "" ? $row[1] : null;
      $ventas->idpublicacion      = $row[14] != "" ? $row[14] : null;
      $ventas->publicacion        = $row[16] != "" ? $row[16] : null;
      $ventas->tipopublicacion    = $row[19] != "" ? $row[19] : null;
      $ventas->entrega            = $row[32] != "" ? $row[32] : null;
      $ventas->facturacion        = $row[20] != "" ? $row[20] : null;
      $ventas->subtotal           = $row[11] != "" ? (float)$row[11] : null ;
      $ventas->impuesto           = $row[8] != "" ? (float)($row[8] * -1): null ;
      $ventas->costo_envio        = $row[9] != "" ? (float)($row[9] * -1) : null;
      $ventas->descuento          = 0;
      $ventas->iva                = 0;
      $ventas->total              = $row[6] != "" ? (float)$row[6] : null;
      $ventas->status             = 1;
      $ventas->save();

      return $ventas->id;
    }

    private function createEnvio($row,$venta_id,$cliente_id) {

      //Ingresamos la informacion de entrega del producto
      $envio = new Envios;


      $envio->usr_id          = Auth::user()->id;
      $envio->venta_id        = $venta_id;
      $envio->cliente_id      = $cliente_id;
      $envio->tienda_id       = $this->tienda_id;
      $envio->forma           = $row[32] != "" ? $row[32] : null;
      $envio->fecha_envio     = $row[33] != "" ? date('Y-m-d',strtotime($row[33])) : null;
      $envio->fecha_entrega   = $row[34] != "" ? date('Y-m-d',strtotime($row[34])) : null;
      $envio->transportista   = $row[35] != "" ? $row[35] : null;
      $envio->guia            = $row[36] != "" ? $row[36] : null;
      $envio->url             = $row[37] != "" ? $row[37] : null;
      $envio->status          = 1;
      $envio->save();

    }

    private function createFacturacion($row,$venta_id,$cliente_id) {

      //Ingresamos la informacion de entrega del producto
      $facturacion = new Ventas_facturacion;

      $facturacion->usr_id      = Auth::user()->id;
      $facturacion->venta_id    = $venta_id;
      $facturacion->cliente_id  = $cliente_id;
      $facturacion->tienda_id   = $this->tienda_id;
      $facturacion->adjunta     = $row[20] != "" ? $row[20] : null;
      $facturacion->nombre      = $row[21] != "" ? $row[21] : null;
      $facturacion->documento   = $row[22] != "" ? $row[22] : null;
      $facturacion->domicilio   = $row[23] != "" ? $row[23] : null;
      $facturacion->tipoc       = $row[24] != "" ? $row[24] : null;
      $facturacion->rfc         = null;
      $facturacion->status      = 1;
      $facturacion->save();

    }

    private function creaDetalle($row,$venta_id,$producto_id,$costo_producto,$es_kit,$folioml = null) {
      if($folioml != "") {

        //detalle de una venta de carrito calculamos lo que ocupa el monto
        $master = Ventas::find($venta_id);

        $porc_ocupacion   = $row[18] / $master->total;
        if(trim($master->estadoml) != " ") {

          if(trim($row[2]) != "Cobro devuelto") {
            $comision_det     = $master->impuesto * $porc_ocupacion;
            $envio_det        = $master->costo_envio * $porc_ocupacion;
            $ingresoml       = $master->subtotal * $porc_ocupacion;
            $preciounit       = (int)$row[18];
          } else {
            $comision_det    = 0;
            $envio_det       = 0;
            $ingresoml       = 0;
            $preciounit      = (int)$row[18];

          }

        } else {
          $comision_det    = 0;
          $envio_det       = 0;
          $ingresoml       = 0;
          $preciounit      = (int)$row[18];

        }


      } else {

        $comision_det     = null;
        $envio_det        = null;
        $ingresoml        = $row[11] != "" ? (int)$row[11] : 0;
        $precioml         = $row[6]  != "" ? (int)$row[6] : 0;
        $preciounit       = $row[18]  != "" ? (int)$row[18] : 0;

      }

      $detalle = new Ventas_detalle;

      $detalle->venta_id      = $venta_id;
      $detalle->almacen_id    = 0;
      $detalle->producto_id   = $producto_id;
      $detalle->variante      = $row[17];
      $detalle->folioml       = $folioml;
      $detalle->cantidad      = $row[5]  != "" ? (int)$row[5] : 0;
      $detalle->ingreso_ml    = $ingresoml;

      $detalle->comision_ml   = $comision_det;
      $detalle->envio_ml      = $envio_det;

      $detalle->costo         = $costo_producto;
      $detalle->pventa        = $preciounit;
      $detalle->punit         = $preciounit;
      $detalle->status        = 1;
      $detalle->save();

      //Validamos si el producto ha sido entregado al cliente
      if($row[2] != "Cancelada por el comprador") {

        $almacen_retiro = 0;
        if($row[32] == "Mercado Envíos Full") {

          //El retiro de producto se hace de la bodega full de mercado libre
          $almacen = \App\admin\Almacenes::where('status',1)->where('fisico_digital','VIRTUAL')->where('tienda_id',$this->tienda_id)->first();

          $almacen_retiro = $almacen->id;

        } else {

          //El retiro de producto se hace de la bodega general de la tienda
          $almacen_retiro = 1;

        }

        //El producto ha sido entregado al cliente, lo descontamos de inventario
        if($almacen_retiro != 0) {

          if($es_kit ==  "SI") {

            //Traemos los productos que tiene el kit para descontarlos
            $kit_items = \App\admin\Productos_kit::where('producto_id',$producto_id)->get();

            foreach($kit_items as $kitems) {

              $retiroKit  = array(

                'tienda_id'     => $this->tienda_id,

                'almacen_id'    => $almacen_retiro,

                'producto_id'   => $kitems->prod_adjunto_id,

                'operacion'     => "R",

                'cantidad'      => $row[5] * $kitems->cantidad,

                'motivo'        => "Venta importacion, Mercado Libre",

              );

              \App\admin\Inventario::inventariar($retiroKit);

            }

          } else {

            $retiro  = array(

              'tienda_id'     => $this->tienda_id,

              'almacen_id'    => $almacen_retiro,

              'producto_id'   => $producto_id,

              'operacion'     => "R",

              'cantidad'      => $row[5],

              'motivo'        => "Venta importacion, Mercado Libre",

            );

            \App\admin\Inventario::inventariar($retiro);

          }

        }

      }
    }


}
