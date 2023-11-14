<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Areas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class AreasController extends Controller
{
    public $v_fields=array('areas.delegacion_id', 'areas.nombre', 'areas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $areas = new \App\admin\Areas;

        $config = array();

        $config['titulo'] = "Admon. Areas";

        $config['cancelar'] = url('/admin/areas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de areas",
            'href' => url('/admin/areas'),
            'active' => false
        );

        $data = $areas->getAreasData($per_page, $request, $sortBy, $order);

        return view('admin/areas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function dashboard($id){

      $areas = new \App\admin\Areas;

      $data = $areas->getAreasView($id);

      $config = array();

      $config['titulo'] = "Resultados por Area";

      $config['cancelar'] = url('/admin/areas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de areas",
          'href' => url('/admin/areas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de areas",
          'href' => url('/admin/areas/view'),
          'active' => true
      );

      if(count($data)){

        $resultados = \App\admin\Resultados::ponenciaPacientes(0,$data->id); 
        return view('admin/delegaciones/dash', ['data'=>$data, 'config'=>$config,'resultados' => $resultados]);

      } else{

        return view('admin/areas/dash');

      }

    }

    public function getAdd(Request $request){

      $areas = new \App\admin\Areas;

      $config = array();

      $config['titulo'] = "Admon. Areas";

      $config['cancelar'] = url('/admin/areas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de areas",
          'href' => url('/admin/areas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar areas",
          'href' => url('/admin/areas/add'),
          'active' => true
      );

      $data = new $areas;

    	return view('admin/areas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $areas = new \App\admin\Areas;
        $areas->addAreas($request);
        $request->session()->flash('message', 'areas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\AreasController@index');
    }

    public function getEdit($id=''){

        $areas = new \App\admin\Areas;

        $users = $areas->getAll('areas');

        $data = $areas->getAreas($id);

        $config = array();

        $config['titulo'] = "Admon. Areas";

        $config['cancelar'] = url('/admin/areas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de areas",
            'href' => url('/admin/areas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar areas",
            'href' => url('/admin/areas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/areas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/areas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $areas = new \App\admin\Areas;
        if($areas->updateAreas($request)){
            $request->session()->flash('message', 'areas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\AreasController@index');
    }

    public function view($id){

      $areas = new \App\admin\Areas;

      $data = $areas->getAreasView($id);

      $config = array();

      $config['titulo'] = "Admon. Areas";

      $config['cancelar'] = url('/admin/areas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de areas",
          'href' => url('/admin/areas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de areas",
          'href' => url('/admin/areas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/areas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/areas/view');

      }

    }

    public function baja($id){

        $areas = new \App\admin\Areas;
        $flag = $areas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$areas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AreasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AreasController@index');
        }
    }

    public function alta($id){
        $areas = new \App\admin\Areas;
        $flag = $areas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$areas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AreasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AreasController@index');
        }
    }

    public function getAjax($id){

      $areas = new \App\admin\Areas;

      $data = $areas->getAreasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $areas = new \App\admin\Areas;

      $data = $areas->getAreasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$areas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
