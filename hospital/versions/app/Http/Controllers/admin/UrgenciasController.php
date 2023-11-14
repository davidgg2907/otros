<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Urgencias;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class UrgenciasController extends Controller
{
    public $v_fields=array('urgencias.medico_id', 'urgencias.fecha', 'urgencias.hora', 'urgencias.paciente', 'urgencias.edad', 'urgencias.peso', 'urgencias.talla', 'urgencias.motivo', 'urgencias.padecimiento', 'urgencias.heredo_diabetes', 'urgencias.heredo_hipertencion', 'urgencias.heredo_cancer', 'urgencias.heredo_convulsiones', 'urgencias.heredo_lar', 'urgencias.heredo_leulin', 'urgencias.patolo_diabetes', 'urgencias.patolo_hipertencion', 'urgencias.patolo_cancer', 'urgencias.patolo_otros', 'urgencias.operaciones', 'urgencias.transfuciones', 'urgencias.fracturas', 'urgencias.alergias', 'urgencias.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $urgencias = new \App\admin\Urgencias;

        $config = array();

        $config['titulo'] = "Ingresos a Urgencias";

        $config['cancelar'] = url('/admin/urgencias');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de urgencias",
            'href' => url('/admin/urgencias'),
            'active' => false
        );

        $data = $urgencias->getUrgenciasData($per_page, $request, $sortBy, $order);

        return view('admin/urgencias/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $urgencias = new \App\admin\Urgencias;

      $config = array();

      $config['titulo'] = "Ingresos a Urgencias";

      $config['cancelar'] = url('/admin/urgencias');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de urgencias",
          'href' => url('/admin/urgencias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar urgencias",
          'href' => url('/admin/urgencias/add'),
          'active' => true
      );

      $data = new $urgencias;

    	return view('admin/urgencias/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'medico_id'=> 'required' ,
          	 'fecha'=> 'required' ,
          	 'hora'=> 'required' ,
          	 'paciente'=> 'required' ,
          	 'edad'=> 'required' ,
          	 'peso'=> 'required' ,
          	 'talla'=> 'required' ,
          	 'motivo'=> 'required' ,
          	 'padecimiento'=> 'required' ,
          	 'heredo_diabetes'=> 'required' ,
          	 'heredo_hipertencion'=> 'required' ,
          	 'heredo_cancer'=> 'required' ,
          	 'heredo_convulsiones'=> 'required' ,
          	 'heredo_lar'=> 'required' ,
          	 'heredo_leulin'=> 'required' ,
          	 'patolo_diabetes'=> 'required' ,
          	 'patolo_hipertencion'=> 'required' ,
          	 'patolo_cancer'=> 'required' ,
          	 'patolo_otros'=> 'required' ,
          	 'operaciones'=> 'required' ,
          	 'transfuciones'=> 'required' ,
          	 'fracturas'=> 'required' ,
          	 'alergias'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $urgencias = new \App\admin\Urgencias;
        $urgencias->addUrgencias($request);
        $request->session()->flash('message', 'urgencias Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\UrgenciasController@index');
    }

    public function getEdit($id=''){

        $urgencias = new \App\admin\Urgencias;

        $users = $urgencias->getAll('urgencias');

        $data = $urgencias->getUrgencias($id);

        $config = array();

        $config['titulo'] = "Ingresos a Urgencias";

        $config['cancelar'] = url('/admin/urgencias');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de urgencias",
            'href' => url('/admin/urgencias'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar urgencias",
            'href' => url('/admin/urgencias/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/urgencias/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/urgencias/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'medico_id'=> 'required' ,
          	 'fecha'=> 'required' ,
          	 'hora'=> 'required' ,
          	 'paciente'=> 'required' ,
          	 'edad'=> 'required' ,
          	 'peso'=> 'required' ,
          	 'talla'=> 'required' ,
          	 'motivo'=> 'required' ,
          	 'padecimiento'=> 'required' ,
          	 'heredo_diabetes'=> 'required' ,
          	 'heredo_hipertencion'=> 'required' ,
          	 'heredo_cancer'=> 'required' ,
          	 'heredo_convulsiones'=> 'required' ,
          	 'heredo_lar'=> 'required' ,
          	 'heredo_leulin'=> 'required' ,
          	 'patolo_diabetes'=> 'required' ,
          	 'patolo_hipertencion'=> 'required' ,
          	 'patolo_cancer'=> 'required' ,
          	 'patolo_otros'=> 'required' ,
          	 'operaciones'=> 'required' ,
          	 'transfuciones'=> 'required' ,
          	 'fracturas'=> 'required' ,
          	 'alergias'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $urgencias = new \App\admin\Urgencias;
        if($urgencias->updateUrgencias($request)){
            $request->session()->flash('message', 'urgencias Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\UrgenciasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\UrgenciasController@index');
        }
    }

    public function view($id){

      $urgencias = new \App\admin\Urgencias;

      $data = $urgencias->getUrgenciasView($id);

      $config = array();

      $config['titulo'] = "Ingresos a Urgencias";

      $config['cancelar'] = url('/admin/urgencias');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de urgencias",
          'href' => url('/admin/urgencias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de urgencias",
          'href' => url('/admin/urgencias/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/urgencias/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/urgencias/view');

      }

    }

    public function getFicha($id){

      $urgencias = new \App\admin\Urgencias;

      $data = $urgencias->getUrgenciasView($id);

      $empresa   = \App\admin\Empresas::find(1);

      $config = array();

      $config['titulo'] = "Ingresos a Urgencias";

      $config['cancelar'] = url('/admin/urgencias');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de urgencias",
          'href' => url('/admin/urgencias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de urgencias",
          'href' => url('/admin/urgencias/view'),
          'active' => true
      );


      //return view('admin/urgencias/ficha', ['data'=>$data, 'config'=>$config]);
      $pdf = PDF::loadView('admin/urgencias/ficha', ['data'=>$data, 'config'=>$config,'empresa' => $empresa],
                                                [ 'title' => 'Ficha de Urgencia #' . $data->id, 'margin_top' => 0]);

  		return $pdf->stream('FichaUrgencia' . $data->id . '.pdf');
    }

    public function baja($id){

        $urgencias = new \App\admin\Urgencias;
        $flag = $urgencias->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$urgencias deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\UrgenciasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\UrgenciasController@index');
        }
    }

    public function alta($id){
        $urgencias = new \App\admin\Urgencias;
        $flag = $urgencias->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$urgencias habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\UrgenciasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\UrgenciasController@index');
        }
    }

    public function getAjax($id){

      $urgencias = new \App\admin\Urgencias;

      $data = $urgencias->getUrgenciasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getServicios($id) {

      $urgencias = new \App\admin\Urgencias;
      $productos = new \App\admin\Productos;

      $data = $urgencias->getUrgenciasView($id);

      $empresa = \App\admin\Empresas::find(1);

      $config = array();

      $config['titulo'] = "Control de Hospitalizacion";

      $config['cancelar'] = url('/admin/urgencias');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Hospitalizacion",
          'href' => url('/admin/urgencias'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Servicios",
          'active' => true,
          'href' => url('/admin/urgencias/servicios'),
      );

      if(count($data)){

        $servicios = $urgencias->getServicios($id);

        return view('admin/urgencias/servicios', ['data'=>$data, 'config'=>$config,'servicios' => $servicios,'empresa' => $empresa,'productos' => $productos->getByScope(2)]);

      } else{

        return view('admin/urgencias/servicios');

      }


    }

    public function postServicios(Request $request) {

      $urgencias = new \App\admin\Urgencias;

      $urgencias->addServicios($request);

      $urgencias->actualizaTotales($request);

      Session::flash('message', 'Servicios anexados exitosamente ');
      Session::flash('exito', 'true');
      return redirect('admin/urgencias/servicios/' . $request->input('urgencia_id'));
    }

    public function postAbonar($id,Request $request) {

      $urgencias = new \App\admin\Urgencias;

      $urgencias->abonarAcuenta($id,$request);

      //Insertamos el pago como aplicado
      $info = $urgencias->getUrgencias($id);

      //liberamos la habitacion
      $cuartos = new \App\admin\Cuartos;

      $cuartos->updateStatus($info->cuarto_id,1);

      $pagos = new \App\admin\Pagos;

      $data = array(

        'paciente_id'         => "0",

        'consulta_id'         => 0,

        'hospitalizacion_id'  => 0,

        'urgencia_id'         => $id,

        'medico_id'           => $info->medico_id,

        'enfermera_id'        => 0,

        'fecha_apertura'      => date('Y-m-d'),

        'fecha_pago'          => date('Y-m-d'),

        'servicios'           => substr($request->input('servicios'),0,strlen($request->input('servicios')) -1),

        'monto'               => $request->input('abono') ,

        'status'              => 2,

      );

      $pago_id = $pagos->addPagos($data);

      $servs = explode(',',$request->input('servicios'));

      foreach($servs as $value) {

        if($value != "") {
            $urgencias->liquidaServicio($value,$pago_id);
        }

      }


      Session::flash('message', 'Abono cargado exitosamente, su nuevo saldo es: ' . number_format($request->input('pendiente'),2,".",","));
      Session::flash('exito', 'true');

      return redirect('admin/urgencias/servicios/' . $id);
    }

    public function getFechas(Request $request) {

      $html = "";

      $desde = date('Y-m-d',strtotime($request->input('desde')));

      $hasta = date('Y-m-d',strtotime($request->input('hasta')));

      $fecha = $desde;
      while($fecha < $hasta) {

        $fecha = date('Y-m-d',strtotime($fecha . ' + 1 days'));
      }

    }

}
