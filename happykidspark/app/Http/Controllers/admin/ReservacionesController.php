<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservaciones;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservacionesController extends Controller
{
    public $v_fields=array('reservaciones.user_id', 'reservaciones.cliente_id', 'reservaciones.tutor', 'reservaciones.fecha_registro', 'reservaciones.fecha_reserva', 'reservaciones.subtotal', 'reservaciones.total', 'reservaciones.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $reservaciones = new \App\admin\Reservaciones;

        $config = array();

        $config['titulo'] = "reservaciones";

        $config['cancelar'] = url('/admin/reservaciones');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de reservaciones",
            'href' => url('/admin/reservaciones'),
            'active' => false
        );

        $data = $reservaciones->getReservacionesData($per_page, $request, $sortBy, $order);

        return view('admin/reservaciones/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $reservaciones = new \App\admin\Reservaciones;

      $config = array();

      $config['titulo'] = "reservaciones";

      $config['cancelar'] = url('/admin/reservaciones');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de reservaciones",
          'href' => url('/admin/reservaciones'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar reservaciones",
          'href' => url('/admin/reservaciones/add'),
          'active' => true
      );

      $data = new $reservaciones;

    	return view('admin/reservaciones/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $reservaciones = new \App\admin\Reservaciones;
        $reservaciones->addReservaciones($request);
        $request->session()->flash('message', 'reservaciones Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ReservacionesController@index');
    }

    public function getEdit($id=''){

        $reservaciones = new \App\admin\Reservaciones;

        $users = $reservaciones->getAll('reservaciones');

        $data = $reservaciones->getReservaciones($id);

        $config = array();

        $config['titulo'] = "reservaciones";

        $config['cancelar'] = url('/admin/reservaciones');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de reservaciones",
            'href' => url('/admin/reservaciones'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar reservaciones",
            'href' => url('/admin/reservaciones/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/reservaciones/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/reservaciones/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $reservaciones = new \App\admin\Reservaciones;
        if($reservaciones->updateReservaciones($request)){
            $request->session()->flash('message', 'reservaciones Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ReservacionesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ReservacionesController@index');
        }
    }

    public function view($id){

      $reservaciones = new \App\admin\Reservaciones;

      $data = $reservaciones->getReservacionesView($id);

      $pdf = \App::make('dompdf.wrapper')->setPaper('b7', 'portrait');

      for($i=0; $i<$data->cantidad; $i++) {
        $string = ' Nombre ' .$data->tutor . ' F. Reserva: ' . $data->fecha_reserva . ' Folio: ' . $data->id;
        $html .= '<div style="text-align:center;">
                    <h2>' . strtoupper($data->tutor) . '</h2>
                    <img src="data:image/png;base64,' . base64_encode(QrCode::size(150)->generate($string)) . '" style="margin-bottom:50px;">
                  </div>';
      }
      $pdf->loadHTML($html);

      return $pdf->stream();

    }

    public function baja($id){

        $reservaciones = new \App\admin\Reservaciones;
        $flag = $reservaciones->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$reservaciones deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ReservacionesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ReservacionesController@index');
        }
    }

    public function alta($id){
        $reservaciones = new \App\admin\Reservaciones;
        $flag = $reservaciones->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$reservaciones habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ReservacionesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ReservacionesController@index');
        }
    }

    public function getAjax($id){

      $reservaciones = new \App\admin\Reservaciones;

      $data = $reservaciones->getReservacionesView($id);

      if(count($data)){

        $prods                = explode(',',$data->productos_id);
        $html                 = '';
        $items                = 0;
        $temporizadores       = 0;
        $subtotal             = 0;
        $banda                = \App\admin\Bandas::find($data->banda_id);
        $bandas_usadas        = $banda->usadas;

        foreach($prods as $det) {

          $banda_actual       = $banda->actual;
          $bandas_consecutivo = ($data->banda->actual + $data->cantidad);

          $bandas_usadas      = $bandas_usadas + $data->cantidad;
          $prod_info  =\App\admin\Productos::find($det);

            $imagen = asset('images/slider/04.jpg');

            $html .= '<div class="row items_rows" id="item_vta_' . $items . '">';
                $html .= '<div class="col-md-2 sepate-line">';
                  $html .= '<img src="' . $imagen .'" class="rounded" width="70" height="60" alt="Avatar">';
                $html .= '</div>';
                $html .= '<div class="col-md-8 sepate-line">';
                  $html .= $prod_info->nombre . ' <span class="badge badge-primary">$ ' . round($data->tiempo->costo,2) . '</span> <br/>';

                  $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][producto_id]" value="' . $prod_info->id . '" />';
                  $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][tipo]" value="' . $prod_info->tipo . '" />';
                  $html .= '<input type="hidden" class="form-control importes" name="vendido[' . $items . '][importe]" id="importe_' . $items . '" value="' . $prod_info->precio . '" />';
                  $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][precio]" id="precio_' . $items . '" value="' . $prod_info->precio . '" />';

                  $html .= $data->tutor . ' ' . $data->tiempo->minutos . ' Minutos / ' . $data->cantidad . ' Personas <br/>';


                  $html .= ' <i class="fa fa-ring fa-lg" style="color:' . $banda->rgb. '"></i>  ' . $banda->serie . $banda->actual .' A ' . $banda->serie .($banda->actual + $data->cantidad) . ' <br/>';

                  $html .= '<small id="tempo_detail_' . $items . '">';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][tiempo_id]" value="' . $data->tiempo_id . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][nombre]" value=" Reserva # ' . $data->id .  ' ' . $data->tutor . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][telefono]" value="' . $data->telefono . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][barras]" value="0" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][banda_id]" value="' . $banda->id . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][banda_cantidad]" value="' . $data->cantidad . '" />';
                    $html .= '<input type="hidden" class="form-control" name="vendido[' . $items . '][temporizadores][' . $temporizadores . '][banda_consecutivo]" value="' . $bandas_consecutivo . '" />';

                  $html .= '</small><br/>';
                  $html .= '<input type="hidden" min="1" class="form-control"  readonly name="vendido[' . $items . '][cantidad]" id="cantidad_' . $items . '" value="' . $data->cantidad . '" onchange="calculaImporte(' . $items . ')">';
                $html .= '</div>';
                $html .= '<div class="col-md-2 sepate-right">';
                  $html .= '<button  onclick="removeItem(' . $items . ');" style="background:none !important; border:0px !important; color: #ea5455 !important;" class="btn btn-danger waves-effect waves-float waves-light" type="button"/>';
                   $html .= '<i class="fa fa-times-circle fa-2x "></i>';
                  $html .= '</button>';
                $html .= '</div>';
              $html .= '</div>';

              $items++;
              $temporizadores++;
        }

        $subtotal = $data->tiempo->costo * $data->cantidad;

        $cte_nombre = \App\admin\Clientes::find($data->cliente_id);

        if($bandas_usadas < $banda->unidades) {

          return array('error'           => 0,
                       'msg'             => '',
                       'data'            => $data,
                       'html'            => $html,
                       'temporizadores'  => $temporizadores,
                       'items'           => $items,
                       'total'           => $subtotal,
                       'banda_actual'    => $banda_actual,
                       'consecutivo'     => $bandas_consecutivo,
                       'banda_id'        => $banda->id,
                       'cte_nombre'      => $cte_nombre->nombre);

        } else {
          return array('error' =>1, 'msg' => "La cantidad requerida es mayor a las bandas en inventario " . ($banda->unidades - $banda->usadas) . ", solicite una actualizacion o seleccione otras bandas disponibles",'data' => array());
        }

      } else{

        return array('error' =>1, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $reservaciones = new \App\admin\Reservaciones;

      $data = $reservaciones->getReservacionesExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$reservaciones', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
