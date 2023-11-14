<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hospitalizacion;
use DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Session;
use Auth;

class HospitalizacionController extends Controller
{
    public $v_fields=array('medicos.nombre', 'pacientes.nombre', 'cuartos.descripcion', 'hospitalizacion.fecha_ingreso', 'hospitalizacion.fecha_alta', 'hospitalizacion.subtotal', 'hospitalizacion.iva', 'hospitalizacion.total', 'hospitalizacion.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $hospitalizacion = new \App\admin\Hospitalizacion;

        $config = array();

        $config['titulo'] = "Control de Hospitalizacion";

        $config['cancelar'] = url('/admin/hospitalizacion');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de hospitalizacion",
            'href' => url('/admin/hospitalizacion'),
            'active' => false
        );

        $data = $hospitalizacion->getHospitalizacionData($per_page, $request, $sortBy, $order);

        return view('admin/hospitalizacion/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $hospitalizacion = new \App\admin\Hospitalizacion;

      $empresa = \App\admin\Empresas::find(1);

      $config = array();

      $config['titulo'] = "Control de Hospitalizacion";

      $config['cancelar'] = url('/admin/hospitalizacion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de hospitalizacion",
          'href' => url('/admin/hospitalizacion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar hospitalizacion",
          'href' => url('/admin/hospitalizacion/add'),
          'active' => true
      );

      $data = new $hospitalizacion;

    	return view('admin/hospitalizacion/add', ['config'=>$config,

                                                'data'=>$data,

                                                'medicos'=>$hospitalizacion->getAll('medicos'),

                                                'pacientes'=>$hospitalizacion->getAll('pacientes'),

                                                'cuartos'=>$hospitalizacion->getAll('cuartos'),

                                                'empresa' => $empresa
                                               ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'medico_id'=> 'required' ,
          	 'paciente_id'=> 'required' ,
          	 'cuarto_id'=> 'required' ,
        ]);

        //Insertamos la hospitalizacion
        $hospitalizacion = new \App\admin\Hospitalizacion;
        $hospitalizacion->addHospitalizacion($request);

        //Desactivamos la habitacion
        $cuartos = new \App\admin\Cuartos;
        $cuartos->updateStatus($request->input('cuarto_id'),2);

        $request->session()->flash('message', 'hospitalizacion Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\HospitalizacionController@index');
    }

    public function getEdit($id=''){

        $hospitalizacion = new \App\admin\Hospitalizacion;

        $users = $hospitalizacion->getAll('hospitalizacion');

        $data = $hospitalizacion->getHospitalizacion($id);

        $config = array();

        $config['titulo'] = "Control de Hospitalizacion";

        $config['cancelar'] = url('/admin/hospitalizacion');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de hospitalizacion",
            'href' => url('/admin/hospitalizacion'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar hospitalizacion",
            'href' => url('/admin/hospitalizacion/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/hospitalizacion/edit', ['data'=>$data, 'config'=>$config ,'medicos'=>$hospitalizacion->getAll('medicos'),'pacientes'=>$hospitalizacion->getAll('pacientes'),'cuartos'=>$hospitalizacion->getAll('cuartos')]);
        } else{
          return view('admin/hospitalizacion/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
             'medico_id'=> 'required' ,
          	 'paciente_id'=> 'required' ,
          	 'cuarto_id'=> 'required' ,
          	 'fecha_ingreso'=> 'required'
        ]);

        $hospitalizacion = new \App\admin\Hospitalizacion;
        if($hospitalizacion->updateHospitalizacion($request)){
            $request->session()->flash('message', 'hospitalizacion Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\HospitalizacionController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\HospitalizacionController@index');
        }
    }

    public function view($id){

      $hospitalizacion = new \App\admin\Hospitalizacion;

      $data = $hospitalizacion->getHospitalizacionView($id);

      $empresa = \App\admin\Empresas::find(1);

      $config = array();

      $config['titulo'] = "Control de Hospitalizacion";

      $config['cancelar'] = url('/admin/hospitalizacion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Hospitalizacion",
          'href' => url('/admin/hospitalizacion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Servicios",
          'href' => url('/admin/hospitalizacion/view'),
          'active' => true
      );

      if(count($data)){

        $servicios = $hospitalizacion->getServicios($id);

        return view('admin/hospitalizacion/ficha', ['data'=>$data, 'config'=>$config,'servicios' => $servicios,'empresa' => $empresa,'productos' => $hospitalizacion->getAll('productos')]);

      } else{

        return view('admin/hospitalizacion/ficha');

      }

    }

    public function baja($id){

        $hospitalizacion = new \App\admin\Hospitalizacion;
        $flag = $hospitalizacion->updateStatus($id,0);
        if($flag){
          $data = $hospitalizacion->getHospitalizacionView($id);
          $cuartos = new \App\admin\Cuartos;
          $cuartos->updateStatus($data->cuarto_id,1);
          Session::flash('message', '$hospitalizacion deshabilitado correctamente!');
          Session::flash('exito', 'true');
          return redirect()->action('admin\HospitalizacionController@index');
        } else{
          Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
          Session::flash('fracaso', 'true');
          return redirect()->action('admin\HospitalizacionController@index');
        }
    }

    public function bajaServicio($id){

        $hospitalizacion = new \App\admin\Hospitalizacion;

        $flag = $hospitalizacion->bajaServicio($id);

        if($flag){
          return array('error' => 0, 'msg' => '');
        } else{
          return array('error' => 1, 'msg' => 'Se ha producido un error inesperado, no se puede dar de baja este servicio');
        }
    }

    public function alta($id){

        $hospitalizacion = new \App\admin\Hospitalizacion;

        $data = $hospitalizacion->getHospitalizacion($id);

        //Damos de alta al aciente
        $flag = $hospitalizacion->updateStatus($id,2);

        //liberamos la habitacion
        $cuartos = new \App\admin\Cuartos;
        $cuartos->updateStatus($data->cuarto_id,1);

        if($flag){

          //Calculamos los dias de hospedaje del paciente

          //obtenemos el total de los servicios
          $servicios = $data->total;

          //calculamos el total a pagar por servicio de cuarto
          $cDate = Carbon::parse($data->fecha_ingreso);

          $dias_hospedaje = Carbon::parse(Carbon::now())->diffInDays(date('Y-m-d H:i:s',strtotime($data->fecha_ingreso)));

          $total_hospedaje = $data->habitacion->costo_dia * $dias_hospedaje;

          $subtotal = $servicios + $total_hospedaje;

          $iva = $subtotal * 0.16;

          $total = $subtotal + $iva;

          Session::flash('message', '$hospitalizacion habilitado correctamente!');
          Session::flash('exito', 'true');
          return redirect()->action('admin\HospitalizacionController@index');

        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\HospitalizacionController@index');
        }
    }

    public function getAjax($id){

      $hospitalizacion = new \App\admin\Hospitalizacion;

      $data = $hospitalizacion->getHospitalizacionView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getServicios($id) {

      $hospitalizacion = new \App\admin\Hospitalizacion;
      $productos = new \App\admin\Productos;

      $data = $hospitalizacion->getHospitalizacionView($id);

      $empresa = \App\admin\Empresas::find(1);

      $config = array();

      $config['titulo'] = "Control de Hospitalizacion";

      $config['cancelar'] = url('/admin/hospitalizacion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Hospitalizacion",
          'href' => url('/admin/hospitalizacion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Servicios",
          'href' => url('/admin/hospitalizacion/view'),
          'active' => true
      );

      if(count($data)){

        $servicios = $hospitalizacion->getServicios($id);

        return view('admin/hospitalizacion/view', ['data'=>$data, 'config'=>$config,'servicios' => $servicios,'empresa' => $empresa,'productos' => $productos->getByScope(1)]);

      } else{

        return view('admin/hospitalizacion/view');

      }


    }

    public function postServicios(Request $request) {

      $hospitalizacion = new \App\admin\Hospitalizacion;

      $hospitalizacion->addServicios($request);

      $hospitalizacion->actualizaTotales($request);

      Session::flash('message', 'Servicios anexados exitosamente ');
      Session::flash('exito', 'true');
      return redirect('admin/hospitalizacion/servicios/' . $request->input('hospitalizacion_id'));
    }

    public function postAbonar($id,Request $request) {

      $hospitalizacion = new \App\admin\Hospitalizacion;

      $hospitalizacion->abonarAcuenta($id,$request);

      //Insertamos el pago como aplicado
      $info = $hospitalizacion->getHospitalizacion($id);

      //liberamos la habitacion
      $cuartos = new \App\admin\Cuartos;
      $cuartos->updateStatus($info->cuarto_id,1);

      $pagos = new \App\admin\Pagos;

      $data = array(

        'paciente_id'         => $info->paciente_id,

        'consulta_id'         => 0,

        'hospitalizacion_id'  => $id,

        'urgencia_id'         => 0,

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
            $hospitalizacion->liquidaServicio($value,$pago_id);
        }

      }


      Session::flash('message', 'Abono cargado exitosamente, su nuevo saldo es: ' . number_format($request->input('pendiente'),2,".",","));
      Session::flash('exito', 'true');

      return redirect('admin/hospitalizacion/servicios/' . $id);
    }

    public function getFicha($id,Request $request){

      $hospitalizacion = new \App\admin\Hospitalizacion;

      $empresa = \App\admin\Empresas::find(1);

      $data = $hospitalizacion->getHospitalizacionView($id);

      $config = array();

      $config['titulo'] = "Control de Hospitalizacion";

      $config['cancelar'] = url('/admin/hospitalizacion');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de hospitalizacion",
          'href' => url('/admin/hospitalizacion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de hospitalizacion",
          'href' => url('/admin/hospitalizacion/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/hospitalizacion/view', ['data'=>$data, 'config'=>$config,'empresa' => $empresa]);

      } else{

        return view('admin/hospitalizacion/view');

      }

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
