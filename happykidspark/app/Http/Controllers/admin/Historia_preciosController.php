<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Historia_precios;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class Historia_preciosController extends Controller
{
    public $v_fields=array('historia_precios.producto_id', 'historia_precios.fecha', 'historia_precios.costo', 'historia_precios.venta', 'historia_precios.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $historia_precios = new \App\admin\Historia_precios;

        $config = array();

        $config['titulo'] = "historia_precios";

        $config['cancelar'] = url('/admin/historia_precios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de historia_precios",
            'href' => url('/admin/historia_precios'),
            'active' => false
        );

        $data = $historia_precios->getHistoria_preciosData($per_page, $request, $sortBy, $order);

        return view('admin/historia_precios/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $historia_precios = new \App\admin\Historia_precios;

      $config = array();

      $config['titulo'] = "historia_precios";

      $config['cancelar'] = url('/admin/historia_precios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de historia_precios",
          'href' => url('/admin/historia_precios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar historia_precios",
          'href' => url('/admin/historia_precios/add'),
          'active' => true
      );

      $data = new $historia_precios;

    	return view('admin/historia_precios/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $historia_precios = new \App\admin\Historia_precios;
        $historia_precios->addHistoria_precios($request);
        $request->session()->flash('message', 'historia_precios Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\Historia_preciosController@index');
    }

    public function getEdit($id=''){

        $historia_precios = new \App\admin\Historia_precios;

        $users = $historia_precios->getAll('historia_precios');

        $data = $historia_precios->getHistoria_precios($id);

        $config = array();

        $config['titulo'] = "historia_precios";

        $config['cancelar'] = url('/admin/historia_precios');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de historia_precios",
            'href' => url('/admin/historia_precios'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar historia_precios",
            'href' => url('/admin/historia_precios/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/historia_precios/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/historia_precios/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $historia_precios = new \App\admin\Historia_precios;
        if($historia_precios->updateHistoria_precios($request)){
            $request->session()->flash('message', 'historia_precios Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\Historia_preciosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\Historia_preciosController@index');
        }
    }

    public function view($id){

      $historia_precios = new \App\admin\Historia_precios;

      $data = $historia_precios->getHistoria_preciosView($id);

      $config = array();

      $config['titulo'] = "historia_precios";

      $config['cancelar'] = url('/admin/historia_precios');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de historia_precios",
          'href' => url('/admin/historia_precios'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de historia_precios",
          'href' => url('/admin/historia_precios/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/historia_precios/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/historia_precios/view');

      }

    }

    public function baja($id){

        $historia_precios = new \App\admin\Historia_precios;
        $flag = $historia_precios->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$historia_precios deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Historia_preciosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Historia_preciosController@index');
        }
    }

    public function alta($id){
        $historia_precios = new \App\admin\Historia_precios;
        $flag = $historia_precios->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$historia_precios habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\Historia_preciosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\Historia_preciosController@index');
        }
    }

    public function getAjax($id){

      $historia_precios = new \App\admin\Historia_precios;

      $data = $historia_precios->getHistoria_preciosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $historia_precios = new \App\admin\Historia_precios;

      $data = $historia_precios->getHistoria_preciosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$historia_precios', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
