<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Citas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class CitasController extends Controller
{
    public $v_fields=array('pacientes.nombre', 'consultorios.id', 'medicos.nombre', 'enfermeria.nombre', 'citas.fecha', 'citas.hora', 'citas.comentarios', 'citas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $citas = new \App\admin\Citas;

        $config = array();

        $config['titulo'] = "Control de Citas";

        $config['cancelar'] = url('/admin/citas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de citas",
            'href' => url('/admin/citas'),
            'active' => false
        );

        $full     = true;
        $visible  = true;
        $multiple = false;

        if(Auth::user()->medico_id != 0) {

          $doctores = Auth::user()->medico_id;
          $visible  = false;
          $multiple = false;
          $full     = false;

        }

        if(Auth::user()->asistente_id != 0) {

          $asistente = \App\admin\Asistentes::find(Auth::user()->asistente_id);

          $doctores = explode(',',$asistente->doctores);
          $visible  = true;
          $multiple = true;
          $full     = false;

        }


        $data = $citas->getCitasData($per_page, $request, $sortBy, $order);

        return view('admin/citas/index', ['data'      =>$data->appends(Input::except('page')),

                                          'per_page'  =>$per_page,

                                          'links'     =>$links,

                                          'config'    =>$config,

                                          'query'     =>$_SERVER['QUERY_STRING'],

                                          'pacientes' => $citas->getAll('pacientes'),

                                          'medicos'   => $citas->getAll('medicos'),

                                          'visible'   => $visible,

                                          'multiple'  => $multiple,

                                          'full'      => $full,

                                          'doctores'  => $doctores

                                        ]);
    }

    public function getAdd(Request $request){

      $citas = new \App\admin\Citas;

      $config = array();

      $config['titulo'] = "Control de Citas";

      $config['cancelar'] = url('/admin/citas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de citas",
          'href' => url('/admin/citas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar citas",
          'href' => url('/admin/citas/add'),
          'active' => true
      );

      $data = new $citas;

    	return view('admin/citas/add', ['config'=>$config,'data'=>$data, 'pacientes'=>$citas->getAll('pacientes'),'consultorios'=>$citas->getAll('consultorios'),'medicos'=>$citas->getAll('medicos'),'enfermeria'=>$citas->getAll('enfermeria')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $citas = new \App\admin\Citas;
        $citas->addCitas($request);

        //validamos si el paciente esta asignado a un medico
        $data = DB::table('pacientes_asignacion')
                  ->where('medico_id',$request->input('medico_id'))
                  ->where( 'paciente_id',$request->input('medico_id'))
                  ->get();

        if(!count($data)) {

          DB::table('pacientes_asignacion')->insert([

            'medico_id'         => $request->input('medico_id'),

            'paciente_id'       => $request->input('paciente_id'),

            'fecha_asignacion'  => date('Y-m-d H:i:s'),

            'status'            => 1

          ]);

        }


        $request->session()->flash('message', 'citas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\CitasController@index');
    }

    public function getEdit($id=''){

        $citas = new \App\admin\Citas;

        $users = $citas->getAll('citas');

        $data = $citas->getCitas($id);

        $config = array();

        $config['titulo'] = "Control de Citas";

        $config['cancelar'] = url('/admin/citas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de citas",
            'href' => url('/admin/citas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar citas",
            'href' => url('/admin/citas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/citas/edit', ['data'=>$data, 'config'=>$config ,'pacientes'=>$citas->getAll('pacientes'),'consultorios'=>$citas->getAll('consultorios'),'medicos'=>$citas->getAll('medicos'),'enfermeria'=>$citas->getAll('enfermeria')]);
        } else{
          return view('admin/citas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $citas = new \App\admin\Citas;
        if($citas->updateCitas($request)){
            $request->session()->flash('message', 'citas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\CitasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\CitasController@index');
        }
    }

    public function view($id){

      $citas = new \App\admin\Citas;

      $data = $citas->getCitasView($id);

      $config = array();

      $config['titulo'] = "Control de Citas";

      $config['cancelar'] = url('/admin/citas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de citas",
          'href' => url('/admin/citas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de citas",
          'href' => url('/admin/citas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/citas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/citas/view');

      }

    }

    public function baja($id){

        $citas = new \App\admin\Citas;
        $flag = $citas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$citas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CitasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CitasController@index');
        }
    }

    public function alta($id){
        $citas = new \App\admin\Citas;
        $flag = $citas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$citas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CitasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CitasController@index');
        }
    }

    public function getAjax($id){

      $citas = new \App\admin\Citas;

      $data = $citas->getCitasView($id);

      if(count($data)){

        $img_paciente = "paciente.jpg";
        $img_medico   = "medico.jpg";

        if($data->paciente->fotografia) {

          $img_paciente = asset('uploads/pacientes/' . $data->paciente->fotografia);

        } else {

          $img_paciente = asset('uploads/paciente.jpeg');

        }

        if($data->medico->fotografia) {

          $img_medico = asset('uploads/medicos/' . $data->medico->fotografia);

        } else {

          $img_medico = asset('uploads/paciente.jpeg');

        }

        $return = array(

          'paciente'    => '<img src="' . $img_paciente . '" class="col-md-4">
                            <h4 class="col-md-8">' . $data->paciente->nombre . '</h4>',

          'medico'      => '<img src="' . $img_medico . '" class="col-md-4">
                            <h4 class="col-md-8">' . $data->medico->nombre . '</h4>',

          'especialidad' => $data->medico->especialidad,

          'consultorio' => 0,

          'fecha'       => $data->fecha,

          'hora'        => $data->hora,

          'comentario'  => $data->comentarios
        );

        return array('error' =>0, 'msg' => '','data' => $return);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
