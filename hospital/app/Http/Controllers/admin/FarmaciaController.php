<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Farmacia;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class FarmaciaController extends Controller
{
    public $v_fields=array('cuartos.numero', 'enfermeria.nombre', 'medicos.nombre', 'asistentes.nombre', 'farmacia.fecha_registro', 'farmacia.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $farmacia = new \App\admin\Farmacia;

        $config = array();

        $config['titulo'] = "Ordenes de Farmacia";

        $config['cancelar'] = url('/admin/farmacia');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de farmacia",
            'href' => url('/admin/farmacia'),
            'active' => false
        );

        $data = $farmacia->getFarmaciaData($per_page, $request, $sortBy, $order);

        return view('admin/farmacia/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $farmacia = new \App\admin\Farmacia;

      $config = array();

      $config['titulo'] = "Ordenes de Farmacia";

      $config['cancelar'] = url('/admin/farmacia');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de farmacia",
          'href' => url('/admin/farmacia'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar farmacia",
          'href' => url('/admin/farmacia/add'),
          'active' => true
      );

      $data = new $farmacia;

    	return view('admin/farmacia/add', ['config'=>$config,'data'=>$data, 'cuartos'=>$farmacia->getAll('cuartos'),'enfermeria'=>$farmacia->getAll('enfermeria'),'medicos'=>$farmacia->getAll('medicos'),'asistentes'=>$farmacia->getAll('asistentes')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'cuarto_id'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $farmacia = new \App\admin\Farmacia;
        $farmacia->addFarmacia($request);
        $request->session()->flash('message', 'farmacia Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\FarmaciaController@index');
    }

    public function getEdit($id=''){

        $farmacia = new \App\admin\Farmacia;

        $users = $farmacia->getAll('farmacia');

        $data = $farmacia->getFarmacia($id);

        $config = array();

        $config['titulo'] = "Ordenes de Farmacia";

        $config['cancelar'] = url('/admin/farmacia');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de farmacia",
            'href' => url('/admin/farmacia'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar farmacia",
            'href' => url('/admin/farmacia/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/farmacia/edit', ['data'=>$data, 'config'=>$config ,'cuartos'=>$farmacia->getAll('cuartos'),'enfermeria'=>$farmacia->getAll('enfermeria'),'medicos'=>$farmacia->getAll('medicos'),'asistentes'=>$farmacia->getAll('asistentes')]);
        } else{
          return view('admin/farmacia/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'cuarto_id'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $farmacia = new \App\admin\Farmacia;
        if($farmacia->updateFarmacia($request)){
            $request->session()->flash('message', 'farmacia Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\FarmaciaController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\FarmaciaController@index');
        }
    }

    public function view($id){

      $farmacia = new \App\admin\Farmacia;

      $data = $farmacia->getFarmaciaView($id);

      $empresa = \App\admin\Empresas::find(1);

      //return view('admin/farmacia/view', ['data'=>$data, 'empresa'=>$empresa]);
      $pdf = PDF::loadView('admin/farmacia/view', ['data'=>$data, 'empresa' => $empresa],
                                                [ 'title' => 'Orden #' . $data->id, 'margin_top' => 0]);

      return $pdf->stream('voucher' . $data->id . '.pdf');

    }

    public function baja($id){

        $farmacia = new \App\admin\Farmacia;
        $flag = $farmacia->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$farmacia deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\FarmaciaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\FarmaciaController@index');
        }
    }

    public function alta($id){
        $farmacia = new \App\admin\Farmacia;
        $flag = $farmacia->updateStatus($id,2);
        if($flag){
            Session::flash('message', '$farmacia habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\FarmaciaController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\FarmaciaController@index');
        }
    }

    public function getAjax($id){

      $farmacia = new \App\admin\Farmacia;

      $data = $farmacia->getFarmaciaView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
