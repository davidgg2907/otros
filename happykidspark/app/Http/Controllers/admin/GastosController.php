<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gastos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class GastosController extends Controller
{
    public $v_fields=array('gastos.registro', 'gastos.fgasto', 'gastos.concepto', 'gastos.importe', 'gastos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $gastos = new \App\admin\Gastos;

        $config = array();

        $config['titulo'] = "gastos";

        $config['cancelar'] = url('/admin/gastos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de gastos",
            'href' => url('/admin/gastos'),
            'active' => false
        );

        $data = $gastos->getGastosData($per_page, $request, $sortBy, $order);

        return view('admin/gastos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $gastos = new \App\admin\Gastos;

      $config = array();

      $config['titulo'] = "gastos";

      $config['cancelar'] = url('/admin/gastos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de gastos",
          'href' => url('/admin/gastos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar gastos",
          'href' => url('/admin/gastos/add'),
          'active' => true
      );

      $data = new $gastos;

    	return view('admin/gastos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $gastos = new \App\admin\Gastos;
        $gastos->addGastos($request);
        $request->session()->flash('message', 'gastos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\GastosController@index');
    }

    public function getEdit($id=''){

        $gastos = new \App\admin\Gastos;

        $users = $gastos->getAll('gastos');

        $data = $gastos->getGastos($id);

        $config = array();

        $config['titulo'] = "gastos";

        $config['cancelar'] = url('/admin/gastos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de gastos",
            'href' => url('/admin/gastos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar gastos",
            'href' => url('/admin/gastos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/gastos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/gastos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $gastos = new \App\admin\Gastos;
        if($gastos->updateGastos($request)){
            $request->session()->flash('message', 'gastos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\GastosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\GastosController@index');
        }
    }

    public function view($id){

      $gastos = new \App\admin\Gastos;

      $data = $gastos->getGastosView($id);

      $config = array();

      $config['titulo'] = "gastos";

      $config['cancelar'] = url('/admin/gastos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de gastos",
          'href' => url('/admin/gastos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de gastos",
          'href' => url('/admin/gastos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/gastos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/gastos/view');

      }

    }

    public function baja($id){

        $gastos = new \App\admin\Gastos;
        $flag = $gastos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$gastos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\GastosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\GastosController@index');
        }
    }

    public function alta($id){
        $gastos = new \App\admin\Gastos;
        $flag = $gastos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$gastos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\GastosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\GastosController@index');
        }
    }

    public function getAjax($id){

      $gastos = new \App\admin\Gastos;

      $data = $gastos->getGastosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $gastos = new \App\admin\Gastos;

      $data = $gastos->getGastosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$gastos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
