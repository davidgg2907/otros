<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traspasos_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Traspasos_detalleController extends Controller
{
    public $v_fields=array('traspasos_detalle.traspaso_id', 'traspasos_detalle.producto_id', 'traspasos_detalle.cantidad', 'traspasos_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $traspasos_detalle = new \App\admin\Traspasos_detalle;

        $config = array();

        $config['titulo'] = "traspasos_detalle";

        $config['cancelar'] = url('/admin/traspasos_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de traspasos_detalle",
            'href' => url('/admin/traspasos_detalle'),
            'active' => false
        );

        $data = $traspasos_detalle->getTraspasos_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/traspasos_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $traspasos_detalle = new \App\admin\Traspasos_detalle;

      $config = array();

      $config['titulo'] = "traspasos_detalle";

      $config['cancelar'] = url('/admin/traspasos_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de traspasos_detalle",
          'href' => url('/admin/traspasos_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar traspasos_detalle",
          'href' => url('/admin/traspasos_detalle/add'),
          'active' => true
      );

      $data = new $traspasos_detalle;

    	return view('admin/traspasos_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $traspasos_detalle = new \App\admin\Traspasos_detalle;
        $traspasos_detalle->addTraspasos_detalle($request);
        $request->session()->flash('message', 'traspasos_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Traspasos_detalleController@index');
    }

    public function getEdit($id=''){

        $traspasos_detalle = new \App\admin\Traspasos_detalle;

        $users = $traspasos_detalle->getAll('traspasos_detalle');

        $data = $traspasos_detalle->getTraspasos_detalle($id);

        $config = array();

        $config['titulo'] = "traspasos_detalle";

        $config['cancelar'] = url('/admin/traspasos_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de traspasos_detalle",
            'href' => url('/admin/traspasos_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar traspasos_detalle",
            'href' => url('/admin/traspasos_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/traspasos_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/traspasos_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $traspasos_detalle = new \App\admin\Traspasos_detalle;
        if($traspasos_detalle->updateTraspasos_detalle($request)){
            $request->session()->flash('message', 'traspasos_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Traspasos_detalleController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Traspasos_detalleController@index');
        }
    }

    public function view($id){

      $traspasos_detalle = new \App\admin\Traspasos_detalle;

      $data = $traspasos_detalle->getTraspasos_detalleView($id);

      $config = array();

      $config['titulo'] = "traspasos_detalle";

      $config['cancelar'] = url('/admin/traspasos_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de traspasos_detalle",
          'href' => url('/admin/traspasos_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de traspasos_detalle",
          'href' => url('/admin/traspasos_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/traspasos_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/traspasos_detalle/view');

      }

    }

    public function baja($id){

        $traspasos_detalle = new \App\admin\Traspasos_detalle;
        $flag = $traspasos_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$traspasos_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Traspasos_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Traspasos_detalleController@index');
        }
    }

    public function alta($id){
        $traspasos_detalle = new \App\admin\Traspasos_detalle;
        $flag = $traspasos_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$traspasos_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Traspasos_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Traspasos_detalleController@index');
        }
    }

    public function getAjax($id){

      $traspasos_detalle = new \App\admin\Traspasos_detalle;

      $data = $traspasos_detalle->getTraspasos_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $traspasos_detalle = new \App\admin\Traspasos_detalle;

      $data = $traspasos_detalle->getTraspasos_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$traspasos_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
