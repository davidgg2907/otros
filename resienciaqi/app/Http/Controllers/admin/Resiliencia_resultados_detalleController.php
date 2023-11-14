<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resiliencia_resultados_detalle;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Resiliencia_resultados_detalleController extends Controller
{
    public $v_fields=array('resiliencia_resultados_detalle.nombre', 'resiliencia_resultados_detalle.fechadenacimiento', 'resiliencia_resultados_detalle.edad', 'resiliencia_resultados_detalle.fechaaplicacion', 'resiliencia_resultados_detalle.area', 'resiliencia_resultados_detalle.organizacion');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;

        $config = array();

        $config['titulo'] = "resiliencia_resultados_detalle";

        $config['cancelar'] = url('/admin/resiliencia_resultados_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resiliencia_resultados_detalle",
            'href' => url('/admin/resiliencia_resultados_detalle'),
            'active' => false
        );

        $data = $resiliencia_resultados_detalle->getResiliencia_resultados_detalleData($per_page, $request, $sortBy, $order);

        return view('admin/resiliencia_resultados_detalle/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;

      $config = array();

      $config['titulo'] = "resiliencia_resultados_detalle";

      $config['cancelar'] = url('/admin/resiliencia_resultados_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resiliencia_resultados_detalle",
          'href' => url('/admin/resiliencia_resultados_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar resiliencia_resultados_detalle",
          'href' => url('/admin/resiliencia_resultados_detalle/add'),
          'active' => true
      );

      $data = new $resiliencia_resultados_detalle;

    	return view('admin/resiliencia_resultados_detalle/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;
        $resiliencia_resultados_detalle->addResiliencia_resultados_detalle($request);
        $request->session()->flash('message', 'resiliencia_resultados_detalle Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Resiliencia_resultados_detalleController@index');
    }

    public function getEdit($id=''){

        $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;

        $users = $resiliencia_resultados_detalle->getAll('resiliencia_resultados_detalle');

        $data = $resiliencia_resultados_detalle->getResiliencia_resultados_detalle($id);

        $config = array();

        $config['titulo'] = "resiliencia_resultados_detalle";

        $config['cancelar'] = url('/admin/resiliencia_resultados_detalle');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de resiliencia_resultados_detalle",
            'href' => url('/admin/resiliencia_resultados_detalle'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar resiliencia_resultados_detalle",
            'href' => url('/admin/resiliencia_resultados_detalle/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/resiliencia_resultados_detalle/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/resiliencia_resultados_detalle/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;
        if($resiliencia_resultados_detalle->updateResiliencia_resultados_detalle($request)){
            $request->session()->flash('message', 'resiliencia_resultados_detalle Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\Resiliencia_resultados_detalleController@index');
    }

    public function view($id){

      $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;

      $data = $resiliencia_resultados_detalle->getResiliencia_resultados_detalleView($id);

      $config = array();

      $config['titulo'] = "resiliencia_resultados_detalle";

      $config['cancelar'] = url('/admin/resiliencia_resultados_detalle');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de resiliencia_resultados_detalle",
          'href' => url('/admin/resiliencia_resultados_detalle'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de resiliencia_resultados_detalle",
          'href' => url('/admin/resiliencia_resultados_detalle/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/resiliencia_resultados_detalle/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/resiliencia_resultados_detalle/view');

      }

    }

    public function baja($id){

        $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;
        $flag = $resiliencia_resultados_detalle->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$resiliencia_resultados_detalle deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Resiliencia_resultados_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Resiliencia_resultados_detalleController@index');
        }
    }

    public function alta($id){
        $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;
        $flag = $resiliencia_resultados_detalle->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$resiliencia_resultados_detalle habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Resiliencia_resultados_detalleController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Resiliencia_resultados_detalleController@index');
        }
    }

    public function getAjax($id){

      $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;

      $data = $resiliencia_resultados_detalle->getResiliencia_resultados_detalleView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $resiliencia_resultados_detalle = new \App\admin\Resiliencia_resultados_detalle;

      $data = $resiliencia_resultados_detalle->getResiliencia_resultados_detalleExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$resiliencia_resultados_detalle', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
