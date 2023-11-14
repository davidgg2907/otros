<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ambulancias;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class AmbulanciasController extends Controller
{
    public $v_fields=array('ambulancias.fecha', 'ambulancias.servicio', 'ambulancias.unidad', 'ambulancias.chofer', 'ambulancias.enfermera', 'ambulancias.medico', 'ambulancias.paciente', 'ambulancias.acompanante', 'ambulancias.diagnostico', 'ambulancias.origen', 'ambulancias.destino', 'ambulancias.comentario', 'ambulancias.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $ambulancias = new \App\admin\Ambulancias;

        $config = array();

        $config['titulo'] = "Serv. Ambulancias";

        $config['cancelar'] = url('/admin/ambulancias');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ambulancias",
            'href' => url('/admin/ambulancias'),
            'active' => false
        );

        $data = $ambulancias->getAmbulanciasData($per_page, $request, $sortBy, $order);

        return view('admin/ambulancias/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $ambulancias = new \App\admin\Ambulancias;

      $config = array();

      $config['titulo'] = "Serv. Ambulancias";

      $config['cancelar'] = url('/admin/ambulancias');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ambulancias",
          'href' => url('/admin/ambulancias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar ambulancias",
          'href' => url('/admin/ambulancias/add'),
          'active' => true
      );

      $data = new $ambulancias;

    	return view('admin/ambulancias/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
      	 'servicio'=> 'required' ,
      	 'unidad'=> 'required' ,
      	 'chofer'=> 'required' ,
      	 'enfermera'=> 'required' ,
      	 'medico'=> 'required' ,
      	 'paciente'=> 'required' ,
      	 'acompanante'=> 'required' ,
      	 'diagnostico'=> 'required' ,
      	 'origen'=> 'required' ,
      	 'destino'=> 'required' ,
      	 'comentario'=> 'required' ,
        ]);

        $ambulancias = new \App\admin\Ambulancias;
        $ambulancias->addAmbulancias($request);
        $request->session()->flash('message', 'ambulancias Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\AmbulanciasController@index');
    }

    public function getEdit($id=''){

        $ambulancias = new \App\admin\Ambulancias;

        $users = $ambulancias->getAll('ambulancias');

        $data = $ambulancias->getAmbulancias($id);

        $config = array();

        $config['titulo'] = "Serv. Ambulancias";

        $config['cancelar'] = url('/admin/ambulancias');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de ambulancias",
            'href' => url('/admin/ambulancias'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar ambulancias",
            'href' => url('/admin/ambulancias/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/ambulancias/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/ambulancias/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
         'servicio'=> 'required' ,
         'unidad'=> 'required' ,
         'chofer'=> 'required' ,
         'enfermera'=> 'required' ,
         'medico'=> 'required' ,
         'paciente'=> 'required' ,
         'acompanante'=> 'required' ,
         'diagnostico'=> 'required' ,
         'origen'=> 'required' ,
         'destino'=> 'required' ,
         'comentario'=> 'required' ,
        ]);

        $ambulancias = new \App\admin\Ambulancias;
        if($ambulancias->updateAmbulancias($request)){
            $request->session()->flash('message', 'ambulancias Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\AmbulanciasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\AmbulanciasController@index');
        }
    }

    public function view($id){

      $ambulancias = new \App\admin\Ambulancias;

      $data = $ambulancias->getAmbulanciasView($id);

      $config = array();

      $config['titulo'] = "Serv. Ambulancias";

      $config['cancelar'] = url('/admin/ambulancias');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de ambulancias",
          'href' => url('/admin/ambulancias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de ambulancias",
          'href' => url('/admin/ambulancias/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/ambulancias/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/ambulancias/view');

      }

    }

    public function getFicha($id){

      $ambulancias = new \App\admin\Ambulancias;

      $empresa   = \App\admin\Empresas::find(1);

      $data = $ambulancias->getAmbulanciasView($id);

      $pdf = PDF::loadView('admin/ambulancias/ficha', ['data'=>$data, 'config'=>$config,'empresa' => $empresa],
                                                [ 'title' => 'Servicio de Ambulancias #' . $data->id, 'margin_top' => 0]);

      return $pdf->stream('servicioAmbulancia' . $data->id . '.pdf');

    }


    public function baja($id){

        $ambulancias = new \App\admin\Ambulancias;
        $flag = $ambulancias->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$ambulancias deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AmbulanciasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AmbulanciasController@index');
        }
    }

    public function alta($id){
        $ambulancias = new \App\admin\Ambulancias;
        $flag = $ambulancias->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$ambulancias habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AmbulanciasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AmbulanciasController@index');
        }
    }

    public function getAjax($id){

      $ambulancias = new \App\admin\Ambulancias;

      $data = $ambulancias->getAmbulanciasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $data =  \App\admin\Ambulancias::select('id AS folio','fecha','servicio','unidad',
                                                'chofer','enfermera','medico','paciente',
                                                'acompanante','diagnostico','origen','destino','comentario')->get();

        \Maatwebsite\Excel\Facades\Excel::create('ambulancias', function($excel) use ($data) {
            $excel->sheet('Sheetname', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
  
        })->export('xls');
    }

}
