<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas_facturacion;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Ventas_facturacionController extends Controller
{
    public $v_fields=array('ventas_facturacion.id', 'ventas_facturacion.usr_id', 'ventas_facturacion.cliente_id', 'ventas_facturacion.tienda_id', 'ventas_facturacion.adjunta', 'ventas_facturacion.nombre', 'ventas_facturacion.documento', 'ventas_facturacion.domicilio', 'ventas_facturacion.tipoc', 'ventas_facturacion.rfc', 'ventas_facturacion.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas_facturacion = new \App\admin\Ventas_facturacion;

        $config = array();

        $config['titulo'] = "ventas_facturacion";

        $config['cancelar'] = url('/admin/ventas_facturacion');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ventas_facturacion",
            'href' => url('/admin/ventas_facturacion'),
            'active' => false
        );

        $data = $ventas_facturacion->getVentas_facturacionData($per_page, $request, $sortBy, $order);

        return view('admin/ventas_facturacion/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function view($id){

      $ventas_facturacion = new \App\admin\Ventas_facturacion;

      $data = $ventas_facturacion->getVentas_facturacionView($id);

      $config = array();

      $config['titulo'] = "ventas_facturacion";

      $config['cancelar'] = url('/admin/ventas_facturacion');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ventas_facturacion",
          'href' => url('/admin/ventas_facturacion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de ventas_facturacion",
          'href' => url('/admin/ventas_facturacion/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/ventas_facturacion/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/ventas_facturacion/view');

      }

    }

    public function baja($id){

        $ventas_facturacion = new \App\admin\Ventas_facturacion;
        $flag = $ventas_facturacion->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$ventas_facturacion deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ventas_facturacionController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_facturacionController@index');
        }
    }

    public function alta($id){
        $ventas_facturacion = new \App\admin\Ventas_facturacion;
        $flag = $ventas_facturacion->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$ventas_facturacion habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ventas_facturacionController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_facturacionController@index');
        }
    }

    public function getAjax($id){

      $ventas_facturacion = new \App\admin\Ventas_facturacion;

      $data = $ventas_facturacion->getVentas_facturacionView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $ventas_facturacion = new \App\admin\Ventas_facturacion;

      $data = $ventas_facturacion->getVentas_facturacionExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$ventas_facturacion', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
