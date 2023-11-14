<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traspasos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class TraspasosController extends Controller
{
    public $v_fields=array('traspasos.usr_envia_id', 'traspasos.usr_autoriza_id', 'traspasos.almacen_origen_id', 'traspasos.almacen_destino_id', 'traspasos.fecha_envio', 'traspasos.fecha_autorizacion', 'traspasos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $traspasos = new \App\admin\Traspasos;

        $config = array();

        $config['titulo'] = "traspasos";

        $config['cancelar'] = url('/admin/traspasos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de traspasos",
            'href' => url('/admin/traspasos'),
            'active' => false
        );

        $data = $traspasos->getTraspasosData($per_page, $request, $sortBy, $order);

        return view('admin/traspasos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $traspasos = new \App\admin\Traspasos;

      $config = array();

      $config['titulo'] = "traspasos";

      $config['cancelar'] = url('/admin/traspasos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de traspasos",
          'href' => url('/admin/traspasos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar traspasos",
          'href' => url('/admin/traspasos/add'),
          'active' => true
      );

      $data = new $traspasos;

    	return view('admin/traspasos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){


      foreach($request->input('traspaso') as $key => $values) {

        //Sacamos del almacen origen
        $retiro   = array(
          'almacen_id'    => $request->input('almacen_origen_id'),
          'producto_id'   => $key,
          'operacion'     => 'R',
          'cantidad'      => $values['cantidad']
        );

        \App\admin\Inventario::inventariar($retiro);

        //Ingresamos del almacen destino
        $destino  = array(
          'almacen_id'    => $request->input('almacen_destino_id'),
          'producto_id'   => $key,
          'operacion'     => 'S',
          'cantidad'      => $values['cantidad']
        );

        \App\admin\Inventario::inventariar($destino);

      }

      $request->session()->flash('message', 'Transferencia de mercancia generada exitosamente');
      $request->session()->flash('exito', 'true');
      return redirect('admin/inventario');
    }

    public function getEdit($id=''){

        $traspasos = new \App\admin\Traspasos;

        $users = $traspasos->getAll('traspasos');

        $data = $traspasos->getTraspasos($id);

        $config = array();

        $config['titulo'] = "traspasos";

        $config['cancelar'] = url('/admin/traspasos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de traspasos",
            'href' => url('/admin/traspasos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar traspasos",
            'href' => url('/admin/traspasos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/traspasos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/traspasos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $traspasos = new \App\admin\Traspasos;
        if($traspasos->updateTraspasos($request)){
            $request->session()->flash('message', 'traspasos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\TraspasosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\TraspasosController@index');
        }
    }

    public function view($id){

      $traspasos = new \App\admin\Traspasos;

      $data = $traspasos->getTraspasosView($id);

      $config = array();

      $config['titulo'] = "traspasos";

      $config['cancelar'] = url('/admin/traspasos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de traspasos",
          'href' => url('/admin/traspasos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de traspasos",
          'href' => url('/admin/traspasos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/traspasos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/traspasos/view');

      }

    }

    public function baja($id){

        $traspasos = new \App\admin\Traspasos;
        $flag = $traspasos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$traspasos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\TraspasosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\TraspasosController@index');
        }
    }

    public function alta($id){
        $traspasos = new \App\admin\Traspasos;
        $flag = $traspasos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$traspasos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\TraspasosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\TraspasosController@index');
        }
    }

    public function getAjax($id){

      $traspasos = new \App\admin\Traspasos;

      $data = $traspasos->getTraspasosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $traspasos = new \App\admin\Traspasos;

      $data = $traspasos->getTraspasosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$traspasos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
