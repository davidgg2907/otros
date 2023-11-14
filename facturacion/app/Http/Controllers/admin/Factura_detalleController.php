<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Factura_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Factura_detalleController extends Controller
{
    public $v_fields=array('factura_detalle.id', 'factura_detalle.ClaveProdServ', 'factura_detalle.NoIdentificacion', 'factura_detalle.Cantidad', 'factura_detalle.ClaveUnidad', 'factura_detalle.Unidad', 'factura_detalle.Descripcion', 'factura_detalle.ValorUnitario', 'factura_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $factura_detalle = new \App\admin\Factura_detalle;

        $config = array();

        $config['titulo'] = "factura_detalle";

        $config['cancelar'] = url('/admin/factura_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de factura_detalle",
            'href' => url('/admin/factura_detalle'),
            'active' => false
        );

        $data = $factura_detalle->getFactura_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/factura_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $factura_detalle = new \App\admin\Factura_detalle;

      $config = array();

      $config['titulo'] = "factura_detalle";

      $config['cancelar'] = url('/admin/factura_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de factura_detalle",
          'href' => url('/admin/factura_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar factura_detalle",
          'href' => url('/admin/factura_detalle/add'),
          'active' => true
      );

      $data = new $factura_detalle;

    	return view('admin/factura_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $factura_detalle = new \App\admin\Factura_detalle;
        $factura_detalle->addFactura_detalle($request);
        $request->session()->flash('message', 'factura_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Factura_detalleController@index');
    }

    public function getEdit($id=''){

        $factura_detalle = new \App\admin\Factura_detalle;

        $users = $factura_detalle->getAll('factura_detalle');

        $data = $factura_detalle->getFactura_detalle($id);

        $config = array();

        $config['titulo'] = "factura_detalle";

        $config['cancelar'] = url('/admin/factura_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de factura_detalle",
            'href' => url('/admin/factura_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar factura_detalle",
            'href' => url('/admin/factura_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/factura_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/factura_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $factura_detalle = new \App\admin\Factura_detalle;
        if($factura_detalle->updateFactura_detalle($request)){
            $request->session()->flash('message', 'factura_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\Factura_detalleController@index');
    }

    public function view($id){

      $factura_detalle = new \App\admin\Factura_detalle;

      $data = $factura_detalle->getFactura_detalleView($id);

      $config = array();

      $config['titulo'] = "factura_detalle";

      $config['cancelar'] = url('/admin/factura_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de factura_detalle",
          'href' => url('/admin/factura_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de factura_detalle",
          'href' => url('/admin/factura_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/factura_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/factura_detalle/view');

      }

    }

    public function baja($id){

        $factura_detalle = new \App\admin\Factura_detalle;
        $flag = $factura_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$factura_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Factura_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Factura_detalleController@index');
        }
    }

    public function alta($id){
        $factura_detalle = new \App\admin\Factura_detalle;
        $flag = $factura_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$factura_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Factura_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Factura_detalleController@index');
        }
    }

    public function getAjax($id){

      $factura_detalle = new \App\admin\Factura_detalle;

      $data = $factura_detalle->getFactura_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $factura_detalle = new \App\admin\Factura_detalle;

      $data = $factura_detalle->getFactura_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$factura_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
