<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bandas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class BandasController extends Controller
{
    public $v_fields=array('bandas.color', 'bandas.inicia', 'bandas.termina', 'bandas.usadas', 'bandas.actual', 'bandas.rgb', 'bandas.serie', 'bandas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $bandas = new \App\admin\Bandas;

        $config = array();

        $config['titulo'] = "bandas";

        $config['cancelar'] = url('/admin/bandas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de bandas",
            'href' => url('/admin/bandas'),
            'active' => false
        );

        $data = $bandas->getBandasData($per_page, $request, $sortBy, $order);

        return view('admin/bandas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $bandas = new \App\admin\Bandas;

      $config = array();

      $config['titulo'] = "bandas";

      $config['cancelar'] = url('/admin/bandas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de bandas",
          'href' => url('/admin/bandas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar bandas",
          'href' => url('/admin/bandas/add'),
          'active' => true
      );

      $data = new $bandas;

    	return view('admin/bandas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $bandas = new \App\admin\Bandas;
        $bandas->addBandas($request);
        $request->session()->flash('message', 'bandas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\BandasController@index');
    }

    public function getEdit($id=''){

        $bandas = new \App\admin\Bandas;

        $users = $bandas->getAll('bandas');

        $data = $bandas->getBandas($id);

        $config = array();

        $config['titulo'] = "bandas";

        $config['cancelar'] = url('/admin/bandas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de bandas",
            'href' => url('/admin/bandas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar bandas",
            'href' => url('/admin/bandas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/bandas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/bandas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $bandas = new \App\admin\Bandas;
        if($bandas->updateBandas($request)){
            $request->session()->flash('message', 'bandas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\BandasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\BandasController@index');
        }
    }

    public function view($id){

      $bandas = new \App\admin\Bandas;

      $data = $bandas->getBandasView($id);

      $config = array();

      $config['titulo'] = "bandas";

      $config['cancelar'] = url('/admin/bandas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de bandas",
          'href' => url('/admin/bandas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de bandas",
          'href' => url('/admin/bandas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/bandas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/bandas/view');

      }

    }

    public function baja($id){

        $bandas = new \App\admin\Bandas;
        $flag = $bandas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$bandas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\BandasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\BandasController@index');
        }
    }

    public function alta($id){
        $bandas = new \App\admin\Bandas;
        $flag = $bandas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$bandas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\BandasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\BandasController@index');
        }
    }

    public function getAjax($id){

      $bandas = new \App\admin\Bandas;

      $data = $bandas->getBandasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExistencia($id,Request $request){

      $data = \App\admin\Bandas::where('id',$id)->where('status',1)->first();

      if(count($data)){

        $usado = \App\admin\Temporizador::where('banda_id',$id)->where('barras',$request->input('siguiente'))->where('status',1)->first();

        if(!count($usado)) {
          return array('error' =>0, 'msg' => '','data' => $data);
        } else {
          return array('error' =>1, 'msg' => 'El numero de banda seleccionado ya ha sido usado con anterioridad, no se puede utilizar nuevamente','data' => array());
        }

      } else{

        return array('error' =>1, 'msg' => 'Las bandas seleccionadas no existen o ya fueron utilizadas en su totalidad','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $bandas = new \App\admin\Bandas;

      $data = $bandas->getBandasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$bandas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
