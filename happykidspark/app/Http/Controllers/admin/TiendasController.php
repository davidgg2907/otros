<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tiendas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class TiendasController extends Controller
{
    public $v_fields=array('tiendas.id', 'tiendas.plataforma', 'tiendas.nombre', 'tiendas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $tiendas = new \App\admin\Tiendas;

        $config = array();

        $config['titulo'] = "tiendas";

        $config['cancelar'] = url('/admin/tiendas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de tiendas",
            'href' => url('/admin/tiendas'),
            'active' => false
        );

        $data = $tiendas->getTiendasData($per_page, $request, $sortBy, $order);

        return view('admin/tiendas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $tiendas = new \App\admin\Tiendas;

      $config = array();

      $config['titulo'] = "tiendas";

      $config['cancelar'] = url('/admin/tiendas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de tiendas",
          'href' => url('/admin/tiendas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar tiendas",
          'href' => url('/admin/tiendas/add'),
          'active' => true
      );

      $data = new $tiendas;

    	return view('admin/tiendas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $tiendas = new \App\admin\Tiendas;
        $tiendas->addTiendas($request);
        $request->session()->flash('message', 'tiendas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\TiendasController@index');
    }

    public function getEdit($id=''){

        $tiendas = new \App\admin\Tiendas;

        $users = $tiendas->getAll('tiendas');

        $data = $tiendas->getTiendas($id);

        $config = array();

        $config['titulo'] = "tiendas";

        $config['cancelar'] = url('/admin/tiendas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de tiendas",
            'href' => url('/admin/tiendas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar tiendas",
            'href' => url('/admin/tiendas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/tiendas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/tiendas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $tiendas = new \App\admin\Tiendas;
        if($tiendas->updateTiendas($request)){
            $request->session()->flash('message', 'tiendas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\TiendasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\TiendasController@index');
        }
    }

    public function view($id){

      $tiendas = new \App\admin\Tiendas;

      $data = $tiendas->getTiendasView($id);

      $config = array();

      $config['titulo'] = "tiendas";

      $config['cancelar'] = url('/admin/tiendas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de tiendas",
          'href' => url('/admin/tiendas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de tiendas",
          'href' => url('/admin/tiendas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/tiendas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/tiendas/view');

      }

    }

    public function baja($id){

        $tiendas = new \App\admin\Tiendas;
        $flag = $tiendas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$tiendas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\TiendasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\TiendasController@index');
        }
    }

    public function alta($id){
        $tiendas = new \App\admin\Tiendas;
        $flag = $tiendas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$tiendas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\TiendasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\TiendasController@index');
        }
    }

    public function getAjax($id){

      $tiendas = new \App\admin\Tiendas;

      $data = $tiendas->getTiendasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $tiendas = new \App\admin\Tiendas;

      $data = $tiendas->getTiendasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$tiendas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
