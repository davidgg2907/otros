<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Garantia;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class GarantiaController extends Controller
{
    public $v_fields=array('garantia.venta_id', 'garantia.detalle_id', 'garantia.producto_id', 'garantia.cantidad', 'garantia.situacion', 'garantia.importe', 'garantia.motivo', 'garantia.fecha_operacion', 'garantia.fecha_alta', 'garantia.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $garantia = new \App\admin\Garantia;

        $config = array();

        $config['titulo'] = "garantia";

        $config['cancelar'] = url('/admin/garantia');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de garantia",
            'href' => url('/admin/garantia'),
            'active' => false
        );

        $data = $garantia->getGarantiaData($per_page, $request, $sortBy, $order);

        return view('admin/garantia/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $garantia = new \App\admin\Garantia;

      $config = array();

      $config['titulo'] = "garantia";

      $config['cancelar'] = url('/admin/garantia');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de garantia",
          'href' => url('/admin/garantia'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar garantia",
          'href' => url('/admin/garantia/add'),
          'active' => true
      );

      $data = new $garantia;

    	return view('admin/garantia/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

      if(count($request->input('devolucion'))) {

        foreach($request->input('devolucion') as $key => $devolver) {

          $vta_tienda = \App\admin\Ventas::find($devolver['venta_id']);
          $garantia = new \App\admin\Garantia;
          $garantia->venta_id         = $devolver['venta_id'];
          $garantia->tienda_id        = $vta_tienda->tienda_id;
        	$garantia->detalle_id       = $key;
        	$garantia->producto_id      = $devolver['producto_id'];
        	$garantia->cantidad         = $devolver['cant_devolver'];
          $garantia->importe          = ($devolver['cant_devolver'] * $devolver['precios']);
        	$garantia->situacion        = $request->input('situacion')!="" ? $request->input('situacion') : "";
        	$garantia->motivo           = $request->input('motivo')!="" ? $request->input('motivo') : "";
        	$garantia->fecha_operacion  = date('Y-m-d');
        	$garantia->fecha_alta       = date('Y-m-d');
        	$garantia->status           = 1;
          $garantia->save();

          if($request->input('situacion') == 1) {



            $producto = \App\admin\Productos::find($devolver['producto_id']);

            if($producto->kit == "SI") {

              //Traemos los productos que tiene el kit para descontarlos
              $kit_items = \App\admin\Productos_kit::where('producto_id',$devolver['producto_id'])->get();

              foreach($kit_items as $kitems) {

                $retiroKit  = array(

                  'almacen_id'    => 1,

                  'producto_id'   => $kitems->prod_adjunto_id,

                  'operacion'     => "S",

                  'cantidad'      => $kitems->cantidad * $devolver['cant_devolver'],

                  'motivo'        => "Devolucion de mercancia por venta, motivo: " . $request->input('motivo'),

                );

                \App\admin\Inventario::inventariar($retiroKit);

              }

            } else {

              //La operacion genera un reingreso a almacen, lo inventariamos
              $destino  = array(

                'almacen_id'    => 1,

                'producto_id'   => $devolver['producto_id'],

                'operacion'     => 'S',

                'cantidad'      => $devolver['cant_devolver'],

                'motivo'        => "Devolucion de mercancia por venta, motivo: " . $request->input('motivo'),

              );

              \App\admin\Inventario::inventariar($destino);


            }

          }


        }

        $request->session()->flash('message', 'Operacion procesada exitosamente!');
        $request->session()->flash('exito', 'true');
      } else {
        $request->session()->flash('message', 'garantia Agregado exitosamente!');
        $request->session()->flash('exito', 'fracaso');
      }

      return redirect()->action('admin\GarantiaController@index');
    }


    public function getEdit($id=''){

        $garantia = new \App\admin\Garantia;

        $users = $garantia->getAll('garantia');

        $data = $garantia->getGarantia($id);

        $config = array();

        $config['titulo'] = "garantia";

        $config['cancelar'] = url('/admin/garantia');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de garantia",
            'href' => url('/admin/garantia'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar garantia",
            'href' => url('/admin/garantia/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/garantia/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/garantia/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $garantia = new \App\admin\Garantia;
        if($garantia->updateGarantia($request)){
            $request->session()->flash('message', 'garantia Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\GarantiaController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\GarantiaController@index');
        }
    }

    public function view($id){

      $garantia = new \App\admin\Garantia;

      $data = $garantia->getGarantiaView($id);

      $config = array();

      $config['titulo'] = "garantia";

      $config['cancelar'] = url('/admin/garantia');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de garantia",
          'href' => url('/admin/garantia'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de garantia",
          'href' => url('/admin/garantia/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/garantia/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/garantia/view');

      }

    }

    public function baja($id){

        $garantia = new \App\admin\Garantia;
        $flag = $garantia->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$garantia deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\GarantiaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\GarantiaController@index');
        }
    }

    public function alta($id){
        $garantia = new \App\admin\Garantia;
        $flag = $garantia->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$garantia habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\GarantiaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\GarantiaController@index');
        }
    }

    public function getAjax($id){

      $garantia = new \App\admin\Garantia;

      $data = $garantia->getGarantiaView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $garantia = new \App\admin\Garantia;

      $data = $garantia->getGarantiaExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$garantia', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
