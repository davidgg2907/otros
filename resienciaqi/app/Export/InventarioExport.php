<?php

namespace App\Export;

use \App\admin\Inventario;
use Auth;
use DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InventarioExport implements FromView
{

  use Exportable;

  private $request = null;

  public function view(): View {

    $inventario = new \App\admin\Inventario;

    $data = array();

    $global = \App\admin\Inventario::select(DB::raw('SUM(cantidad) as total,productos.sku,productos.descripcion,productos.id,productos.precio,productos.costo,productos.volumen,productos.kit'))
                                   ->join('productos','productos.id','inventario.producto_id')
                                   ->groupby('inventario.producto_id')
                                   ->get();

    foreach($global as $general) {

      $almacenaje = array();

      foreach(\App\admin\Almacenes::orderBy('orden','ASC')->where('status',1)->get() as $almacen) {

        $existencia_almacen = \App\admin\inventario::where('almacen_id',$almacen->id)->where('producto_id',$general->id)->first();
        $almacenaje[$almacen->id]['existencia'] = (int)$existencia_almacen->cantidad;

      }

      $data[$general->sku]['tipo']  = $general->kit == "SI" ? "KIT" : "PRODUCTO";
      $data[$general->sku]['precio']  = $general->precio;
      $data[$general->sku]['costo']  = $general->costo;
      $data[$general->sku]['volumen']  = $general->volumen;

      $data[$general->sku]['existencia']  = $general->total;
      $data[$general->sku]['existencia']  = $general->total;

      $data[$general->sku]['existencia']  = $general->total;

      $data[$general->sku]['existencia']  = $general->total;
      $data[$general->sku]['descripcion'] = $general->descripcion;
      $data[$general->sku]['detalle']     = $almacenaje;

    }


    return view('exports/invetpdf', [ 'data' => $data]);

  }


  /*public function query() {


    $list = Inventario::query()->select(array('almacenes.nombre AS almacen','productos.sku','productos.descripcion','inventario.cantidad'))
              ->join('productos','productos.id','inventario.producto_id')
              ->join('almacenes','almacenes.id','inventario.almacen_id');

    if($this->request->input('almacen_id') != "") {
      $list->where('inventario.almacen_id',$request->input('almacen_id'));
    }

    if($this->request->input('producto') != "") {
      $list->where('productos.descripcion','LIKE','%' . $request->input('producto') . '%');
    }

    if($this->request->input('sku') != "") {
      $list->where('productos.sku','LIKE','%' . $request->input('sku') . '%');
    }

    return $list;

    //invetpdf
  }*/


}
