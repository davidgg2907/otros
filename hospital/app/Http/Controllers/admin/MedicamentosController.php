<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medicamentos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class MedicamentosController extends Controller
{
    public $v_fields=array('medicamentos.comercial', 'medicamentos.generico', 'medicamentos.activo', 'medicamentos.componentes', 'medicamentos.farmaceutica', 'medicamentos.cantidad', 'medicamentos.costo', 'medicamentos.precio', 'medicamentos.caducidad', 'medicamentos.efectos', 'medicamentos.recomendaciones', 'medicamentos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $medicamentos = new \App\admin\Medicamentos;

        $config = array();

        $config['titulo'] = "Catalogo de Medicamentos";

        $config['cancelar'] = url('/admin/medicamentos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de medicamentos",
            'href' => url('/admin/medicamentos'),
            'active' => false
        );

        $data = $medicamentos->getMedicamentosData($per_page, $request, $sortBy, $order);

        return view('admin/medicamentos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $medicamentos = new \App\admin\Medicamentos;

      $config = array();

      $config['titulo'] = "Catalogo de Medicamentos";

      $config['cancelar'] = url('/admin/medicamentos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de medicamentos",
          'href' => url('/admin/medicamentos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar medicamentos",
          'href' => url('/admin/medicamentos/add'),
          'active' => true
      );

      $data = new $medicamentos;

    	return view('admin/medicamentos/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'comercial'=> 'required' ,
	 'generico'=> 'required' ,
	 'activo'=> 'required' ,
	 'cantidad'=> 'required' ,
	 'costo'=> 'required' ,
	 'precio'=> 'required' ,
	 'caducidad'=> 'required' ,
	 'status'=> 'required'
        ]);

        $medicamentos = new \App\admin\Medicamentos;
        $medicamentos->addMedicamentos($request);
        $request->session()->flash('message', 'medicamentos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\MedicamentosController@index');
    }

    public function getEdit($id=''){

        $medicamentos = new \App\admin\Medicamentos;

        $users = $medicamentos->getAll('medicamentos');

        $data = $medicamentos->getMedicamentos($id);

        $config = array();

        $config['titulo'] = "Catalogo de Medicamentos";

        $config['cancelar'] = url('/admin/medicamentos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de medicamentos",
            'href' => url('/admin/medicamentos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar medicamentos",
            'href' => url('/admin/medicamentos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/medicamentos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/medicamentos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'comercial'=> 'required' ,
	 'generico'=> 'required' ,
	 'activo'=> 'required' ,
	 'cantidad'=> 'required' ,
	 'costo'=> 'required' ,
	 'precio'=> 'required' ,
	 'caducidad'=> 'required' ,
	 'status'=> 'required'
        ]);

        $medicamentos = new \App\admin\Medicamentos;
        if($medicamentos->updateMedicamentos($request)){
            $request->session()->flash('message', 'medicamentos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\MedicamentosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\MedicamentosController@index');
        }
    }

    public function view($id){

      $medicamentos = new \App\admin\Medicamentos;

      $data = $medicamentos->getMedicamentosView($id);

      $config = array();

      $config['titulo'] = "Catalogo de Medicamentos";

      $config['cancelar'] = url('/admin/medicamentos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de medicamentos",
          'href' => url('/admin/medicamentos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de medicamentos",
          'href' => url('/admin/medicamentos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/medicamentos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/medicamentos/view');

      }

    }

    public function baja($id){

        $medicamentos = new \App\admin\Medicamentos;
        $flag = $medicamentos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$medicamentos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\MedicamentosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\MedicamentosController@index');
        }
    }

    public function alta($id){
        $medicamentos = new \App\admin\Medicamentos;
        $flag = $medicamentos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$medicamentos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\MedicamentosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\MedicamentosController@index');
        }
    }

    public function getAjax($id){

      $medicamentos = new \App\admin\Medicamentos;

      $data = $medicamentos->getMedicamentosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
