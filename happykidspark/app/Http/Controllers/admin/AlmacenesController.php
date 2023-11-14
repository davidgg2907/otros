<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Almacenes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class AlmacenesController extends Controller
{
    public $v_fields=array('almacenes.tienda_id', 'almacenes.nombre', 'almacenes.fisico_digital', 'almacenes.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $almacenes = new \App\admin\Almacenes;

        $config = array();

        $config['titulo'] = "almacenes";

        $config['cancelar'] = url('/admin/almacenes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de almacenes",
            'href' => url('/admin/almacenes'),
            'active' => false
        );

        $data = $almacenes->getAlmacenesData($per_page, $request, $sortBy, $order);

        return view('admin/almacenes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $almacenes = new \App\admin\Almacenes;

      $config = array();

      $config['titulo'] = "almacenes";

      $config['cancelar'] = url('/admin/almacenes');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de almacenes",
          'href' => url('/admin/almacenes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar almacenes",
          'href' => url('/admin/almacenes/add'),
          'active' => true
      );

      $data = new $almacenes;

    	return view('admin/almacenes/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $almacenes = new \App\admin\Almacenes;
        $almacenes->addAlmacenes($request);
        $request->session()->flash('message', 'almacenes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\AlmacenesController@index');
    }

    public function getEdit($id=''){

        $almacenes = new \App\admin\Almacenes;

        $users = $almacenes->getAll('almacenes');

        $data = $almacenes->getAlmacenes($id);

        $config = array();

        $config['titulo'] = "almacenes";

        $config['cancelar'] = url('/admin/almacenes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de almacenes",
            'href' => url('/admin/almacenes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar almacenes",
            'href' => url('/admin/almacenes/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/almacenes/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/almacenes/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $almacenes = new \App\admin\Almacenes;
        if($almacenes->updateAlmacenes($request)){
            $request->session()->flash('message', 'almacenes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\AlmacenesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\AlmacenesController@index');
        }
    }

    public function view($id){

      $almacenes = new \App\admin\Almacenes;

      $data = $almacenes->getAlmacenesView($id);

      $config = array();

      $config['titulo'] = "almacenes";

      $config['cancelar'] = url('/admin/almacenes');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de almacenes",
          'href' => url('/admin/almacenes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de almacenes",
          'href' => url('/admin/almacenes/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/almacenes/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/almacenes/view');

      }

    }

    public function baja($id){

        $almacenes = new \App\admin\Almacenes;
        $flag = $almacenes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$almacenes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AlmacenesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AlmacenesController@index');
        }
    }

    public function alta($id){
        $almacenes = new \App\admin\Almacenes;
        $flag = $almacenes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$almacenes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AlmacenesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AlmacenesController@index');
        }
    }

    public function getAjax($id){

      $almacenes = new \App\admin\Almacenes;

      $data = $almacenes->getAlmacenesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $almacenes = new \App\admin\Almacenes;

      $data = $almacenes->getAlmacenesExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$almacenes', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
