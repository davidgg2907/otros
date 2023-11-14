<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Riesgos_parameros;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Riesgos_paramerosController extends Controller
{
    public $v_fields=array('riesgos_parameros.id', 'riesgos_parameros.grupo_id', 'riesgos_parameros.nombre', 'riesgos_parameros.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $riesgos_parameros = new \App\admin\Riesgos_parameros;

        $config = array();

        $config['titulo'] = "riesgos_parameros";

        $config['cancelar'] = url('/admin/riesgos_parameros');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de riesgos_parameros",
            'href' => url('/admin/riesgos_parameros'),
            'active' => false
        );

        $data = $riesgos_parameros->getRiesgos_paramerosData($per_page, $request, $sortBy, $order);

        return view('admin/riesgos_parameros/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $riesgos_parameros = new \App\admin\Riesgos_parameros;

      $config = array();

      $config['titulo'] = "riesgos_parameros";

      $config['cancelar'] = url('/admin/riesgos_parameros');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de riesgos_parameros",
          'href' => url('/admin/riesgos_parameros'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar riesgos_parameros",
          'href' => url('/admin/riesgos_parameros/add'),
          'active' => true
      );

      $data = new $riesgos_parameros;

    	return view('admin/riesgos_parameros/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $riesgos_parameros = new \App\admin\Riesgos_parameros;
        $riesgos_parameros->addRiesgos_parameros($request);
        $request->session()->flash('message', 'riesgos_parameros Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Riesgos_paramerosController@index');
    }

    public function getEdit($id=''){

        $riesgos_parameros = new \App\admin\Riesgos_parameros;

        $users = $riesgos_parameros->getAll('riesgos_parameros');

        $data = $riesgos_parameros->getRiesgos_parameros($id);

        $config = array();

        $config['titulo'] = "riesgos_parameros";

        $config['cancelar'] = url('/admin/riesgos_parameros');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de riesgos_parameros",
            'href' => url('/admin/riesgos_parameros'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar riesgos_parameros",
            'href' => url('/admin/riesgos_parameros/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/riesgos_parameros/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/riesgos_parameros/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $riesgos_parameros = new \App\admin\Riesgos_parameros;
        if($riesgos_parameros->updateRiesgos_parameros($request)){
            $request->session()->flash('message', 'riesgos_parameros Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\Riesgos_paramerosController@index');
    }

    public function view($id){

      $riesgos_parameros = new \App\admin\Riesgos_parameros;

      $data = $riesgos_parameros->getRiesgos_paramerosView($id);

      $config = array();

      $config['titulo'] = "riesgos_parameros";

      $config['cancelar'] = url('/admin/riesgos_parameros');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de riesgos_parameros",
          'href' => url('/admin/riesgos_parameros'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de riesgos_parameros",
          'href' => url('/admin/riesgos_parameros/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/riesgos_parameros/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/riesgos_parameros/view');

      }

    }

    public function baja($id){

        $riesgos_parameros = new \App\admin\Riesgos_parameros;
        $flag = $riesgos_parameros->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$riesgos_parameros deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Riesgos_paramerosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Riesgos_paramerosController@index');
        }
    }

    public function alta($id){
        $riesgos_parameros = new \App\admin\Riesgos_parameros;
        $flag = $riesgos_parameros->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$riesgos_parameros habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Riesgos_paramerosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Riesgos_paramerosController@index');
        }
    }

    public function getAjax($id){

      $riesgos_parameros = new \App\admin\Riesgos_parameros;

      $data = $riesgos_parameros->getRiesgos_paramerosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $riesgos_parameros = new \App\admin\Riesgos_parameros;

      $data = $riesgos_parameros->getRiesgos_paramerosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$riesgos_parameros', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
