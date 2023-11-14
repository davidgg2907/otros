<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Consultas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ConsultasController extends Controller
{
    public $v_fields=array('consultas.cita_id', 'pacientes.nombre', 'medicos.nombre', 'enfermeria.nombre', 'consultas.signos_id', 'consultas.razon_visita', 'consultas.diagnostico', 'consultas.recomendaciones', 'consultas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $consultas = new \App\admin\Consultas;

        $config = array();

        $config['titulo'] = "Registro de Consultas";

        $config['cancelar'] = url('/admin/consultas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de consultas",
            'href' => url('/admin/consultas'),
            'active' => false
        );

        $data = $consultas->getConsultasData($per_page, $request, $sortBy, $order);

        return view('admin/consultas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $consultas = new \App\admin\Consultas;

      $config = array();

      $config['titulo'] = "Registro de Consultas";

      $config['cancelar'] = url('/admin/consultas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de consultas",
          'href' => url('/admin/consultas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar consultas",
          'href' => url('/admin/consultas/add'),
          'active' => true
      );

      $data = new $consultas;
      $general_view = true;

      if($request->input('cita_id') != null) {

        $cita = \App\admin\Citas::find($request->input('cita_id'));

        $data->cita_id      = $request->input('cita_id');
        $data->paciente_id  = $cita->paciente_id;
        $data->medico_id    = $cita->medico_id;

        $general_view = false;

      }

    	return view('admin/consultas/add', ['config'=>$config,'data'=>$data, 'pacientes'=>$consultas->getAll('pacientes'),'medicos'=>$consultas->getAll('medicos'),'enfermeria'=>$consultas->getAll('enfermeria'),'general_view' => $general_view]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' ,
          	 'doctor_id'=> 'required' ,
          	 'razon_visita'=> 'required' ,
          	 'diagnostico'=> 'required'
        ]);

        $consultas  = new \App\admin\Consultas;

        $consulta_id = $consultas->addConsultas($request);

        if($request->input('cita_id')) {

          $citas      = new \App\admin\Citas;

          $citas->updateStatus($request->input('cita_id'),2);

        }

        //Validamos si se prescribieron medicamentos al paciente
        if($request->input('medicamentos') != "") {

          $recetas = new \App\admin\Recetas;

          $receta_id = $recetas->addRecetas($request,$consulta_id);

          $request->session()->flash('recetas', 'true');

          $request->session()->flash('receta_id', $receta_id);

        }

        //Agregamos el pago para liquidacion
        $pagos = new \App\admin\Pagos;

        $data = array(

          'paciente_id'         => $request->input('paciente_id') ,

          'consulta_id'         => $consulta_id,

          'hospitalizacion_id'  => 0,

          'urgencia_id'         => 0,

          'medico_id'           => $request->input('doctor_id') ,

          'enfermera_id'        => $request->input('enfermera_id') ,

          'fecha_apertura'      => date('Y-m-d'),

          'fecha_pago'          => null,

          'servicios'           => null,

          'monto'               => $request->input('costo') ,

          'status'              => 1,

        );

        $pagos->addPagos($data);

        $request->session()->flash('message', 'consultas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');

        return redirect()->action('admin\ConsultasController@index');
    }

    public function getEdit($id=''){

        $consultas = new \App\admin\Consultas;

        $users = $consultas->getAll('consultas');

        $data = $consultas->getConsultas($id);

        $config = array();

        $config['titulo'] = "Registro de Consultas";

        $config['cancelar'] = url('/admin/consultas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de consultas",
            'href' => url('/admin/consultas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar consultas",
            'href' => url('/admin/consultas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/consultas/edit', ['data'=>$data, 'config'=>$config ,'pacientes'=>$consultas->getAll('pacientes'),'medicos'=>$consultas->getAll('medicos'),'enfermeria'=>$consultas->getAll('enfermeria'),'general_view' => true]);
        } else{
          return view('admin/consultas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'paciente_id'=> 'required' ,
          	 'doctor_id'=> 'required' ,
          	 'razon_visita'=> 'required' ,
          	 'diagnostico'=> 'required'
        ]);

        $consultas = new \App\admin\Consultas;
        if($consultas->updateConsultas($request)){
            $request->session()->flash('message', 'consultas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ConsultasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ConsultasController@index');
        }
    }

    public function view($id){

      $consultas = new \App\admin\Consultas;

      $data = $consultas->getConsultasView($id);

      $config = array();

      $config['titulo'] = "Registro de Consultas";

      $config['cancelar'] = url('/admin/consultas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de consultas",
          'href' => url('/admin/consultas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de consultas",
          'href' => url('/admin/consultas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/consultas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/consultas/view');

      }

    }

    public function baja($id){

        $consultas = new \App\admin\Consultas;
        $flag = $consultas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$consultas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ConsultasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ConsultasController@index');
        }
    }

    public function alta($id){
        $consultas = new \App\admin\Consultas;
        $flag = $consultas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$consultas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ConsultasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ConsultasController@index');
        }
    }

    public function getAjax($id){

      $consultas = new \App\admin\Consultas;

      $data = $consultas->getConsultasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getFicha($id){

      $consultas = new \App\admin\Consultas;

      $empresa = \App\admin\Empresas::find(1);

      $data = $consultas->getConsultasView($id);

      $config = array();

      $config['titulo'] = "Registro de Consultas";

      $config['cancelar'] = url('/admin/consultas');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de consultas",
          'href' => url('/admin/consultas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de consultas",
          'href' => url('/admin/consultas/view'),
          'active' => true
      );

      $pdf = PDF::loadView('admin/consultas/ficha', ['data'=>$data, 'config'=>$config,'empresa' => $empresa],
                                                [ 'title' => 'Expediente #' . $data->id, 'margin_top' => 0]);

      return $pdf->stream('consulta' . $data->id . '.pdf');

    }

}
