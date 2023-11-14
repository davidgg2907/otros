<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resultados_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Resultados_detalleController extends Controller
{
    public $v_fields=array('resultados_detalle.tipo', 'resultados_detalle.resultado_id', 'resultados_detalle.pregunta_id', 'resultados_detalle.respuesta_id', 'resultados_detalle.valor', 'resultados_detalle.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $resultados_detalle = new \App\admin\Resultados_detalle;

        $config = array();

        $config['titulo'] = "resultados_detalle";

        $config['cancelar'] = url('/admin/resultados_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resultados_detalle",
            'href' => url('/admin/resultados_detalle'),
            'active' => false
        );

        $data = $resultados_detalle->getResultados_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/resultados_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $resultados_detalle = new \App\admin\Resultados_detalle;

      $config = array();

      $config['titulo'] = "resultados_detalle";

      $config['cancelar'] = url('/admin/resultados_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resultados_detalle",
          'href' => url('/admin/resultados_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar resultados_detalle",
          'href' => url('/admin/resultados_detalle/add'),
          'active' => true
      );

      $data = new $resultados_detalle;

    	return view('admin/resultados_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $resultados_detalle = new \App\admin\Resultados_detalle;
        $resultados_detalle->addResultados_detalle($request);
        $request->session()->flash('message', 'resultados_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Resultados_detalleController@index');
    }

    public function getEdit($id=''){

        $resultados_detalle = new \App\admin\Resultados_detalle;

        $users = $resultados_detalle->getAll('resultados_detalle');

        $data = $resultados_detalle->getResultados_detalle($id);

        $config = array();

        $config['titulo'] = "resultados_detalle";

        $config['cancelar'] = url('/admin/resultados_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resultados_detalle",
            'href' => url('/admin/resultados_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar resultados_detalle",
            'href' => url('/admin/resultados_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/resultados_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/resultados_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $resultados_detalle = new \App\admin\Resultados_detalle;
        if($resultados_detalle->updateResultados_detalle($request)){
            $request->session()->flash('message', 'resultados_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\Resultados_detalleController@index');
    }

    public function view($id){

      $resultados_detalle = new \App\admin\Resultados_detalle;

      $data = $resultados_detalle->getResultados_detalleView($id);

      $config = array();

      $config['titulo'] = "resultados_detalle";

      $config['cancelar'] = url('/admin/resultados_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resultados_detalle",
          'href' => url('/admin/resultados_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de resultados_detalle",
          'href' => url('/admin/resultados_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/resultados_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/resultados_detalle/view');

      }

    }

    public function baja($id){

        $resultados_detalle = new \App\admin\Resultados_detalle;
        $flag = $resultados_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$resultados_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Resultados_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Resultados_detalleController@index');
        }
    }

    public function alta($id){
        $resultados_detalle = new \App\admin\Resultados_detalle;
        $flag = $resultados_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$resultados_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Resultados_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Resultados_detalleController@index');
        }
    }

    public function getAjax($id){

      $resultados_detalle = new \App\admin\Resultados_detalle;

      $data = $resultados_detalle->getResultados_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $resultados_detalle = new \App\admin\Resultados_detalle;

      $data = $resultados_detalle->getResultados_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$resultados_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
