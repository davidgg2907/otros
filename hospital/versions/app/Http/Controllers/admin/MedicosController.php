<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medicos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class MedicosController extends Controller
{
    public $v_fields=array('medicos.nombre', 'medicos.especialidad', 'medicos.celular', 'medicos.rfc', 'medicos.cedula', 'medicos.curp', 'medicos.honorarios', 'medicos.domicilio', 'medicos.fotografia', 'medicos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $medicos = new \App\admin\Medicos;

        $config = array();

        $config['titulo'] = "Adminsitracion de Doctores";

        $config['cancelar'] = url('/admin/medicos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de medicos",
            'href' => url('/admin/medicos'),
            'active' => false
        );

        $data = $medicos->getMedicosData($per_page, $request, $sortBy, $order);

        return view('admin/medicos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $medicos = new \App\admin\Medicos;

      $usuarios = new \App\admin\Users;

      $config = array();

      $config['titulo'] = "Adminsitracion de Doctores";

      $config['cancelar'] = url('/admin/medicos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de medicos",
          'href' => url('/admin/medicos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar medicos",
          'href' => url('/admin/medicos/add'),
          'active' => true
      );

      $data = new $medicos;

      $user = new $usuarios();

    	return view('admin/medicos/add', ['config'=>$config,'data'=>$data, 'roles' => $medicos->getAll('roles'), 'user' => $user]);

    }

    public function postAdd(Request $request){

        $this->validate($request, [
         'nombre'=> 'required' ,
      	 'especialidad'=> 'required' ,
      	 'celular'=> 'required' ,
         'password' => 'required|min:6|confirmed',
         'rol_id' => 'required',
      	 'status'=> 'required'
        ]);

        $medicos  = new \App\admin\Medicos;
        $usuarios = new \App\admin\Users;

        $medico_id = $medicos->addMedicos($request);

        //Creamos el usuario
        $data = array(

          'rol_id'        => $request->input('rol_id'),

          'asistente_id'  => 0,

          'medico_id'     => $medico_id,

          'enfermera_id'  => 0,

          'paciente_id'   => 0,

          'name'          => $request->input('nombre'),

          'email'         => $request->input('email'),

          'password'      =>  $request->input('password'),

        );

        $usuarios->createUser($data);

        $request->session()->flash('message', 'medicos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\MedicosController@index');
    }

    public function getEdit($id=''){

        $medicos = new \App\admin\Medicos;
        $usuarios = new \App\admin\Users;


        $users = $medicos->getAll('medicos');

        $data = $medicos->getMedicos($id);

        $config = array();

        $config['titulo'] = "Adminsitracion de Doctores";

        $config['cancelar'] = url('/admin/medicos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de medicos",
            'href' => url('/admin/medicos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar medicos",
            'href' => url('/admin/medicos/edit'),
            'active' => true
        );

        if(count($data)){

          $usuario = \App\admin\Users::where('medico_id',$id)->get();

          if(count($usuario)) {
            $user = $usuario[0];
          } else {
            $user = new $usuarios;
          }

          return view('admin/medicos/edit', ['data'=>$data, 'config'=>$config ,'user' => $user,'roles' => $medicos->getAll('roles')]);
        } else{
          return view('admin/medicos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'nombre'=> 'required' ,
          	 'especialidad'=> 'required' ,
          	 'celular'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $medicos = new \App\admin\Medicos;
        $usuarios = new \App\admin\Users;

        if($medicos->updateMedicos($request)){

          //Creamos el usuario
          $data = array(

            'id'            => $request->input('user_id'),

            'rol_id'        => $request->input('rol_id'),

            'asistente_id'  => 0,

            'medico_id'     => $request->input('id'),

            'enfermera_id'  => 0,

            'paciente_id'   => 0,

            'name'          => $request->input('nombre'),

            'email'         => $request->input('email'),

            'password'      =>  $request->input('password'),

          );

          $usuarios->updateUser($data);


            $request->session()->flash('message', 'medicos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\MedicosController@index');

        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\MedicosController@index');
        }
    }

    public function view($id){

      $medicos = new \App\admin\Medicos;

      $data = $medicos->getMedicosView($id);

      $config = array();

      $config['titulo'] = "Adminsitracion de Doctores";

      $config['cancelar'] = url('/admin/medicos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de medicos",
          'href' => url('/admin/medicos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de medicos",
          'href' => url('/admin/medicos/view'),
          'active' => true
      );

      if(count($data)){

        $consultorios   = $medicos->misConsultorios($id);

        $consultas      = $medicos->misConsultas($id);

        $citas          = $medicos->misCitas($id);

        $pacientes      = $medicos->misPacientes($id);

        return view('admin/medicos/view', ['data'=>$data,

                                           'config'=>$config,

                                           'consultorios'=>$consultorios,

                                           'consultas'=>$consultas,

                                           'citas'=>$citas,

                                           'pacientes'=>$pacientes,
                                          ]);

      } else{

        return view('admin/medicos/view');

      }

    }

    public function baja($id){

        $medicos = new \App\admin\Medicos;
        $flag = $medicos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$medicos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\MedicosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\MedicosController@index');
        }
    }

    public function alta($id){
        $medicos = new \App\admin\Medicos;
        $flag = $medicos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$medicos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\MedicosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\MedicosController@index');
        }
    }

    public function getAjax($id){

      $medicos = new \App\admin\Medicos;

      $data = $medicos->getMedicosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getSearch(Request $request){

        // pagination per page
        $per_page = 100;
        // get by modal
        $medicos = new \App\admin\Medicos;

        $data = $medicos->getMedicosData($per_page, $request, 'id', 'ASC');

        if(count($data)) {

          $html = "";

          foreach($data as $value) {

            $html .= '<tr>
                         <td>' . $value->nombre . '</td>
                         <td>' . $value->especialidad . '</td>
                         <td>' . $value->cedula . '</td>
                         <td>' . $value->celular . '</td>
                         <td>
                           <button type="button" title="Seleccionar Medico" class="btn btn-primary" id="btnMedSelect" onclick="seleccionaMedico(' . $value->id . ',\'' . $value->nombre . '\')"> <li class="fa fa-check-circle fa-lg"></li></button>
                         </td>
                     </tr>';
          }

          return array('error' => 0, 'msg' => '','html' => $html);

        } else {
          return array('error' => 1 , 'msg' => 'No se encontraron resultados, por favor verifique la informacion a consultar','html' => '');
        }

    }

}
