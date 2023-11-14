<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ReportesController extends Controller
{
    public $v_fields=array('ventas.id', 'ventas.usr_id', 'ventas.cliente_id', 'ventas.tienda_id', 'ventas.folioml', 'ventas.publicacion', 'ventas.entrega', 'ventas.facturacion', 'ventas.subtotal', 'ventas.descuento', 'ventas.iva', 'ventas.total', 'ventas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function rptMovimientos(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas = new \App\admin\Ventas;

        $config = array();

        $config['titulo'] = "Entradas y Salidas de Productos";

        $config['cancelar'] = url('/admin/reportes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $data = array();
        echo 'BUSCANDO INVENTARIO POR FECHA';
        if($request->input('sending') == 1) {

          $qEgresos = \App\admin\Productos::select(DB::raw('SUM(inventario_log.cantidad) as total, productos.nombre,inventario_log.movimiento'))
                                         ->join('inventario_log','inventario_log.producto_id','productos.id')
                                         ->where('inventario_log.movimiento','R')
                                         ->groupBy('inventario_log.movimiento','productos.nombre');

          $qIngresos = \App\admin\Productos::select(DB::raw('SUM(inventario_log.cantidad) as total,productos.nombre,inventario_log.movimiento'))
                                          ->join('inventario_log','inventario_log.producto_id','productos.id')
                                          ->where('inventario_log.movimiento','S')
                                          ->groupBy('inventario_log.movimiento','productos.nombre');

         if($request->input('producto_id') != "") {
           $qEgresos->where('inventario_log.producto_id',$request->input('producto_id'));
           $qIngresos->where('inventario_log.producto_id',$request->input('producto_id'));

         }

         if($request->input('fecha_desde') != "" && $request->input('fecha_hasta')) {
           $qEgresos->whereBetween('inventario_log.fecha',[$request->input('fecha_desde') . ' 00:00:00',$request->input('fecha_hasta') . ' 23:59:59']);
           $qIngresos->whereBetween('inventario_log.fecha',[$request->input('fecha_desde') . ' 00:00:00',$request->input('fecha_hasta') . ' 23:59:59']);

         } elseif($request->input('fecha_desde') != "") {
           $qEgresos->where('inventario_log.fecha',$request->input('fecha_desde'));
           $qIngresos->where('inventario_log.fecha',$request->input('fecha_desde'));

         } elseif($request->input('fecha_hasta') != "") {
           $qEgresos->where('inventario_log.fecha',$request->input('fecha_desde'));
           $qIngresos->where('inventario_log.fecha',$request->input('fecha_desde'));

         }
         $egresos  = $qEgresos->get();
         $ingresos = $qIngresos->get();

         foreach($egresos as $entradas) {
            $data[$entradas->nombre]['descripcion'] = $entradas->descripcion;
            $data[$entradas->nombre]['entradas']    = 0;
            $data[$entradas->nombre]['salidas']     = $entradas->total;
          }

         foreach($ingresos as $salidas) {
            $data[$salidas->sku]['entradas']     = $salidas->total;
          }

        }

        return view('reportes/movimientos', ['query' =>$_SERVER['QUERY_STRING'],'data' => $data ]);
    }

    public function rptVentas(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas = new \App\admin\Ventas;

        $config = array();

        $config['titulo'] = "Entradas y Salidas de Productos";

        $config['cancelar'] = url('/admin/reportes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $data = array();

        if($request->input('sending') == 1) {

          $query = \App\admin\Ventas::select(array('productos.*','venta_detalle.cantidad','venta_detalle.precio','venta_detalle.importe',
                                                   'ventas.fecha','users.name AS cajero','cajas.inicia','cajas.termina','ventas.reserva_id'))
                                    ->join('venta_detalle','ventas.id','venta_detalle.venta_id')
                                    ->join('productos','productos.id','venta_detalle.producto_id')
                                    ->join('cajas','cajas.id','ventas.caja_id')
                                    ->join('users','users.id','cajas.user_id');

          if($request->input('producto_id') != "") {
            $query->where('venta_detalle.producto_id',$request->input('producto_id'));
          }

          if($request->input('cliente_id') != "") {
            $query->where('ventas.cliente_id',$request->input('cliente_id'));
          }

          if($request->input('fecha_desde') != "" && $request->input('fecha_hasta')) {
            $query->whereBetween('ventas.fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);

          } elseif($request->input('fecha_desde') != "") {
            $query->where('ventas.fecha',$request->input('fecha_desde'));

          } elseif($request->input('fecha_hasta') != "") {
            $query->where('ventas.fecha',$request->input('fecha_hasta'));

          }

          $data = $query->get();
        }

        return view('reportes/ventas', ['query' =>$_SERVER['QUERY_STRING'],'data' => $data]);
    }

    public function rptRendimiento(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas = new \App\admin\Ventas;

        $config = array();

        $config['titulo'] = "Entradas y Salidas de Productos";

        $config['cancelar'] = url('/admin/reportes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $data = array();

        if($request->input('sending') == 1) {

          $query = \App\admin\Ventas::select(array('productos.id','productos.descripcion','productos.sku','ventas_detalle.costo',
                                                   'ventas_detalle.cantidad','ventas_detalle.ingreso_ml','ventas_detalle.comision_ml',
                                                   'ventas_detalle.envio_ml','ventas_detalle.pventa','ventas.fecha','ventas.folioml',
                                                   'ventas.entrega','ventas_detalle.punit','tiendas.nombre AS tienda',
                                                   'ventas_detalle.folioml AS foliomldet','ventas.folioml'))
                                    ->join('ventas_detalle','ventas.id','ventas_detalle.venta_id')
                                    ->join('productos','productos.id','ventas_detalle.producto_id')
                                    ->join('tiendas','tiendas.id','ventas.tienda_id');



          if($request->input('tienda_id') != "") {
            $query->where('ventas.tienda_id',$request->input('tienda_id'));
          }

          if($request->input('producto_id') != "") {
            $query->where('ventas_detalle.producto_id',$request->input('producto_id'));
          }

          if($request->input('fecha_desde') != "" && $request->input('fecha_hasta')) {

            $query->whereBetween('ventas.fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);

          } elseif($request->input('fecha_desde') != "") {

            $query->where('ventas.fecha',$request->input('fecha_desde'));

          } elseif($request->input('fecha_hasta') != "") {

            $query->where('ventas.fecha',$request->input('fecha_hasta'));

          }

          $data = $query->get();

        }

        return view('reportes/utilidad', ['query' =>$_SERVER['QUERY_STRING'],'data' => $data]);
    }

    public function rptOperaciones(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas = new \App\admin\Ventas;

        $config = array();

        $config['titulo'] = "Entradas y Salidas de Productos";

        $config['cancelar'] = url('/admin/reportes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $data_tienda = array();

        $data = array();

        if($request->input('sending') == 1) {

          $tiendas = \App\admin\Tiendas::where('status',1);

          if($request->input('tienda_id') != "") {
              $tiendas->where('id',$request->input('tienda_id'));
          }

          $data_tienda = $tiendas->get();

          $stores_info = array();

          $gran_total = 0;

          $gran_utilidad = 0;

          foreach($data_tienda as $store) {

            $vtaMl = \App\admin\Ventas::select(DB::raw('count(*) as total, sum(total) as importe,
                                                        sum(impuesto) AS impuesto, sum(costo_envio) AS costo_envio,
                                                        sum(anulaciones) AS anulaciones, sum(subtotal) AS subtotal'))
                                      ->where('tienda_id',$store->id);

            $costos = \App\admin\Ventas_detalle::select(DB::raw('sum(cantidad) as total, sum(ventas_detalle.costo) as costo'))
                                               ->join('ventas','ventas.id','ventas_detalle.venta_id')
                                               ->join('productos','productos.id','ventas_detalle.producto_id')
                                               ->where('ventas.tienda_id',$store->id);

            $ordenes = \App\admin\Compras::select(DB::raw('count(*) as total, sum(total * tcambio) as importe'))
                                         ->where('status',1)
                                         ->where('tienda_id',$request->input('tienda_id'));

            $compras = \App\admin\Compras::select(DB::raw('count(*) as total, sum(total * tcambio) as importe'))
                                         ->where('status',2)
                                         ->where('tienda_id',$store->id);

            $traspasos = \App\admin\Traspasos::select(DB::raw('count(*) as total, sum(importe) as importe'))
                                             ->where('status',2)
                                             ->where('tienda_id',$store->id);

            $garantias = \App\admin\Garantia::select(DB::raw('count(*) as total, sum(importe) as importe'))
                                            ->where('situacion','!=',1)
                                            ->where('tienda_id',$store->id);

            $gastosPml = \App\admin\Gastos::select(DB::raw('count(*) as total, sum(importe) as importe'))
                                          ->where('status',1)
                                          ->where('clasificacion','Publicidad ML')
                                          ->where('tienda_id',$store->id);

            $gastosImpuestos = \App\admin\Gastos::select(DB::raw('count(*) as total, sum(importe) as importe'))
                                                ->where('status',1)
                                                ->where('clasificacion','Impuestos')
                                                ->where('tienda_id',$store->id);

            $gastosNomina = \App\admin\Gastos::select(DB::raw('count(*) as total, sum(importe) as importe'))
                                             ->where('status',1)
                                             ->where('clasificacion','Nomina')
                                             ->where('tienda_id',$store->id);

            $gastosIntBanc = \App\admin\Gastos::select(DB::raw('count(*) as total, sum(importe) as importe'))
                                              ->where('status',1)
                                              ->where('clasificacion','Intereses bancarios')
                                              ->where('tienda_id',$store->id);

            $gastosOtros = \App\admin\Gastos::select(DB::raw('count(*) as total, sum(importe) as importe'))
                                            ->where('status',1)
                                            ->where('clasificacion','Otros')
                                            ->where('tienda_id',$store->id);

            if($request->input('tipovta') != "") {

              $vtaMl->where('tipovta',$request->input('tipovta'));
              $costos->where('ventas.tipovta',$request->input('tipovta'));
            }

            if($request->input('fecha_desde') != "" && $request->input('fecha_hasta')) {

              $vtaMl->whereBetween('fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
              $ordenes->whereBetween('fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
              $compras->whereBetween('fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);

              $gastosPml->whereBetween('fgasto',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
              $gastosImpuestos->whereBetween('fgasto',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
              $gastosNomina->whereBetween('fgasto',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);
              $gastosIntBanc->whereBetween('fgasto',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);

              $costos->whereBetween('ventas.fecha',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);

              $garantias->whereBetween('fecha_operacion',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);


              $traspasos->whereBetween('fecha_autorizacion',[$request->input('fecha_desde'),$request->input('fecha_hasta')]);

            } elseif($request->input('fecha_desde') != "") {

              $vtaMl->where('fecha',$request->input('fecha_desde'));
              $ordenes->where('fecha',$request->input('fecha_desde'));
              $compras->where('fecha',$request->input('fecha_desde'));
              $gastosOtros->where('fgasto',$request->input('fecha_desde'));
              $garantias->where('fecha_operacion',$request->input('fecha_desde'));

              $gastosPml->where('fgasto',$request->input('fecha_desde'));
              $gastosImpuestos->where('fgasto',$request->input('fecha_desde'));
              $gastosNomina->where('fgasto',$request->input('fecha_desde'));
              $gastosIntBanc->where('fgasto',$request->input('fecha_desde'));

              $costos->where('ventas.fecha',$request->input('fecha_desde'));

              $traspasos->where('fecha_autorizacion',$request->input('fecha_desde'));

            } elseif($request->input('fecha_hasta') != "") {

              $vtaMl->where('fecha',$request->input('fecha_hasta'));
              $costos->where('ventas.fecha',$request->input('fecha_hasta'));
              $ordenes->where('fecha',$request->input('fecha_hasta'));
              $compras->where('fecha',$request->input('fecha_hasta'));
              $gastosOtros->where('fgasto',$request->input('fecha_hasta'));

              $gastosPml->where('fgasto',$request->input('fecha_hasta'));
              $gastosImpuestos->where('fgasto',$request->input('fecha_hasta'));
              $gastosNomina->where('fgasto',$request->input('fecha_hasta'));
              $gastosIntBanc->where('fgasto',$request->input('fecha_hasta'));
              $garantias->where('fecha_operacion',$request->input('fecha_hasta'));

              $traspasos->where('fecha_autorizacion',$request->input('fecha_hasta'));

            }

            $total_vtasml = $vtaMl->first();
            $total_ordenes = $ordenes->first();
            $total_compras = $compras->first();
            $total_gastos = $gastosOtros->first();

            $total_gpublicidad = $gastosPml->first();
            $total_gimpuestos = $gastosImpuestos->first();
            $total_gnomina = $gastosNomina->first();
            $total_gIntBanc = $gastosIntBanc->first();
            $total_garantias = $garantias->first();

            $total_traspasos = $traspasos->first();
            $total_costos    = $costos->first();

            $utilidad_bruta = $total_vtasml->subtotal - $total_costos->costo;

            $utilidad_neta = $utilidad_bruta - ($total_gpublicidad->importe + $total_gimpuestos->importe + $total_gnomina->importe + $total_gIntBanc->importe + $total_gastos->importe);

            $gran_total = $gran_total + $total_vtasml->importe;

            $gran_utilidad = $gran_utilidad + $total_vtasml->importe;

            $gastos_totales = $total_gpublicidad->importe + $total_gimpuestos->importe  + $total_gnomina->importe +$total_gIntBanc->importe + $total_garantias->importe;

            $stores_info[] = array(

              'nombre'     => $store->nombre,

              'id'         => $store->id,

              'total'      => $total_vtasml->importe,

              'utilidad'   => $utilidad_bruta

            );


            $data['Ingreso_por_producto'][$store->id]         = array('total'       => $total_vtasml->importe,
                                                                      'venta'       =>  round(($total_vtasml->importe / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   =>  round(($total_vtasml->importe / $total_costos->costo) * 100,2) . '%');

            $data['Ingreso_por_envio'][$store->id]            = array('total'       => 0,
                                                                      'venta'       => round((0 / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round((0 / $total_vtasml->importe) * 100,2) . '%');

            $data['Cargos_Envios_e_Impuestos'][$store->id]    = array('total'       => $total_vtasml->impuesto,
                                                                      'venta'       => round(($total_vtasml->impuesto / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_vtasml->impuesto / $total_costos->costo) * 100,2) . '%');

            $data['Costos_Envio'][$store->id]                 = array('total'       => $total_vtasml->costo_envio,
                                                                      'venta'       => round(($total_vtasml->costo_envio / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_vtasml->costo_envio / $total_costos->costo) * 100,2) . '%');

            $data['Anulaciones_y_Rembolsos'][$store->id]      =  array('total'      => $total_vtasml->anulaciones,
                                                                       'venta'      => round(($total_vtasml->anulaciones / $total_vtasml->importe) * 100,2) . '%',
                                                                       'inversion'  => round(($total_vtasml->anulaciones / $total_costos->costo) * 100,2) . '%');

            $data['SubTotal_de_Ingresos'][$store->id]         = array('total'       => $total_vtasml->subtotal,
                                                                      'venta'       => round(($total_vtasml->subtotal / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_vtasml->subtotal / $total_costos->costo) * 100,2) . '%');

            $data['Costos_Totales_de_Productos'][$store->id]  = array('total'       => $total_costos->costo,
                                                                      'venta'       => round(($total_costos->costo / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_costos->costo / $total_costos->costo) * 100,2) . '%');

            $data['Utilidad_bruta'][$store->id]               = array('total'       => $utilidad_bruta,
                                                                      'venta'       => round(($utilidad_bruta / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($utilidad_bruta / $total_costos->costo) * 100,2) . '%');

            $data['Garantias'][$store->id]                    = array('total'       => $total_garantias->importe,
                                                                      'venta'       => round(($total_garantias->importe / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_garantias->importe / $total_costos->costo) * 100,2) . '%');

            $data['Publicidad_ML'][$store->id]                = array('total'       => $total_gpublicidad->importe,
                                                                      'venta'       => round(($total_gpublicidad->importe / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_gpublicidad->importe / $total_costos->costo) * 100,2) . '%');

            $data['Impuestos'][$store->id]                    = array('total'       => $total_gimpuestos->importe,
                                                                      'venta'       => round(($total_gimpuestos->importe / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_gimpuestos->importe / $total_costos->costo) * 100,2) . '%');

            $data['Nomina'][$store->id]                       = array('total'       => $total_gnomina->importe,
                                                                      'venta'       => round(($total_gnomina->importe / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_gnomina->importe / $total_costos->costo) * 100,2) . '%');

            $data['Intereses_bancarios'][$store->id]          = array('total'       => $total_gIntBanc->importe,
                                                                      'venta'       => round(($total_gIntBanc->importe / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_gIntBanc->importe / $total_costos->costo) * 100,2) . '%');

            $data['Otros'][$store->id]                        = array('total'       => $total_gastos->importe,
                                                                      'venta'       => round(($total_gastos->importe / $total_vtasml->importe) * 100,2) . '%',
                                                                      'inversion'   => round(($total_gastos->importe / $total_costos->costo) * 100,2) . '%');


          $data['Gastos_totales'][$store->id]                = array('total'       => $gastos_totales,
                                                                     'venta'       => round(($gastos_totales / $total_vtasml->importe) * 100,2) . '%',
                                                                     'invesion'    => round(($gastos_totales / $total_costos->costo) * 100,2) . '%');




            $data['Utilidad_Neta'][$store->id]                = array('total'       => $utilidad_neta,
                                                                      'venta'       => round(($utilidad_neta / $total_vtasml->importe) * 100,2) . '%',
                                                                      'invesion'    => round(($utilidad_neta / $total_costos->costo) * 100,2) . '%');

            $data['Unidades_vendidas'][$store->id]            = array('total'       => $total_costos->total,
                                                                      'venta'       => '0',
                                                                      'inversion'   => ' ');


            $precio_promedio                                  = ($total_vtasml->importe / $total_costos->total);
            $costo_promedio                                   = ($total_costos->costo / $total_costos->total);

            $data['Precio_promedio'][$store->id]              = array('total'       => $precio_promedio,
                                                                      'promedio'    => round(($costo_promedio / $precio_promedio) * 100,2) . '%',
                                                                      'inversion'   => ' ');

            $data['Costo_promedio'][$store->id]               = array('total'       => $costo_promedio,
                                                                      'venta'       => round(($costo_promedio / $costo_promedio) * 100,2) . '%',
                                                                      'inversion'   => ' ');

          }

        }

        return view('reportes/operaciones', ['data' => $data,'data_tiendas' => $stores_info,'gran_total' => $gran_total,'gran_utilidad' => $gran_utilidad]);
    }

    public function rptInversion(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas = new \App\admin\Ventas;

        $config = array();

        $config['titulo'] = "Entradas y Salidas de Productos";

        $config['cancelar'] = url('/admin/reportes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $data = array();

        return view('reportes/inversion', ['query' =>$_SERVER['QUERY_STRING'],'data' => $data]);
    }
}
