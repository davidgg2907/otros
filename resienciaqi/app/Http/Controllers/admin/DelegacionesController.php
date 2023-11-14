<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delegaciones;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class DelegacionesController extends Controller
{
    public $v_fields=array('delegaciones.nombre', 'delegaciones.seo', 'delegaciones.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $delegaciones = new \App\admin\Delegaciones;

        $config = array();

        $config['titulo'] = "Admon. Delegaciones";

        $config['cancelar'] = url('/admin/delegaciones');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de delegaciones",
            'href' => url('/admin/delegaciones'),
            'active' => false
        );

        $data = $delegaciones->getDelegacionesData($per_page, $request, $sortBy, $order);

        return view('admin/delegaciones/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function dashGeneral($id){

      $delegaciones = new \App\admin\Delegaciones;

      $data = $delegaciones->getDelegacionesView($id);

      $config = array();

      $config['titulo'] = "Resultados por Delegacion";

      $config['cancelar'] = url('/admin/delegaciones');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de delegaciones",
          'href' => url('/admin/delegaciones'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de delegaciones",
          'href' => url('/admin/delegaciones/view'),
          'active' => true
      );

      if(count($data)){

        $resultados = \App\admin\Resultados::ponenciaPacientes($data->id); 

        return view('admin/delegaciones/generales', ['data'=>$data, 'config'=>$config,'resultados' => $resultados]);

      } else{

        return view('admin/delegaciones/generales');

      }

    }

    public function dashResilencia($id){

        $delegaciones = new \App\admin\Delegaciones;
  
        $data = $delegaciones->getDelegacionesView($id);
  
        $config = array();
  
        $config['titulo'] = "Resultados por Delegacion";
  
        $config['cancelar'] = url('/admin/delegaciones');
  
        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );
  
        $config['breadcrumbs'][] = array(
            'text' => "Listado de delegaciones",
            'href' => url('/admin/delegaciones'),
            'active' => false
        );
  
        $config['breadcrumbs'][] = array(
            'text' => "Detalledel de delegaciones",
            'href' => url('/admin/delegaciones/view'),
            'active' => true
        );
  
        if(count($data)){
  
          $resultados = \App\admin\Resultados::ponenciaPacientes($data->id); 
  
          return view('admin/delegaciones/resilencia', ['data'=>$data, 'config'=>$config,'resultados' => $resultados]);
  
        } else{
  
          return view('admin/delegaciones/resilencia');
  
        }
  
    }

    public function getAdd(Request $request){

      $delegaciones = new \App\admin\Delegaciones;

      $config = array();

      $config['titulo'] = "Admon. Delegaciones";

      $config['cancelar'] = url('/admin/delegaciones');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de delegaciones",
          'href' => url('/admin/delegaciones'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar delegaciones",
          'href' => url('/admin/delegaciones/add'),
          'active' => true
      );

      $data = new $delegaciones;

    	return view('admin/delegaciones/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $delegaciones = new \App\admin\Delegaciones;
        $delegaciones->addDelegaciones($request);
        $request->session()->flash('message', 'delegaciones Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\DelegacionesController@index');
    }

    public function getEdit($id=''){

        $delegaciones = new \App\admin\Delegaciones;

        $users = $delegaciones->getAll('delegaciones');

        $data = $delegaciones->getDelegaciones($id);

        $config = array();

        $config['titulo'] = "Admon. Delegaciones";

        $config['cancelar'] = url('/admin/delegaciones');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de delegaciones",
            'href' => url('/admin/delegaciones'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar delegaciones",
            'href' => url('/admin/delegaciones/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/delegaciones/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/delegaciones/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $delegaciones = new \App\admin\Delegaciones;
        if($delegaciones->updateDelegaciones($request)){
            $request->session()->flash('message', 'delegaciones Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\DelegacionesController@index');
    }

    public function view($id){

      $delegaciones = new \App\admin\Delegaciones;

      $data = $delegaciones->getDelegacionesView($id);

      $config = array();

      $config['titulo'] = "Admon. Delegaciones";

      $config['cancelar'] = url('/admin/delegaciones');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de delegaciones",
          'href' => url('/admin/delegaciones'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de delegaciones",
          'href' => url('/admin/delegaciones/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/delegaciones/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/delegaciones/view');

      }

    }

    public function baja($id){

        $delegaciones = new \App\admin\Delegaciones;
        $flag = $delegaciones->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$delegaciones deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\DelegacionesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\DelegacionesController@index');
        }
    }

    public function alta($id){
        $delegaciones = new \App\admin\Delegaciones;
        $flag = $delegaciones->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$delegaciones habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\DelegacionesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\DelegacionesController@index');
        }
    }

    public function getAjax($id){

      $delegaciones = new \App\admin\Delegaciones;

      $data = $delegaciones->getDelegacionesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcelGeneral($id) {

        $resultados = \App\admin\Resultados::ponenciaPacientes($data->id);
        print_r($resultados);
        /*
        \Maatwebsite\Excel\Facades\Excel::create('resultados', function($excel) use ($resultados) {
            $excel->sheet('Sheetname', function($sheet) use ($resultados) {
                //$sheet->fromArray($resultados);
                $sheet->fromArray($data);
            });
  
        })->export('xls');*/

    }

    public function getQuiz($id){

      $delegacion = \App\admin\Delegaciones::where('seo',$id)->first();

      //print_r($delegacion);      
      return view('site/login', ['data'=>$delegacion]);


    }
}
