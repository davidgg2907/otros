<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pagos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class PagosController extends Controller
{
    public $v_fields=array('pacientes.nombre', 'consultas.fecha', 'hospitalizacion.fecha_ingreso', 'medicos.nombre', 'enfermeria.nombre', 'pagos.fecha_apertura', 'pagos.fecha_pago', 'pagos.monto', 'pagos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $pagos = new \App\admin\Pagos;

        $config = array();

        $config['titulo'] = "Aplicacion de pagos";

        $config['cancelar'] = url('/admin/pagos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de pagos",
            'href' => url('/admin/pagos'),
            'active' => false
        );

        $data = $pagos->getPagosData($per_page, $request, $sortBy, $order);

        return view('admin/pagos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $pagos = new \App\admin\Pagos;

      $config = array();

      $config['titulo'] = "Aplicacion de pagos";

      $config['cancelar'] = url('/admin/pagos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de pagos",
          'href' => url('/admin/pagos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar pagos",
          'href' => url('/admin/pagos/add'),
          'active' => true
      );

      $data = new $pagos;

    	return view('admin/pagos/add', ['config'=>$config,'data'=>$data, 'pacientes'=>$pagos->getAll('pacientes'),'consultas'=>$pagos->getAll('consultas'),'hospitalizacion'=>$pagos->getAll('hospitalizacion'),'medicos'=>$pagos->getAll('medicos'),'enfermeria'=>$pagos->getAll('enfermeria')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
             'monto'=> 'required' ,
          	 'status'=> 'required'
        ]);

        $pagos = new \App\admin\Pagos;
        $pagos->addPagos($request);
        $request->session()->flash('message', 'pagos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\PagosController@index');
    }

    public function getEdit($id=''){

        $pagos = new \App\admin\Pagos;

        $users = $pagos->getAll('pagos');

        $data = $pagos->getPagos($id);

        $config = array();

        $config['titulo'] = "Aplicacion de pagos";

        $config['cancelar'] = url('/admin/pagos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de pagos",
            'href' => url('/admin/pagos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar pagos",
            'href' => url('/admin/pagos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/pagos/edit', ['data'=>$data, 'config'=>$config ,'pacientes'=>$pagos->getAll('pacientes'),'consultas'=>$pagos->getAll('consultas'),'hospitalizacion'=>$pagos->getAll('hospitalizacion'),'medicos'=>$pagos->getAll('medicos'),'enfermeria'=>$pagos->getAll('enfermeria')]);
        } else{
          return view('admin/pagos/edit');
        }
    }

    public function postEdit(Request $request){

        $pagos = new \App\admin\Pagos;
        if($pagos->updatePagos($request)){
            $request->session()->flash('message', 'pagos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            $request->session()->flash('pago_id', $request->input('id'));
            return redirect()->action('admin\PagosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\PagosController@index');
        }
    }

    public function view($id){

      $pagos = new \App\admin\Pagos;

      $empresa = \App\admin\Empresas::find(1);

      $data = $pagos->getPagosView($id);

      //return view('admin/pagos/voucher', ['data'=>$data, 'config'=>$config,'empresa' => $empresa]);

      $pdf = PDF::loadView('admin/pagos/voucher', ['data'=>$data, 'config'=>$config,'empresa' => $empresa],
                                                [ 'title' => 'Vooucher #' . $data->id, 'margin_top' => 0]);

      return $pdf->stream('voucher' . $data->id . '.pdf');

    }

    public function baja($id){

        $pagos = new \App\admin\Pagos;
        $flag = $pagos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$pagos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PagosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PagosController@index');
        }
    }

    public function alta($id){
        $pagos = new \App\admin\Pagos;
        $flag = $pagos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$pagos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PagosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PagosController@index');
        }
    }

    public function pagado($id){

        $pagos = new \App\admin\Pagos;
        $flag = $pagos->updateStatus($id,2);
        if($flag){
            Session::flash('message', 'El pago ha sido aplicado exitosamente');
            Session::flash('exito', 'true');
            return redirect()->action('admin\PagosController@index');
        } else{
            Session::flash('message', 'Se ha producido un error inesperado en el sistema, por favor contacte al adminsitrador de sistemas');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\PagosController@index');
        }
    }

    public function getAjax($id){

      $pagos = new \App\admin\Pagos;

      $record = $pagos->getPagosView($id);

      if(count($record)){

        $html = '';

        if($record->consulta_id != 0) {

          $html = '<div class="row">
                    <div class="col-md-5" id="paciente"><h4 class="text-center">' . $record->consulta->paciente->nombre. '</h4></div>
                    <div class="col-md-2"> <li class="fa fa-arrow-right fa-2x"></li> </div>
                    <div class="col-md-5" id="medico"><h4>' . $record->consulta->doctor->nombre. '</h4></div>

                    <div class="col-md-12"><hr/></div>

                    <div class="col-md-12"> Consulta: ' . $record->consulta->fecha . '</div>

                  </div>';
        }



        if($record->hospitalizacion_id != 0) {

          $html = '<div class="row">
                    <div class="col-md-5" id="paciente"><h4 class="text-center">' . $record->hospitalizacion->paciente->nombre. '</h4></div>
                    <div class="col-md-2"> <li class="fa fa-arrow-right fa-2x"></li> </div>
                    <div class="col-md-5" id="medico"><h4>' . $record->hospitalizacion->doctor->nombre. '</h4></div>

                    <div class="col-md-12"><hr/></div>

                    <div class="col-md-12"> Hospitalizacion del ' . $record->hospitalizacion->fecha_ingreso . ' al ' .  $record->hospitalizacion->fecha_alta . '  </div>

                  </div>';

          $html .= '<div class="row"> <div class="col-md-12"><hr/></div> </div>';

          $html .= '<div class="row"> <p><br/><p>';

          $html .= '<table class="table">
                      <thead>
                        <tr>
                          <th>Concepto</th>
                          <th class="text-center">Cantidad</th>
                          <th class="text-center">Precio</th>
                          <th class="text-center">Importe</th>
                          <th></th>
                        </tr>
                      </thead>';

          //traemos los servicios generados por el
          foreach($record->hospitalizacion->getServicios($record->hospitalizacion_id) as $value) {

            $html .= '<tr>
                      <td>' . $value->descripcion . '</td>
                      <td class="text-center">' . $value->cantidad . '</td>
                      <td class="text-center"> $' . number_format($value->precio,2,".",",") . '</td>
                      <td class="text-center"> $' . number_format($value->importe,2,".",",") . '</td>
                      <td></td>
                    </tr>';
          }

            $html .= '</table>';
          $html .= '</div>';
        }

        $data = array(

          'pago_id' => $record->id,

          'monto'   => $record->monto,

          'status'  =>  $record->status,

          'html'    => $html,

        );

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
