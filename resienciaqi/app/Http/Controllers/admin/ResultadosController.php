<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resultados;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ResultadosController extends Controller
{
    public $v_fields=array('resultados.tipo', 'resultados.paciente_id', 'resultados.delegacion_id', 'resultados.area_id', 'resultados.fecha', 'resultados.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $resultados = new \App\admin\Resultados;

        $config = array();

        $config['titulo'] = "Registro de Resultados";

        $config['cancelar'] = url('/admin/resultados');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resultados",
            'href' => url('/admin/resultados'),
            'active' => false
        );

        $data = $resultados->getResultadosData($per_page, $request, $sortBy, $order);

        return view('admin/resultados/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $resultados = new \App\admin\Resultados;

      $config = array();

      $config['titulo'] = "Registro de Resultados";

      $config['cancelar'] = url('/admin/resultados');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resultados",
          'href' => url('/admin/resultados'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar resultados",
          'href' => url('/admin/resultados/add'),
          'active' => true
      );

      $data = new $resultados;

    	return view('admin/resultados/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $resultados = new \App\admin\Resultados;
        $resultados->addResultados($request);
        $request->session()->flash('message', 'resultados Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ResultadosController@index');
    }

    public function getEdit($id=''){

        $resultados = new \App\admin\Resultados;

        $users = $resultados->getAll('resultados');

        $data = $resultados->getResultados($id);

        $config = array();

        $config['titulo'] = "Registro de Resultados";

        $config['cancelar'] = url('/admin/resultados');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resultados",
            'href' => url('/admin/resultados'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar resultados",
            'href' => url('/admin/resultados/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/resultados/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/resultados/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $resultados = new \App\admin\Resultados;
        if($resultados->updateResultados($request)){
            $request->session()->flash('message', 'resultados Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\ResultadosController@index');
    }

    public function view($id){

      $resultados = new \App\admin\Resultados;

      $data = $resultados->getResultadosView($id);

      $config = array();

      $config['titulo'] = "Registro de Resultados";

      $config['cancelar'] = url('/admin/resultados');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resultados",
          'href' => url('/admin/resultados'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de resultados",
          'href' => url('/admin/resultados/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/resultados/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/resultados/view');

      }

    }

    public function baja($id){

        $resultados = new \App\admin\Resultados;
        $flag = $resultados->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$resultados deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ResultadosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ResultadosController@index');
        }
    }

    public function alta($id){
        $resultados = new \App\admin\Resultados;
        $flag = $resultados->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$resultados habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ResultadosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ResultadosController@index');
        }
    }

    public function getAjax($id){

      $resultados = new \App\admin\Resultados;

      $data = $resultados->getResultadosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $resultados = new \App\admin\Resultados;

      $data = $resultados->getResultadosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$resultados', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
