<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resiliencia_preguntas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Resiliencia_preguntasController extends Controller
{
    public $v_fields=array('resiliencia_preguntas.pregunta', 'resiliencia_preguntas.tipo', 'resiliencia_preguntas.grupo', 'resiliencia_preguntas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;

        $config = array();

        $config['titulo'] = "resiliencia_preguntas";

        $config['cancelar'] = url('/admin/resiliencia_preguntas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resiliencia_preguntas",
            'href' => url('/admin/resiliencia_preguntas'),
            'active' => false
        );

        $data = $resiliencia_preguntas->getResiliencia_preguntasData($per_page, $request, $sortBy, $order);

        return view('admin/resiliencia_preguntas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;

      $config = array();

      $config['titulo'] = "resiliencia_preguntas";

      $config['cancelar'] = url('/admin/resiliencia_preguntas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resiliencia_preguntas",
          'href' => url('/admin/resiliencia_preguntas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar resiliencia_preguntas",
          'href' => url('/admin/resiliencia_preguntas/add'),
          'active' => true
      );

      $data = new $resiliencia_preguntas;

    	return view('admin/resiliencia_preguntas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;
        $resiliencia_preguntas->addResiliencia_preguntas($request);
        $request->session()->flash('message', 'resiliencia_preguntas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Resiliencia_preguntasController@index');
    }

    public function getEdit($id=''){

        $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;

        $users = $resiliencia_preguntas->getAll('resiliencia_preguntas');

        $data = $resiliencia_preguntas->getResiliencia_preguntas($id);

        $config = array();

        $config['titulo'] = "resiliencia_preguntas";

        $config['cancelar'] = url('/admin/resiliencia_preguntas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resiliencia_preguntas",
            'href' => url('/admin/resiliencia_preguntas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar resiliencia_preguntas",
            'href' => url('/admin/resiliencia_preguntas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/resiliencia_preguntas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/resiliencia_preguntas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;
        if($resiliencia_preguntas->updateResiliencia_preguntas($request)){
            $request->session()->flash('message', 'resiliencia_preguntas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\Resiliencia_preguntasController@index');
    }

    public function view($id){

      $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;

      $data = $resiliencia_preguntas->getResiliencia_preguntasView($id);

      $config = array();

      $config['titulo'] = "resiliencia_preguntas";

      $config['cancelar'] = url('/admin/resiliencia_preguntas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resiliencia_preguntas",
          'href' => url('/admin/resiliencia_preguntas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de resiliencia_preguntas",
          'href' => url('/admin/resiliencia_preguntas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/resiliencia_preguntas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/resiliencia_preguntas/view');

      }

    }

    public function baja($id){

        $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;
        $flag = $resiliencia_preguntas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$resiliencia_preguntas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Resiliencia_preguntasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Resiliencia_preguntasController@index');
        }
    }

    public function alta($id){
        $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;
        $flag = $resiliencia_preguntas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$resiliencia_preguntas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Resiliencia_preguntasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Resiliencia_preguntasController@index');
        }
    }

    public function getAjax($id){

      $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;

      $data = $resiliencia_preguntas->getResiliencia_preguntasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $resiliencia_preguntas = new \App\admin\Resiliencia_preguntas;

      $data = $resiliencia_preguntas->getResiliencia_preguntasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$resiliencia_preguntas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
