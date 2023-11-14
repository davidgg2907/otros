<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grupos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class GruposController extends Controller
{
    public $v_fields=array('grupos.id', 'grupos.nombre', 'grupos.descripcion', 'grupos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $grupos = new \App\admin\Grupos;

        $config = array();

        $config['titulo'] = "Admon. Grupos";

        $config['cancelar'] = url('/admin/grupos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de grupos",
            'href' => url('/admin/grupos'),
            'active' => false
        );

        $data = $grupos->getGruposData($per_page, $request, $sortBy, $order);

        return view('admin/grupos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $grupos = new \App\admin\Grupos;

      $config = array();

      $config['titulo'] = "Admon. Grupos";

      $config['cancelar'] = url('/admin/grupos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de grupos",
          'href' => url('/admin/grupos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar grupos",
          'href' => url('/admin/grupos/add'),
          'active' => true
      );

      $data = new $grupos;

    	return view('admin/grupos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $grupos = new \App\admin\Grupos;
        $grupos->addGrupos($request);
        $request->session()->flash('message', 'grupos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\GruposController@index');
    }

    public function getEdit($id=''){

        $grupos = new \App\admin\Grupos;

        $users = $grupos->getAll('grupos');

        $data = $grupos->getGrupos($id);

        $config = array();

        $config['titulo'] = "Admon. Grupos";

        $config['cancelar'] = url('/admin/grupos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de grupos",
            'href' => url('/admin/grupos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar grupos",
            'href' => url('/admin/grupos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/grupos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/grupos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $grupos = new \App\admin\Grupos;
        if($grupos->updateGrupos($request)){
            $request->session()->flash('message', 'grupos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\GruposController@index');
    }

    public function view($id){

      $grupos = new \App\admin\Grupos;

      $data = $grupos->getGruposView($id);

      $config = array();

      $config['titulo'] = "Admon. Grupos";

      $config['cancelar'] = url('/admin/grupos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de grupos",
          'href' => url('/admin/grupos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de grupos",
          'href' => url('/admin/grupos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/grupos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/grupos/view');

      }

    }

    public function baja($id){

        $grupos = new \App\admin\Grupos;
        $flag = $grupos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$grupos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\GruposController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\GruposController@index');
        }
    }

    public function alta($id){
        $grupos = new \App\admin\Grupos;
        $flag = $grupos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$grupos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\GruposController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\GruposController@index');
        }
    }

    public function getAjax($id){

      $grupos = new \App\admin\Grupos;

      $data = $grupos->getGruposView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $grupos = new \App\admin\Grupos;

      $data = $grupos->getGruposExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$grupos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
