<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pacientes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class PacientesController extends Controller
{
    public $v_fields=array('pacientes.delegacion_id', 'pacientes.area_id', 'pacientes.no_expediente', 'pacientes.genero_id', 'pacientes.educacion_id', 'pacientes.ocupacion_id', 'pacientes.edo_civil_id', 'pacientes.familiologo', 'pacientes.psicopedagogia', 'pacientes.medico', 'pacientes.psicologo', 'pacientes.trabsocial', 'pacientes.nombre', 'pacientes.curp', 'pacientes.telefono', 'pacientes.celular', 'pacientes.tipo_ocupacion', 'pacientes.domicilio', 'pacientes.sexo', 'pacientes.nacimiento', 'pacientes.edad', 'pacientes.hijos', 'pacientes.lugar_nacimiento', 'pacientes.residencia', 'pacientes.canalizado', 'pacientes.fotografia', 'pacientes.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $pacientes = new \App\admin\Pacientes;

        $config = array();

        $config['titulo'] = "Admon. Pacientes";

        $config['cancelar'] = url('/admin/pacientes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de pacientes",
            'href' => url('/admin/pacientes'),
            'active' => false
        );

        $data = $pacientes->getPacientesData($per_page, $request, $sortBy, $order);

        return view('admin/pacientes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $pacientes = new \App\admin\Pacientes;

      $config = array();

      $config['titulo'] = "Admon. Pacientes";

      $config['cancelar'] = url('/admin/pacientes');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pacientes",
          'href' => url('/admin/pacientes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar pacientes",
          'href' => url('/admin/pacientes/add'),
          'active' => true
      );

      $data = new $pacientes;

    	return view('admin/pacientes/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $pacientes = new \App\admin\Pacientes;
        $pacientes->addPacientes($request);
        $request->session()->flash('message', 'pacientes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\PacientesController@index');
    }

    public function getEdit($id=''){

        $pacientes = new \App\admin\Pacientes;

        $users = $pacientes->getAll('pacientes');

        $data = $pacientes->getPacientes($id);

        $config = array();

        $config['titulo'] = "Admon. Pacientes";

        $config['cancelar'] = url('/admin/pacientes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de pacientes",
            'href' => url('/admin/pacientes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar pacientes",
            'href' => url('/admin/pacientes/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/pacientes/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/pacientes/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $pacientes = new \App\admin\Pacientes;
        if($pacientes->updatePacientes($request)){
            $request->session()->flash('message', 'pacientes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\PacientesController@index');
    }

    public function view($id){

      $pacientes = new \App\admin\Pacientes;

      $data = $pacientes->getPacientesView($id);

      $config = array();

      $config['titulo'] = "Admon. Pacientes";

      $config['cancelar'] = url('/admin/pacientes');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pacientes",
          'href' => url('/admin/pacientes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de pacientes",
          'href' => url('/admin/pacientes/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/pacientes/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/pacientes/view');

      }

    }

    public function baja($id){

        $pacientes = new \App\admin\Pacientes;
        $flag = $pacientes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$pacientes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PacientesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PacientesController@index');
        }
    }

    public function alta($id){
        $pacientes = new \App\admin\Pacientes;
        $flag = $pacientes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$pacientes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PacientesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PacientesController@index');
        }
    }

    public function getAjax($id){

      $pacientes = new \App\admin\Pacientes;

      $data = $pacientes->getPacientesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $pacientes = new \App\admin\Pacientes;

      $data = $pacientes->getPacientesExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$pacientes', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

    public function getCurpInfo($curp) {

      $paciente = \App\admin\Pacientes::where('curp',$curp)->first();

      if(count($paciente)) {
        return array('error' => 0, 'msg' => '','data' => $paciente,'paciente_id' => $paciente->id);
      } else {
        return array('error' => 1, 'msg' => '','paciente_id' => '0');
      }
    }

}
