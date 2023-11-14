<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cajas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class CajasController extends Controller
{
    public $v_fields=array('cajas.user_id', 'cajas.inicia', 'cajas.termina', 'cajas.monto_inicial', 'cajas.monto_final', 'cajas.ventas', 'cajas.cancelaciones', 'cajas.temporizadores', 'cajas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $cajas = new \App\admin\Cajas;

        $config = array();

        $config['titulo'] = "cajas";

        $config['cancelar'] = url('/admin/cajas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de cajas",
            'href' => url('/admin/cajas'),
            'active' => false
        );

        $data = $cajas->getCajasData($per_page, $request, $sortBy, $order);

        return view('admin/cajas/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $cajas = new \App\admin\Cajas;

      $config = array();

      $config['titulo'] = "cajas";

      $config['cancelar'] = url('/admin/cajas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de cajas",
          'href' => url('/admin/cajas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar cajas",
          'href' => url('/admin/cajas/add'),
          'active' => true
      );

      $data = new $cajas;

    	return view('admin/cajas/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $cajas = new \App\admin\Cajas;
        $cajas->addCajas($request);
        $request->session()->flash('message', 'cajas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\CajasController@index');
    }

    public function getEdit($id=''){

        $cajas = new \App\admin\Cajas;

        $users = $cajas->getAll('cajas');

        $data = $cajas->getCajas($id);

        $config = array();

        $config['titulo'] = "cajas";

        $config['cancelar'] = url('/admin/cajas');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de cajas",
            'href' => url('/admin/cajas'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar cajas",
            'href' => url('/admin/cajas/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/cajas/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/cajas/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $cajas = new \App\admin\Cajas;
        if($cajas->updateCajas($request)){
            $request->session()->flash('message', 'cajas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\CajasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\CajasController@index');
        }
    }

    public function view($id){

      $cajas = new \App\admin\Cajas;

      $data = $cajas->getCajasView($id);

      $config = array();

      $config['titulo'] = "cajas";

      $config['cancelar'] = url('/admin/cajas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de cajas",
          'href' => url('/admin/cajas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de cajas",
          'href' => url('/admin/cajas/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/cajas/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/cajas/view');

      }

    }

    public function baja($id){

        $cajas = new \App\admin\Cajas;
        $flag = $cajas->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$cajas deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CajasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CajasController@index');
        }
    }

    public function alta($id){
        $cajas = new \App\admin\Cajas;
        $flag = $cajas->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$cajas habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CajasController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CajasController@index');
        }
    }

    public function getAjax($id, Request $request){

      if($id == 0) {

        $cajas = new \App\admin\Cajas;
        $cajas->user_id          = Auth::user()->id;
      	$cajas->inicia           = date('Y-m-d g:i:s');
      	$cajas->termina          = null;
      	$cajas->monto_inicial    = $request->input('inicial');
      	$cajas->monto_final      = 0;
      	$cajas->ventas           = 0;
      	$cajas->cancelaciones    = 0;
      	$cajas->temporizadores   = 0;
      	$cajas->status           = 1;
        $cajas->save();

        return array('error' =>0, 'msg' => '','data' => $cajas);

      } else {

        $cajas = \App\admin\Cajas::find($id);

        $efectivo_recibido = \App\admin\Efectivo::where('tipo','I')->where('status',1)->where('caja_id',$id)->sum('importe');
        $efectivo_retirado = \App\admin\Efectivo::where('tipo','E')->where('status',1)->where('caja_id',$id)->sum('importe');

        $efectivo_vtas = \App\admin\Ventas::where('caja_id',$id)->where('status',1)->where('metodo_pago','Efectivo')->sum('totald');

        $total_efectivo = ($cajas->monto_inicial + $efectivo_recibido + $efectivo_vtas) - $efectivo_retirado;

        $cajas->termina        = date('Y-m-d g:i:s');
        $cajas->monto_final    = $request->input('final');
        $cajas->status         = 2;

        if($request->input('final') == $total_efectivo) {
          $cajas->cuadrado = 1;
          $return =  array('error' =>0, 'msg' => '','data' => $data);

        } else {
          $cajas->cuadrado = 0;
          $return =  array('error' =>0, 'msg' => 'El monto de cierre ingresado no coincide con el total de flujo de efectivo generado, El administrador generar arqueo de caja','data' => array());
        }
        $cajas->save();
      }

      return $return;
    }

    public function getExcel(Request $request) {

      $cajas = new \App\admin\Cajas;

      $data = $cajas->getCajasExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$cajas', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

    public function getPrinter($id){

      $data =  \App\admin\Cajas::find($id);

      $pdf = PDF::loadView('admin/cajas/rpt', ['data' => $data,], [ 'title' => 'Voucher ' . $data->id, 'margin_top' => 0]);

      return $pdf->stream('inventario.pdf');

      //return view('admin/cajas/rpt', ['data'=>$data]);


    }

    public function getInfo($id){

      $cajas = new \App\admin\Cajas;

      $data = $cajas->getCajasView($id);

      if(count($data)){

        $efectivo          = \App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Efectivo')->where('caja_id',$data->id)->sum('totald');
        $tdc               = \App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Tarjeta Credito')->where('caja_id',$data->id)->sum('totald');
        $tdb               = \App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Tarjeta Debito')->where('caja_id',$data->id)->sum('totald');
        $transfer          = \App\admin\Ventas::where('status','!=',0)->where('metodo_pago','Transferencia')->where('caja_id',$data->id)->sum('totald');

        $efectivo_recibido = \App\admin\Efectivo::where('tipo','I')->where('status',1)->where('caja_id',$data->id)->sum('importe');
        $efectivo_retirado = \App\admin\Efectivo::where('tipo','E')->where('status',1)->where('caja_id',$data->id)->sum('importe');

        $total_efectivo = ($data->monto_inicial + $efectivo_recibido + $efectivo) - $efectivo_retirado;

        $diferencia = $total_efectivo - $data->monto_final;

        return array('data'=>$data,'efectivo' => $efectivo,'tarjetas' => ($tdc + $tdb),'transferencia' => $transfer,'total_efectivo' => $total_efectivo,'diferencia' => $diferencia);

      } else{

        return array('data'=>array());

      }

    }

    public function postArqueo(Request $request) {

      $data = \App\admin\Cajas::find($request->input('id'));

      if(count($data)) {

        $data->comentarios = $request->input('comentarios');
        $data->save();

        $request->session()->flash('message', 'cajas Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\CajasController@index');

      } else {

        $request->session()->flash('message', 'Se ha producido un error inesperado, por favos contacte a su administrador');
        $request->session()->flash('fracaso', 'true');
        return redirect()->action('admin\CajasController@index');

      }

    }

}
