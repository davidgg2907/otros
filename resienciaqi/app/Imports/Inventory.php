<?php

namespace App\Imports;

use Auth;

use App\admin\Productos;
use App\admin\Inventario;
use App\admin\Clientes;
use App\admin\Envios;
use App\admin\Ventas;
use App\admin\Ventas_detalle;
use App\admin\Ventas_facturacion  ;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Session;

class Inventory implements ToModel, WithHeadingRow
{


  public function  __construct() {

  }

  public function model(array $row) {

    if(!in_array($row[1],array('','SKU'))) {


      $prod = Productos::where('sku',$row[1])->where('status',1)->first();
      $producto_id = 0;
      if(count($prod)) {
        $prod->costo        = (float)$row[3];
        $prod->precio       = (float)$row[5];
        $prod->volumen      = (float)$row[4];
        $producto_id    = $prod->id;
        $prod->save();

      } else {

        $prod               = new Productos;
        $prod->kit          = $row[0] == "kit" ? "SI" : "NO";
        $prod->sku          = $row[1];
        $prod->descripcion  = $row[2];
        $prod->costo        = (float)$row[3];
        $prod->precio       = (float)$row[5];
        $prod->volumen      = (float)$row[4];
        $prod->status       = 1;
        $prod->save();
        $producto_id        = $prod->id;

      }

      if((int)$row['7'] != 0) {
        //ALMACEN GENERAL
        $inventario = new Inventario;
        $inventario->tienda_id    = 0;
        $inventario->almacen_id   = 1;
        $inventario->producto_id  = $producto_id;
        $inventario->cantidad     = $row['7'];
        $inventario->status       = 1;
        $inventario->save();

      }

      if((int)$row['8'] != 0) {
        //Magufer
        $inventario = new Inventario;
        $inventario->tienda_id    = 3;
        $inventario->almacen_id   = 4;
        $inventario->producto_id  = $producto_id;
        $inventario->cantidad     = $row['8'];
        $inventario->status       = 1;
        $inventario->save();

      }

      if((int)$row['9'] != 0) {

        //Distribuidora
        $inventario = new Inventario;
        $inventario->tienda_id    = 4;
        $inventario->almacen_id   = 7;
        $inventario->producto_id  = $producto_id;
        $inventario->cantidad     = $row['9'];
        $inventario->status       = 1;
        $inventario->save();

      }

      if((int)$row['10'] != 0) {
        //Clicklife
        $inventario = new Inventario;
        $inventario->tienda_id    = 2;
        $inventario->almacen_id   = 3;
        $inventario->producto_id  = $producto_id;
        $inventario->cantidad     = $row['10'];
        $inventario->status       = 1;
        $inventario->save();

      }

      if((int)$row['11'] != 0) {
        //Shopylife
        $inventario = new Inventario;
        $inventario->tienda_id    = 5;
        $inventario->almacen_id   = 6;
        $inventario->producto_id  = $producto_id;
        $inventario->cantidad     = $row['11'];
        $inventario->status       = 1;
        $inventario->save();

      }

      if((int)$row['12'] != 0) {
        //Vivasmart
        $inventario = new Inventario;
        $inventario->tienda_id    = 1;
        $inventario->almacen_id   = 2;
        $inventario->producto_id  = $producto_id;
        $inventario->cantidad     = $row['12'];
        $inventario->status       = 1;
        $inventario->save();

      }

      if((int)$row['13'] != 0) {

        //Distribuidora
        $inventario = new Inventario;
        $inventario->tienda_id    = 3;
        $inventario->almacen_id   = 8;
        $inventario->producto_id  = $producto_id;
        $inventario->cantidad     = $row['13'];
        $inventario->status       = 1;
        $inventario->save();

      }

    }

  }

}
