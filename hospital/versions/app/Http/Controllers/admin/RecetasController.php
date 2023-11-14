<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recetas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class RecetasController extends Controller
{
    public $v_fields=array('pacientes.nombre', 'modulos.id', 'recetas.fecha', 'recetas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $recetas = new \App\admin\Recetas;

        $config = array();

        $config['titulo'] = "Emision de Recetas";

        $config['cancelar'] = url('/admin/recetas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de recetas",
            'href' => url('/admin/recetas'),
            'active' => false
        );

        $data = $recetas->getRecetasData($per_page, $request, $sortBy, $order);

        return view('admin/recetas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $recetas = new \App\admin\Recetas;

      $config = array();

      $config['titulo'] = "Emision de Recetas";

      $config['cancelar'] = url('/admin/recetas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de recetas",
          'href' => url('/admin/recetas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar recetas",
          'href' => url('/admin/recetas/add'),
          'active' => true
      );

      $data = new $recetas;

    	return view('admin/recetas/add', ['config'=>$config,'data'=>$data, 'pacientes'=>$recetas->getAll('pacientes'),'medicos'=>$recetas->getAll('medicos')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' ,
          	 'medico_id'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $recetas = new \App\admin\Recetas;
        $recetas->addRecetas($request);
        $request->session()->flash('message', 'recetas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\RecetasController@index');
    }

    public function getEdit($id=''){

        $recetas = new \App\admin\Recetas;

        $users = $recetas->getAll('recetas');

        $data = $recetas->getRecetas($id);

        $config = array();

        $config['titulo'] = "Emision de Recetas";

        $config['cancelar'] = url('/admin/recetas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de recetas",
            'href' => url('/admin/recetas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar recetas",
            'href' => url('/admin/recetas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/recetas/edit', ['data'=>$data, 'config'=>$config ,'pacientes'=>$recetas->getAll('pacientes'),'medicos'=>$recetas->getAll('medicos')]);
        } else{
          return view('admin/recetas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' ,
          	 'medico_id'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $recetas = new \App\admin\Recetas;
        if($recetas->updateRecetas($request)){
            $request->session()->flash('message', 'recetas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\RecetasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\RecetasController@index');
        }
    }

    public function view($id){

      $recetas = new \App\admin\Recetas;
      $empresa = \App\admin\Empresas::find(1);

      $data = $recetas->getRecetasView($id);

      $config = array();

      $config['titulo'] = "Emision de Recetas";

      $config['cancelar'] = url('/admin/recetas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de recetas",
          'href' => url('/admin/recetas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de recetas",
          'href' => url('/admin/recetas/view'),
          'active' => true
      );

      $pdf = PDF::loadView('admin/recetas/print', ['data'=>$data, 'config'=>$config,'empresa' => $empresa],
                                                [ 'title' => 'Expediente #' . $data->id, 'margin_top' => 0]);

      return $pdf->stream('receta' . $data->id . '.pdf');

    }

    public function baja($id){

        $recetas = new \App\admin\Recetas;
        $flag = $recetas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$recetas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\RecetasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\RecetasController@index');
        }
    }

    public function alta($id){
        $recetas = new \App\admin\Recetas;
        $flag = $recetas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$recetas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\RecetasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\RecetasController@index');
        }
    }

    public function getAjax($id){

      $recetas = new \App\admin\Recetas;

      $data = $recetas->getRecetasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
