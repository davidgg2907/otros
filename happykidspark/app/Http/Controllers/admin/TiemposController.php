<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tiempos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class TiemposController extends Controller
{
    public $v_fields=array('tiempos.minutos', 'tiempos.costo', 'tiempos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $tiempos = new \App\admin\Tiempos;

        $config = array();

        $config['titulo'] = "tiempos";

        $config['cancelar'] = url('/admin/tiempos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de tiempos",
            'href' => url('/admin/tiempos'),
            'active' => false
        );

        $data = $tiempos->getTiemposData($per_page, $request, $sortBy, $order);

        return view('admin/tiempos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $tiempos = new \App\admin\Tiempos;

      $config = array();

      $config['titulo'] = "tiempos";

      $config['cancelar'] = url('/admin/tiempos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de tiempos",
          'href' => url('/admin/tiempos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar tiempos",
          'href' => url('/admin/tiempos/add'),
          'active' => true
      );

      $data = new $tiempos;

    	return view('admin/tiempos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $tiempos = new \App\admin\Tiempos;
        $tiempos->addTiempos($request);
        $request->session()->flash('message', 'tiempos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\TiemposController@index');
    }

    public function getEdit($id=''){

        $tiempos = new \App\admin\Tiempos;

        $users = $tiempos->getAll('tiempos');

        $data = $tiempos->getTiempos($id);

        $config = array();

        $config['titulo'] = "tiempos";

        $config['cancelar'] = url('/admin/tiempos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de tiempos",
            'href' => url('/admin/tiempos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar tiempos",
            'href' => url('/admin/tiempos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/tiempos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/tiempos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $tiempos = new \App\admin\Tiempos;
        if($tiempos->updateTiempos($request)){
            $request->session()->flash('message', 'tiempos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\TiemposController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\TiemposController@index');
        }
    }

    public function view($id){

      $tiempos = new \App\admin\Tiempos;

      $data = $tiempos->getTiemposView($id);

      $config = array();

      $config['titulo'] = "tiempos";

      $config['cancelar'] = url('/admin/tiempos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de tiempos",
          'href' => url('/admin/tiempos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de tiempos",
          'href' => url('/admin/tiempos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/tiempos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/tiempos/view');

      }

    }

    public function baja($id){

        $tiempos = new \App\admin\Tiempos;
        $flag = $tiempos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$tiempos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\TiemposController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\TiemposController@index');
        }
    }

    public function alta($id){
        $tiempos = new \App\admin\Tiempos;
        $flag = $tiempos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$tiempos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\TiemposController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\TiemposController@index');
        }
    }

    public function getAjax($id){

      $tiempos = new \App\admin\Tiempos;

      $data = $tiempos->getTiemposView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $tiempos = new \App\admin\Tiempos;

      $data = $tiempos->getTiemposExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$tiempos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
