<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ventas_envios;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Ventas_enviosController extends Controller
{
    public $v_fields=array('ventas_envios.id', 'ventas_envios.usr_id', 'ventas_envios.venta_id', 'ventas_envios.cliente_id', 'ventas_envios.forma_envio', 'ventas_envios.en_camino', 'ventas_envios.fecha_entrega', 'ventas_envios.transportista', 'ventas_envios.guia', 'ventas_envios.tipo_envio', 'ventas_envios.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ventas_envios = new \App\admin\Ventas_envios;

        $config = array();

        $config['titulo'] = "ventas_envios";

        $config['cancelar'] = url('/admin/ventas_envios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ventas_envios",
            'href' => url('/admin/ventas_envios'),
            'active' => false
        );

        $data = $ventas_envios->getVentas_enviosData($per_page, $request, $sortBy, $order);

        return view('admin/ventas_envios/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $ventas_envios = new \App\admin\Ventas_envios;

      $config = array();

      $config['titulo'] = "ventas_envios";

      $config['cancelar'] = url('/admin/ventas_envios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ventas_envios",
          'href' => url('/admin/ventas_envios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar ventas_envios",
          'href' => url('/admin/ventas_envios/add'),
          'active' => true
      );

      $data = new $ventas_envios;

    	return view('admin/ventas_envios/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $ventas_envios = new \App\admin\Ventas_envios;
        $ventas_envios->addVentas_envios($request);
        $request->session()->flash('message', 'ventas_envios Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Ventas_enviosController@index');
    }

    public function getEdit($id=''){

        $ventas_envios = new \App\admin\Ventas_envios;

        $users = $ventas_envios->getAll('ventas_envios');

        $data = $ventas_envios->getVentas_envios($id);

        $config = array();

        $config['titulo'] = "ventas_envios";

        $config['cancelar'] = url('/admin/ventas_envios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ventas_envios",
            'href' => url('/admin/ventas_envios'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar ventas_envios",
            'href' => url('/admin/ventas_envios/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/ventas_envios/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/ventas_envios/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $ventas_envios = new \App\admin\Ventas_envios;
        if($ventas_envios->updateVentas_envios($request)){
            $request->session()->flash('message', 'ventas_envios Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Ventas_enviosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_enviosController@index');
        }
    }

    public function view($id){

      $ventas_envios = new \App\admin\Ventas_envios;

      $data = $ventas_envios->getVentas_enviosView($id);

      $config = array();

      $config['titulo'] = "ventas_envios";

      $config['cancelar'] = url('/admin/ventas_envios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ventas_envios",
          'href' => url('/admin/ventas_envios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de ventas_envios",
          'href' => url('/admin/ventas_envios/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/ventas_envios/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/ventas_envios/view');

      }

    }

    public function baja($id){

        $ventas_envios = new \App\admin\Ventas_envios;
        $flag = $ventas_envios->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$ventas_envios deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ventas_enviosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_enviosController@index');
        }
    }

    public function alta($id){
        $ventas_envios = new \App\admin\Ventas_envios;
        $flag = $ventas_envios->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$ventas_envios habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Ventas_enviosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Ventas_enviosController@index');
        }
    }

    public function getAjax($id){

      $ventas_envios = new \App\admin\Ventas_envios;

      $data = $ventas_envios->getVentas_enviosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $ventas_envios = new \App\admin\Ventas_envios;

      $data = $ventas_envios->getVentas_enviosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$ventas_envios', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
