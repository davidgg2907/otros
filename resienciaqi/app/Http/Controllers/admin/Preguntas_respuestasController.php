<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Preguntas_respuestas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Preguntas_respuestasController extends Controller
{
    public $v_fields=array('preguntas_respuestas.pregunta_id', 'preguntas_respuestas.tipo', 'preguntas_respuestas.valor', 'preguntas_respuestas.label', 'preguntas_respuestas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $preguntas_respuestas = new \App\admin\Preguntas_respuestas;

        $config = array();

        $config['titulo'] = "preguntas_respuestas";

        $config['cancelar'] = url('/admin/preguntas_respuestas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de preguntas_respuestas",
            'href' => url('/admin/preguntas_respuestas'),
            'active' => false
        );

        $data = $preguntas_respuestas->getPreguntas_respuestasData($per_page, $request, $sortBy, $order);

        return view('admin/preguntas_respuestas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $preguntas_respuestas = new \App\admin\Preguntas_respuestas;

      $config = array();

      $config['titulo'] = "preguntas_respuestas";

      $config['cancelar'] = url('/admin/preguntas_respuestas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de preguntas_respuestas",
          'href' => url('/admin/preguntas_respuestas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar preguntas_respuestas",
          'href' => url('/admin/preguntas_respuestas/add'),
          'active' => true
      );

      $data = new $preguntas_respuestas;

    	return view('admin/preguntas_respuestas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $preguntas_respuestas = new \App\admin\Preguntas_respuestas;
        $preguntas_respuestas->addPreguntas_respuestas($request);
        $request->session()->flash('message', 'preguntas_respuestas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Preguntas_respuestasController@index');
    }

    public function getEdit($id=''){

        $preguntas_respuestas = new \App\admin\Preguntas_respuestas;

        $users = $preguntas_respuestas->getAll('preguntas_respuestas');

        $data = $preguntas_respuestas->getPreguntas_respuestas($id);

        $config = array();

        $config['titulo'] = "preguntas_respuestas";

        $config['cancelar'] = url('/admin/preguntas_respuestas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de preguntas_respuestas",
            'href' => url('/admin/preguntas_respuestas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar preguntas_respuestas",
            'href' => url('/admin/preguntas_respuestas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/preguntas_respuestas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/preguntas_respuestas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $preguntas_respuestas = new \App\admin\Preguntas_respuestas;
        if($preguntas_respuestas->updatePreguntas_respuestas($request)){
            $request->session()->flash('message', 'preguntas_respuestas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\Preguntas_respuestasController@index');
    }

    public function view($id){

      $preguntas_respuestas = new \App\admin\Preguntas_respuestas;

      $data = $preguntas_respuestas->getPreguntas_respuestasView($id);

      $config = array();

      $config['titulo'] = "preguntas_respuestas";

      $config['cancelar'] = url('/admin/preguntas_respuestas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de preguntas_respuestas",
          'href' => url('/admin/preguntas_respuestas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de preguntas_respuestas",
          'href' => url('/admin/preguntas_respuestas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/preguntas_respuestas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/preguntas_respuestas/view');

      }

    }

    public function baja($id){

        $preguntas_respuestas = new \App\admin\Preguntas_respuestas;
        $flag = $preguntas_respuestas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$preguntas_respuestas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Preguntas_respuestasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Preguntas_respuestasController@index');
        }
    }

    public function alta($id){
        $preguntas_respuestas = new \App\admin\Preguntas_respuestas;
        $flag = $preguntas_respuestas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$preguntas_respuestas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Preguntas_respuestasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Preguntas_respuestasController@index');
        }
    }

    public function getAjax($id){

      $preguntas_respuestas = new \App\admin\Preguntas_respuestas;

      $data = $preguntas_respuestas->getPreguntas_respuestasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $preguntas_respuestas = new \App\admin\Preguntas_respuestas;

      $data = $preguntas_respuestas->getPreguntas_respuestasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$preguntas_respuestas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
