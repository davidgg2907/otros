<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Envios;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class EnviosController extends Controller
{
    public $v_fields=array('envios.id', 'envios.usr_id', 'envios.cliente_id', 'envios.tienda_id', 'envios.folioml', 'envios.publicacion', 'envios.entrega', 'envios.facturacion', 'envios.factura_adjunto', 'envios.facturado_a', 'envios.documento_factura', 'envios.domicilio', 'envios.tipo_contribuyente', 'envios.rfc_contribuyente', 'envios.domicilio_contribuyente', 'envios.forma_envio', 'envios.en_camino', 'envios.fecha_entrega', 'envios.transportista', 'envios.guia', 'envios.tipo_envio', 'envios.fecha', 'envios.subtotal', 'envios.descuento', 'envios.iva', 'envios.total', 'envios.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $envios = new \App\admin\Envios;

        $config = array();

        $config['titulo'] = "envios";

        $config['cancelar'] = url('/admin/envios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de envios",
            'href' => url('/admin/envios'),
            'active' => false
        );

        $data = $envios->getEnviosData($per_page, $request, $sortBy, $order);

        return view('admin/envios/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $envios = new \App\admin\Envios;

      $config = array();

      $config['titulo'] = "envios";

      $config['cancelar'] = url('/admin/envios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de envios",
          'href' => url('/admin/envios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar envios",
          'href' => url('/admin/envios/add'),
          'active' => true
      );

      $data = new $envios;

    	return view('admin/envios/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $envios = new \App\admin\Envios;
        $envios->addEnvios($request);
        $request->session()->flash('message', 'envios Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\EnviosController@index');
    }

    public function getEdit($id=''){

        $envios = new \App\admin\Envios;

        $users = $envios->getAll('envios');

        $data = $envios->getEnvios($id);

        $config = array();

        $config['titulo'] = "envios";

        $config['cancelar'] = url('/admin/envios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de envios",
            'href' => url('/admin/envios'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar envios",
            'href' => url('/admin/envios/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/envios/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/envios/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $envios = new \App\admin\Envios;
        if($envios->updateEnvios($request)){
            $request->session()->flash('message', 'envios Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\EnviosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\EnviosController@index');
        }
    }

    public function view($id){

      $envios = new \App\admin\Envios;

      $data = $envios->getEnviosView($id);

      $config = array();

      $config['titulo'] = "envios";

      $config['cancelar'] = url('/admin/envios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de envios",
          'href' => url('/admin/envios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de envios",
          'href' => url('/admin/envios/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/envios/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/envios/view');

      }

    }

    public function baja($id){

        $envios = new \App\admin\Envios;
        $flag = $envios->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$envios deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EnviosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EnviosController@index');
        }
    }

    public function alta($id){
        $envios = new \App\admin\Envios;
        $flag = $envios->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$envios habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EnviosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EnviosController@index');
        }
    }

    public function getAjax($id){

      $envios = new \App\admin\Envios;

      $data = $envios->getEnviosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $envios = new \App\admin\Envios;

      $data = $envios->getEnviosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$envios', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
