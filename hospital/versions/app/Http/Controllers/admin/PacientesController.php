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
    public $v_fields=array('pacientes.nombre', 'pacientes.telefono', 'pacientes.celular', 'pacientes.domicilio', 'pacientes.tsangre', 'pacientes.sexo', 'pacientes.nacimiento', 'pacientes.alergias', 'pacientes.hereditarias', 'pacientes.cirugias', 'pacientes.vicios', 'pacientes.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $pacientes = new \App\admin\Pacientes;

        $config = array();

        $config['titulo'] = "Control de Pacientes";

        $config['cancelar'] = url('/admin/pacientes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de pacientes",
            'href' => url('/admin/pacientes'),
            'active' => false
        );

        $data = $pacientes->getPacientesData($per_page, $request, $sortBy, $order);

        return view('admin/pacientes/index', ['data'=>$data->appends(Input::except('page')),

                                              'per_page'=>$per_page,

                                              'links'=>$links,'config'=>$config,

                                              'query' =>$_SERVER['QUERY_STRING'],

                                              'medicos'   => $pacientes->getAll('medicos'),

                                              'visible'   => $visible,

                                              'multiple'  => $multiple,

                                              'full'      => $full,

                                              'doctores'  => $doctores

                                             ]);
    }

    public function getAdd(Request $request){

      $pacientes = new \App\admin\Pacientes;

      $config = array();

      $config['titulo'] = "Control de Pacientes";

      $config['cancelar'] = url('/admin/pacientes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
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
             'nombre'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'status'=> 'required'
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

        $config['titulo'] = "Control de Pacientes";

        $config['cancelar'] = url('/admin/pacientes');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
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
             'nombre'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $pacientes = new \App\admin\Pacientes;
        if($pacientes->updatePacientes($request)){
            $request->session()->flash('message', 'pacientes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\PacientesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\PacientesController@index');
        }
    }

    public function view($id){

      $pacientes = new \App\admin\Pacientes;

      $data = $pacientes->getPacientesView($id);

      $config = array();

      $config['titulo'] = "Control de Pacientes";

      $config['cancelar'] = url('/admin/pacientes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
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

        return view('admin/pacientes/view', ['data'=>$data, 'config'=>$config,'medicos'   => $pacientes->getAll('medicos')]);

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

    public function getExpediente($id){

      $pacientes = new \App\admin\Pacientes;

      $data = $pacientes->getPacientesView($id);

      $config = array();

      $config['titulo'] = "Control de Pacientes";

      $config['cancelar'] = url('/admin/pacientes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
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

        return view('admin/pacientes/historial', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/pacientes/historial');

      }

    }

    public function getFicha($id){

      $pacientes = new \App\admin\Pacientes;

      $empresa   = \App\admin\Empresas::find(1);

      $data = $pacientes->getPacientesView($id);

      $config = array();

      $config['titulo'] = "Control de Pacientes";

      $config['cancelar'] = url('/admin/pacientes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
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

      $pdf = PDF::loadView('admin/pacientes/ficha', ['data'=>$data, 'config'=>$config,'empresa' => $empresa],
                                                [ 'title' => 'Expediente #' . $data->id, 'margin_top' => 0]);

  		return $pdf->stream('expediente' . $data->id . '.pdf');


      //return view('admin/pacientes/ficha', ['data'=>$data, 'config'=>$config,'empresa' => $empresa]);

    }

    public function getSearch(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $pacientes = new \App\admin\Pacientes;

        $data = $pacientes->getPacientesData($per_page, $request, 'id', 'ASC');

        if(count($data)) {

          $html = "";

          foreach($data as $value) {

            $html .= '<tr>
                         <td>' . $value->nombre . '</td>
                         <td>' . $value->telefono . '</td>
                         <td>' . $value->celular . '</td>
                         <td>
                           <button type="button" title="Seleccionar Paciente" class="btn btn-primary" id="btnMedSelect" onclick="seleccionaPaciente(' . $value->id . ',\'' . $value->nombre . '\')"> <li class="fa fa-check-circle fa-lg"></li></button>
                         </td>
                     </tr>';
          }

          return array('error' => 0, 'msg' => '','html' => $html);

        } else {
          return array('error' => 1 , 'msg' => 'No se encontraron resultados, por favor verifique la informacion a consultar','html' => '');
        }
    }

    public function getMicroExpediente($id){

      $pacientes = new \App\admin\Pacientes;

      $data = $pacientes->getPacientesView($id);

      $config = array();

      $config['titulo'] = "Control de Pacientes";

      $config['cancelar'] = url('/admin/pacientes');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
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

      return view('admin/pacientes/micro', ['data'=>$data, 'config'=>$config]);

    }


}
