<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Preguntas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class PreguntasController extends Controller
{
    public $v_fields=array('preguntas.grupo_id', 'preguntas.pregunta', 'preguntas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $preguntas = new \App\admin\Preguntas;

        $config = array();

        $config['titulo'] = "Admon. Preguntas";

        $config['cancelar'] = url('/admin/preguntas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de preguntas",
            'href' => url('/admin/preguntas'),
            'active' => false
        );

        $data = $preguntas->getPreguntasData($per_page, $request, $sortBy, $order);

        return view('admin/preguntas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $preguntas = new \App\admin\Preguntas;

      $config = array();

      $config['titulo'] = "Admon. Preguntas";

      $config['cancelar'] = url('/admin/preguntas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de preguntas",
          'href' => url('/admin/preguntas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar preguntas",
          'href' => url('/admin/preguntas/add'),
          'active' => true
      );

      $data = new $preguntas;

    	return view('admin/preguntas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $preguntas = new \App\admin\Preguntas;
        $preguntas->addPreguntas($request);
        $request->session()->flash('message', 'preguntas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\PreguntasController@index');
    }

    public function getEdit($id=''){

        $preguntas = new \App\admin\Preguntas;

        $users = $preguntas->getAll('preguntas');

        $data = $preguntas->getPreguntas($id);

        $config = array();

        $config['titulo'] = "Admon. Preguntas";

        $config['cancelar'] = url('/admin/preguntas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de preguntas",
            'href' => url('/admin/preguntas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar preguntas",
            'href' => url('/admin/preguntas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/preguntas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/preguntas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $preguntas = new \App\admin\Preguntas;
        if($preguntas->updatePreguntas($request)){
            $request->session()->flash('message', 'preguntas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\PreguntasController@index');
    }

    public function view($id){

      $preguntas = new \App\admin\Preguntas;

      $data = $preguntas->getPreguntasView($id);

      $config = array();

      $config['titulo'] = "Admon. Preguntas";

      $config['cancelar'] = url('/admin/preguntas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de preguntas",
          'href' => url('/admin/preguntas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de preguntas",
          'href' => url('/admin/preguntas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/preguntas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/preguntas/view');

      }

    }

    public function baja($id){

        $preguntas = new \App\admin\Preguntas;
        $flag = $preguntas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$preguntas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PreguntasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PreguntasController@index');
        }
    }

    public function alta($id){
        $preguntas = new \App\admin\Preguntas;
        $flag = $preguntas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$preguntas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PreguntasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PreguntasController@index');
        }
    }

    public function getAjax($id){

      $preguntas = new \App\admin\Preguntas;

      $data = $preguntas->getPreguntasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $preguntas = new \App\admin\Preguntas;

      $data = $preguntas->getPreguntasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$preguntas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
