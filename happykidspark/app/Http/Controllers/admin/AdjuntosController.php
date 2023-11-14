<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Adjuntos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class AdjuntosController extends Controller
{
    public $v_fields=array('adjuntos.id', 'adjuntos.producto_id', 'adjuntos.producto_adjunto_id', 'adjuntos.cantidad', 'adjuntos.precio', 'adjuntos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $adjuntos = new \App\admin\Adjuntos;

        $config = array();

        $config['titulo'] = "adjuntos";

        $config['cancelar'] = url('/admin/adjuntos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de adjuntos",
            'href' => url('/admin/adjuntos'),
            'active' => false
        );

        $data = $adjuntos->getAdjuntosData($per_page, $request, $sortBy, $order);

        return view('admin/adjuntos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $adjuntos = new \App\admin\Adjuntos;

      $config = array();

      $config['titulo'] = "adjuntos";

      $config['cancelar'] = url('/admin/adjuntos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de adjuntos",
          'href' => url('/admin/adjuntos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar adjuntos",
          'href' => url('/admin/adjuntos/add'),
          'active' => true
      );

      $data = new $adjuntos;

    	return view('admin/adjuntos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $adjuntos = new \App\admin\Adjuntos;
        $adjuntos->addAdjuntos($request);
        $request->session()->flash('message', 'adjuntos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\AdjuntosController@index');
    }

    public function getEdit($id=''){

        $adjuntos = new \App\admin\Adjuntos;

        $users = $adjuntos->getAll('adjuntos');

        $data = $adjuntos->getAdjuntos($id);

        $config = array();

        $config['titulo'] = "adjuntos";

        $config['cancelar'] = url('/admin/adjuntos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de adjuntos",
            'href' => url('/admin/adjuntos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar adjuntos",
            'href' => url('/admin/adjuntos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/adjuntos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/adjuntos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $adjuntos = new \App\admin\Adjuntos;
        if($adjuntos->updateAdjuntos($request)){
            $request->session()->flash('message', 'adjuntos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\AdjuntosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\AdjuntosController@index');
        }
    }

    public function view($id){

      $adjuntos = new \App\admin\Adjuntos;

      $data = $adjuntos->getAdjuntosView($id);

      $config = array();

      $config['titulo'] = "adjuntos";

      $config['cancelar'] = url('/admin/adjuntos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de adjuntos",
          'href' => url('/admin/adjuntos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de adjuntos",
          'href' => url('/admin/adjuntos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/adjuntos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/adjuntos/view');

      }

    }

    public function baja($id){

        $adjuntos = new \App\admin\Adjuntos;
        $flag = $adjuntos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$adjuntos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AdjuntosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AdjuntosController@index');
        }
    }

    public function alta($id){
        $adjuntos = new \App\admin\Adjuntos;
        $flag = $adjuntos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$adjuntos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AdjuntosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AdjuntosController@index');
        }
    }

    public function getAjax($id){

      $adjuntos = new \App\admin\Adjuntos;

      $data = $adjuntos->getAdjuntosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $adjuntos = new \App\admin\Adjuntos;

      $data = $adjuntos->getAdjuntosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$adjuntos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
