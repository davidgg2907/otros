<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VentasController extends Controller
{
    public $v_fields=array('ventas.cliente_id', 'ventas.user_id', 'ventas.fecha', 'ventas.hora', 'ventas.subtotal', 'ventas.impuesto', 'ventas.totald', 'ventas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas = new \App\admin\Ventas;

        $config = array();

        $config['titulo'] = "ventas";

        $config['cancelar'] = url('/admin/ventas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ventas",
            'href' => url('/admin/ventas'),
            'active' => false
        );

        $data = $ventas->getVentasData($per_page, $request, $sortBy, $order);

        return view('admin/ventas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $ventas = new \App\admin\Ventas;

      $config = array();

      $config['titulo'] = "ventas";

      $config['cancelar'] = url('/admin/ventas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ventas",
          'href' => url('/admin/ventas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar ventas",
          'href' => url('/admin/ventas/add'),
          'active' => true
      );

      $data = new $ventas;

    	return view('admin/ventas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $ventas = new \App\admin\Ventas;
        $ventas->addVentas($request);
        $request->session()->flash('message', 'ventas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\VentasController@index');
    }

    public function getEdit($id=''){

        $ventas = new \App\admin\Ventas;

        $users = $ventas->getAll('ventas');

        $data = $ventas->getVentas($id);

        $config = array();

        $config['titulo'] = "ventas";

        $config['cancelar'] = url('/admin/ventas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ventas",
            'href' => url('/admin/ventas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar ventas",
            'href' => url('/admin/ventas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/ventas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/ventas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $ventas = new \App\admin\Ventas;
        if($ventas->updateVentas($request)){
            $request->session()->flash('message', 'ventas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\VentasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\VentasController@index');
        }
    }

    public function view($id){

      $ventas = new \App\admin\Ventas;

      $data = $ventas->getVentasView($id);

      $config = array();

      $config['titulo'] = "ventas";

      $config['cancelar'] = url('/admin/ventas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ventas",
          'href' => url('/admin/ventas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de ventas",
          'href' => url('/admin/ventas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/ventas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/ventas/view');

      }

    }

    public function baja($id,Request $request){

        $ventas = new \App\admin\Ventas;
        $flag = $ventas->updateStatus($id,0);
        if($flag){
          Session::flash('message', '$ventas deshabilitado correctamente!');
          Session::flash('exito', 'true');
        } else{
          Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
          Session::flash('fracaso', 'true');
        }

        if($request->input('redirect') == 'pos') {
          return redirect()->action('admin\VentasController@getPos');
        } else {
          return redirect()->action('admin\VentasController@index');
        }

    }

    public function bajaAjax($id,Request $request){

      $ventas = \App\admin\Ventas::find($id);
      $code = \App\admin\Codigos::find($request->input('code_id'));

      if(count($code)) {

        $ventas->status = 0;
        $ventas->codigo_id = $request->input('code_id');
        $ventas->save();

        $code->status = 2;
        $code->usr_usa_id = Auth::user()->id;
        $code->save();

        //Reseteamos el codigo


        return array('error' =>0 ,'msg');

      } else {

        if($code->status == 2) {
          return array('error' =>1, 'msg' => 'El codigo ya ha sido utilizado','data' => array());
        } elseif ($code->status == 0) {
          return array('error' =>1, 'msg' => 'El codigo especificado ya ha caducado','data' => array());
        }

      }


    }

    public function alta($id){
        $ventas = new \App\admin\Ventas;
        $flag = $ventas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$ventas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\VentasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\VentasController@index');
        }
    }

    public function getAjax($id){

      $ventas = new \App\admin\Ventas;

      $data = $ventas->getVentasView($id);

      if(count($data)){


        $detalle = \App\admin\Venta_detalle::where('venta_id',$id)->get();

        $html             = '';
        $items            = 0;
        $temporizadores   = 0;

        foreach($detalle as $det) {

          $imagen = asset('images/slider/04.jpg');

          $html .= '<div class="row items_rows" id="item_vta_' . $items . '">';
              $html .= '<div class="col-md-2 sepate-line">';
                $html .= '<img src="' . $imagen .'" class="rounded" width="70" height="60" alt="Avatar">';
              $html .= '</div>';
              $html .= '<div class="col-md-8 sepate-line">';
                $html .= $det->productos->nombre . ' <span class="badge badge-primary">$ ' . round($det->productos->precio,2) . '</span> <br/>';

                $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][producto_id]" value="' . $det->id . '" />';
                $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][tipo]" value="' . $det->productos->tipo . '" />';
                $html .= '<input type="hidden" class="form-control importes" name="vendido[' . $items . '][importe]" id="importe_' . $items . '" value="' . $det->productos->precio . '" />';
                $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][precio]" id="precio_' . $items . '" value="' . $det->productos->precio . '" />';

                $tempos = \App\admin\Temporizador::where('venta_id',$data->id)->where('vtadetalle_id',$det->id)->get();
                if(count($tempos)) {
                  $html .= '<small id="tempo_detail_' . $items . '">';
                  foreach($tempos as $times) {
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][tiempo_id]" value="' . $times->tiempo_id . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][nombre]" value="' . $times->nombre . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][telefono]" value="' . $times->telefono . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][barras]" value="' . $times->barras . '" />';

                    $html .= $times->nombre . ' ' . $times->tiempo->minutos . ' Minutos <br/>';
                    $temporizadores++;
                  }
                  $html .= '</small><br/>';
                } else {
                  $html .= '<small id="tempo_detail_' . $items . '"></small><br/>';
                }

                if($det->productos->tipo == 1) {
                  $html .= '<div class="input-group input-group-lg">';
                      $html .= '<input type="number" min="1" class="touchspin form-control" name="vendido[' . $items . '][cantidad]" id="cantidad_' . $items . '" value="1" onchange="calculaImporte(' . $items . ')">';
                  $html .= '</div>';
                } else {
                  $html .= '<input type="number" min="1" class="form-control"  readonly name="vendido[' . $items . '][cantidad]" id="cantidad_' . $items . '" value="' . $temporizadores . '" onchange="calculaImporte(' . $items . ')">';
                }
              $html .= '</div>';
              $html .= '<div class="col-md-2 sepate-right">';
                $html .= '<button  onclick="removeItem(' . $items . ');" style="background:none !important; border:0px !important; color: #ea5455 !important;" class="btn btn-danger waves-effect waves-float waves-light" type="button"/>';
                 $html .= '<i class="fa fa-times-circle fa-2x "></i>';
                $html .= '</button>';
              $html .= '</div>';
            $html .= '</div>';

          $items++;

        }

        return array('error' =>0, 'msg' => '','data' => $data,'html' => $html,'temporizadores' => $temporizadores,'items' => $items);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $ventas = new \App\admin\Ventas;

      $data = $ventas->getVentasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$ventas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

    public function getPos(Request $request) {

      $caja = \App\admin\Cajas::where('user_id',Auth::user()->id)->where('status',1)->first();

      if(count($caja)) { $caja_id = $caja->id; } else { $caja_id = 0; }

      if(date('Y-m-d') > date('Y-m-d',strtotime($caja->inicia)) && $caja->status == 1 ) {
        //La caja tiene fecha del dia anterior forzamos el cierre
        $forza_cierre = 1;
        $forza_date = date('Y-m-d',strtotime($caja->inicia));
      } else {
        $forza_cierre = 0;
        $forza_date = "";
      }

      if(Auth::user()->perfil == 0) {
        $productos = \App\admin\Productos::where('status',1)->get();
      } else {

        if(Auth::user()->categoria_id != "") {
          $cats = explode(',',Auth::user()->categoria_id);

          $productos = \App\admin\Productos::where('status',1)->whereIn('categoria_id',$cats)->get();
        } else {
          $productos = \App\admin\Productos::where('status',1)->get();
        }

      }

      $bandas = \App\admin\Bandas::where('status',1)->get();

      if(count($bandas)) { $sales_timers = 1; } else { $sales_timers = 0;  }
      return view('admin/ventas/pos',['caja_id'       => $caja_id,
                                      'forza_cierre'  => $forza_cierre,
                                      'forza_date'    => $forza_date,
                                      'productos'     => $productos,
                                      'bandas'        => $bandas,
                                      'sales_timers'  => $sales_timers
                                      ]);

    }

    public function postPos(Request $request) {

      if($request->input('reserva_id') != 0) {

        $reserva = \App\admin\Reservaciones::find($request->input('reserva_id'));

        if(count($reserva)) {
          $reserva->status = 2;
          $reserva->save();
        }
      }

      if($request->input('venta_pause_id') == 0) {
        //La venta es directa y generada de una sola forma la insertamos
        //Creamos la venta principal
        $ventas = new \App\admin\Ventas;

        $ventas->cliente_id   = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "1";
      	$ventas->caja_id      = $request->input('caja_id');
        $ventas->reserva_id   = $request->input('reserva_id');
        $ventas->user_id      = Auth::user()->id;
      	$ventas->fecha        = date('Y-m-d');
      	$ventas->hora         = date('G:i:s');

        $ventas->metodo_pago  = $request->input('metodo_pago')!="" ? $request->input('metodo_pago') : null;
        $ventas->autorizacion = $request->input('autorizacion')!="" ? $request->input('autorizacion') : "0";
        $ventas->efectivo     = $request->input('efectivo')!="" ? $request->input('efectivo') : "0";
        $ventas->cambio       = $request->input('cambio')!="" ? $request->input('cambio') : "0";

        $ventas->subtotal     = $request->input('subtotal')!="" ? $request->input('subtotal') : "0";
      	$ventas->impuesto     = $request->input('impuestos')!="" ? $request->input('impuestos') : "0";
      	$ventas->totald       = $request->input('total')!="" ? $request->input('total') : "0";
      	$ventas->status       = $request->input('status_vta')!="" ? $request->input('status_vta') : "1";

        $ventas->save();

        if($request->input('status_vta') == 1) {

          Session::flash('ticket_id', $ventas->id);
          $request->session()->flash('message', 'Venta generada exitosamente');
          $request->session()->flash('exito', 'true');

        }else {

          $request->session()->flash('message', 'La venta ha sido pausada con exito');
          $request->session()->flash('exito', 'true');

        }



        foreach($request->input('vendido') as $lista) {

          $detallado = new \App\admin\Venta_detalle;

          $detallado->venta_id        = $ventas->id;
          $detallado->temporizador_id = 0;
          $detallado->producto_id     = $lista['producto_id'];
          $detallado->cantidad        = $lista['cantidad'];
          $detallado->precio          = $lista['precio'];
          $detallado->importe         = $lista['importe'];
          if($request->input('status_vta') == 1) {
            $detallado->status          = 1;
          }else {
            $detallado->status          = 0;
          }
          $detallado->save();

          if($request->input('status_vta') == 1) {

            //Ingresamos del almacen destino
            $destino  = array(
              'producto_id'   => $lista['producto_id'],
              'operacion'     => 'R',
              'cantidad'      => $lista['cantidad'],
              'motivo'        => 'Venta de producto, folio <a href="' . url('admin/compras/view/' . $ventas->id) . '"> # ' . $ventas->id . '</a>',
            );

            \App\admin\Inventario::inventariar($destino);

          }

          foreach($lista['temporizadores'] as $tempoInputs) {
            Session::flash('qrcodes', 1);
            //La venta tiene un temporizador de juego, lo anexamos
            $temporizador = new \App\admin\Temporizador;
            $temporizador->venta_id        = $ventas->id;
          	$temporizador->vtadetalle_id   = $detallado->id;
          	$temporizador->cliente_id      = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "1";
          	$temporizador->tiempo_id       = $tempoInputs['tiempo_id'];
          	$temporizador->producto_id     = $lista['producto_id'];
            $temporizador->banda_id        = $tempoInputs['banda_id'];
          	$temporizador->inicia          = date('Y-m-d g:i:s');
          	$temporizador->termina         = null;
          	$temporizador->nombre          = $tempoInputs['nombre'];
          	$temporizador->telefono        = $tempoInputs['telefono'];
          	$temporizador->qr              = null;
          	$temporizador->barras          = $tempoInputs['banda_consecutivo'];
            if($request->input('status_vta') == 1) {
              $temporizador->status          = 1;
            }else {
              $temporizador->status          = 0;
            }
            $temporizador->save();

            $banda = \App\admin\Bandas::find($tempoInputs['banda_id']);

            if(count($banda)) {
              $banda->actual = $tempoInputs['banda_consecutivo'];
              $banda->usadas = $banda->usadas + $tempoInputs['banda_cantidad'];

              if($banda->usadas >= $banda->unidades) { $banda->status = 2; $banda->usadas = $banda->unidades; }

              $banda->save();

            }


          }

        }

      } else {

        $ventas = \App\admin\Ventas::find($request->input('venta_pause_id'));

        $ventas->cliente_id   = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "1";
      	$ventas->caja_id      = $request->input('caja_id');
        $ventas->user_id      = Auth::user()->id;
      	$ventas->fecha        = date('Y-m-d');
      	$ventas->hora         = date('G:i:s');

        $ventas->metodo_pago  = $request->input('metodo_pago')!="" ? $request->input('metodo_pago') : null;
        $ventas->autorizacion = $request->input('autorizacion')!="" ? $request->input('autorizacion') : "0";
        $ventas->efectivo     = $request->input('efectivo')!="" ? $request->input('efectivo') : "0";
        $ventas->cambio       = $request->input('cambio')!="" ? $request->input('cambio') : "0";

        $ventas->subtotal     = $request->input('subtotal')!="" ? $request->input('subtotal') : "0";
      	$ventas->impuesto     = $request->input('impuestos')!="" ? $request->input('impuestos') : "0";
      	$ventas->totald       = $request->input('total')!="" ? $request->input('total') : "0";
      	$ventas->status       = $request->input('status')!="" ? $request->input('status') : "1";

        $ventas->save();

        //Eliminamos los detalles de la venta
        \App\admin\Venta_detalle::where('venta_id',$request->input('venta_pause_id'));
        //Eliminamos los temporizadores asignados a esta venta
        \App\admin\Temporizador::where('venta_id',$request->input('venta_pause_id'));

        foreach($request->input('vendido') as $lista) {

          $detallado = new \App\admin\Venta_detalle;

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

          foreach($lista['temporizadores'] as $tempoInputs) {

            Session::flash('qrcodes', 1);

            //La venta tiene un temporizador de juego, lo anexamos
            $temporizador = new \App\admin\Temporizador;
            $temporizador->venta_id        = $ventas->id;
          	$temporizador->vtadetalle_id   = $detallado->id;
          	$temporizador->cliente_id      = $request->input('cliente_id')!="" ? $request->input('cliente_id') : "1";
          	$temporizador->tiempo_id       = $tempoInputs['tiempo_id'];
          	$temporizador->producto_id     = $tempoInputs['producto_id'];
          	$temporizador->inicia          = date('Y-m-d g:i:s');
          	$temporizador->termina         = null;
          	$temporizador->nombre          = $tempoInputs['nombre'];
          	$temporizador->telefono        = $tempoInputs['telefono'];
          	$temporizador->qr              = null;
          	$temporizador->barras          = $tempoInputs['barras'];
            if($request->input('status_vta') == 1) {
              $temporizador->status          = 1;
            }else {
              $temporizador->status          = 0;
            }
          	$temporizador->save();

          }

        }

        Session::flash('ticket_id', $ventas->id);

        $request->session()->flash('message', 'Venta pusara ha sido generada exitosamente');
        $request->session()->flash('exito', 'true');

      }


      return redirect()->action('admin\VentasController@getPos');
    }

    public function getVoucher($id){

      $ventas = new \App\admin\Ventas;

      $data = $ventas->getVentasView($id);

      $pdf = PDF::loadView('admin/ventas/voucher', ['data' => $data,], [ 'title' => 'Voucher ' . $data->id, 'margin_top' => 0])
                ->setPaper('A8','portrait');;

      return $pdf->stream('inventario.pdf');

    }

    public function getQrcode($id){

      $ventas = new \App\admin\Ventas;

      $vta = $ventas->getVentasView($id);

      $temporizadores = \App\admin\Temporizador::where('venta_id',$id)
                                             ->get();

      $pdf = \App::make('dompdf.wrapper')->setPaper('A8', 'portrait');


      if((int)$vta->reserva_id != 0) {

        $html = '';

        $reserva = \App\admin\Reservaciones::find($vta->reserva_id);

        for($i=0; $i<$reserva->cantidad; $i++) {
          $string = ' Nombre ' .$reserva->tutor . ' F. Reserva: ' . $reserva->fecha_reserva . ' Folio: ' . $reserva->id;
          $html .= '<div style="text-align:center;">
                      <h2>' . strtoupper($reserva->tutor) . '</h2>
                      <img src="data:image/png;base64,' . base64_encode(QrCode::size(150)->generate($string)) . '" style="margin-bottom:50px;">
                    </div>';
        }
        $pdf->loadHTML($html);

      } else {

        foreach($temporizadores as $tempos) {

          $detalla = \App\admin\Venta_detalle::find($tempos->vtadetalle_id);

          for($siguiente = 0; $siguiente < $detalla->cantidad; $siguiente++) {

            $string = ' Nombre ' .$tempos->nombre . ' Telefono: ' . $tempos->telefono . ' Banda: ' . $tempos->barras;
            $html .= '<div style="text-align:center;">
                        <h2>' . strtoupper($tempos->nombre) . '</h2>
                        <img src="data:image/png;base64,' . base64_encode(QrCode::size(150)->generate($string)) . '" style="margin-bottom:50px;">
                      </div>';

          }

        }

        $pdf->loadHTML($html);

      }

      return $pdf->stream();

    }

    public function getMisVentas($caja) {

      $data = \App\admin\Ventas::where('caja_id',$caja)->get();

      if(count($data)) {

        $total_canceladas = 0; $total_activas = 0; $total_pausadas = 0;
        foreach($data as $value) {

          if($value->status == 1) {
            $total_activas += $value->totald;
          }elseif ($value->status == 3) {
            $total_pausadas += $value->totald;
          } else {
            $total_canceladas += $value->totald;
          }
          $qrs = \App\admin\Temporizador::where('venta_id',$value->id)->get();

          $cliente = $value->cliente_id != "" ? $value->cliente->nombre : 'PUBLICO EN GENERAL';
          if($value->status == 0){ $class = 'table-danger'; }
          elseif($value->status == 3) { $class="table-warning"; }
          else { $class = ''; }

          $html .= '<tr ' . $class_css . ' class="' . $class . '">
                      <td>' . $cliente . '</td>
                      <td>' . $value->user->name . '</td>
                      <td>' . $value->fecha . '</td>
                      <td>' . $value->hora .' </td>
                      <td> $ ' . number_format($value->subtotal,0,".",",") . '</td>
                      <td> $ ' . number_format($value->totald,0,".",",") . '</td>
                      <td class="text-center">';

                      if($value->status == 3) {
                        $html .= '<a href="javascript:void(0)" onclick="traeVentaPausada(' . $value->id . ')" title="Traer Venta Pausada" data-toggle="tooltip">
           						             <i class="fa fa-play-circle fa-lg text-success m-r-10"></i>
           						           </a>';
                      }

                      $html .= '<a href="javascript:void(0)" onclick="reimprime(' . $value->id . ')" title="Imprimir Ticket" data-toggle="tooltip">
                                 <i class="fa fa-receipt fa-lg text-info m-r-10"></i>
                               </a>';

                      if(count($qrs)) {
                        $html .= '<a href="javascript:void(0)" onclick="reimprimeQr(' . $value->id . ')" title="Imprimir Codigos QR" data-toggle="tooltip">
                                   <i class="fa fa-qrcode fa-lg text-primary m-r-10"></i>
                                 </a>';
                      }

                      if($value->status != 0) {

                        $html .= '<button type="button" data-toggle="tooltip" onclick="cancelaVenta(' . $value->id . ')" style="border:0px; background:none" ticle="Cancelar Venta">
           						             <i class="fa fa-trash-o fa-lg text-danger m-r-10"></i>
           						           </button>';

                      }

              $html .= '</td>
                    </tr>';


          $tempos = \App\admin\Temporizador::where('venta_id',$value->id)->get();

          if(count($tempos)) {
            $html .= '<tr class="' . $class . '">
                        <td colspan="6">
                          <div class="row" style="margin-left:10px;">';
                          foreach($tempos as $times) {
                            $html .= '<div class="col-md-4"> <i class="fa fa-user-circle fa-lg"></i> ' . $times->nombre .  ' <i class="fa fa-barcode fa-lg"></i> ' . $times->barras .  '</div>';
                          }
            $html .= '    </div>
                        <td>
                      </tr>';
          }

        }

        $html .= '<tr class="table-success">
                    <td colspan="2"><b>CANCELADAS: <b> $ ' . number_format($total_canceladas,0,".",",") . '</b></td>
                    <td colspan="2"><b>COMPLETADAS: <b>$ ' . number_format($total_activas,0,".",",") . '</b></td>
                    <td colspan="3"><b>PAUSADAS: <b>$ ' . number_format($total_pausadas,0,".",",") . '</b></td>
                  </tr>';

        return array('error' =>0, 'html' => $html);

      } else {
        return array('error' =>1, 'html' => '');
      }


      echo $html;
    }
}
