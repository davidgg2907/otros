<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Riesgos_grupos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Riesgos_gruposController extends Controller
{
    public $v_fields=array('riesgos_grupos.id', 'riesgos_grupos.nombre', 'riesgos_grupos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $riesgos_grupos = new \App\admin\Riesgos_grupos;

        $config = array();

        $config['titulo'] = "riesgos_grupos";

        $config['cancelar'] = url('/admin/riesgos_grupos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de riesgos_grupos",
            'href' => url('/admin/riesgos_grupos'),
            'active' => false
        );

        $data = $riesgos_grupos->getRiesgos_gruposData($per_page, $request, $sortBy, $order);

        return view('admin/riesgos_grupos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $riesgos_grupos = new \App\admin\Riesgos_grupos;

      $config = array();

      $config['titulo'] = "riesgos_grupos";

      $config['cancelar'] = url('/admin/riesgos_grupos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de riesgos_grupos",
          'href' => url('/admin/riesgos_grupos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar riesgos_grupos",
          'href' => url('/admin/riesgos_grupos/add'),
          'active' => true
      );

      $data = new $riesgos_grupos;

    	return view('admin/riesgos_grupos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $riesgos_grupos = new \App\admin\Riesgos_grupos;
        $riesgos_grupos->addRiesgos_grupos($request);
        $request->session()->flash('message', 'riesgos_grupos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Riesgos_gruposController@index');
    }

    public function getEdit($id=''){

        $riesgos_grupos = new \App\admin\Riesgos_grupos;

        $users = $riesgos_grupos->getAll('riesgos_grupos');

        $data = $riesgos_grupos->getRiesgos_grupos($id);

        $config = array();

        $config['titulo'] = "riesgos_grupos";

        $config['cancelar'] = url('/admin/riesgos_grupos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de riesgos_grupos",
            'href' => url('/admin/riesgos_grupos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar riesgos_grupos",
            'href' => url('/admin/riesgos_grupos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/riesgos_grupos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/riesgos_grupos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $riesgos_grupos = new \App\admin\Riesgos_grupos;
        if($riesgos_grupos->updateRiesgos_grupos($request)){
            $request->session()->flash('message', 'riesgos_grupos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\Riesgos_gruposController@index');
    }

    public function view($id){

      $riesgos_grupos = new \App\admin\Riesgos_grupos;

      $data = $riesgos_grupos->getRiesgos_gruposView($id);

      $config = array();

      $config['titulo'] = "riesgos_grupos";

      $config['cancelar'] = url('/admin/riesgos_grupos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de riesgos_grupos",
          'href' => url('/admin/riesgos_grupos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de riesgos_grupos",
          'href' => url('/admin/riesgos_grupos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/riesgos_grupos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/riesgos_grupos/view');

      }

    }

    public function baja($id){

        $riesgos_grupos = new \App\admin\Riesgos_grupos;
        $flag = $riesgos_grupos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$riesgos_grupos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Riesgos_gruposController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Riesgos_gruposController@index');
        }
    }

    public function alta($id){
        $riesgos_grupos = new \App\admin\Riesgos_grupos;
        $flag = $riesgos_grupos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$riesgos_grupos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Riesgos_gruposController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Riesgos_gruposController@index');
        }
    }

    public function getAjax($id){

      $riesgos_grupos = new \App\admin\Riesgos_grupos;

      $data = $riesgos_grupos->getRiesgos_gruposView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $riesgos_grupos = new \App\admin\Riesgos_grupos;

      $data = $riesgos_grupos->getRiesgos_gruposExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$riesgos_grupos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
