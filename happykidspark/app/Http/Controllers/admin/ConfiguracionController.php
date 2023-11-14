<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Configuracion;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ConfiguracionController extends Controller
{
    public $v_fields=array('configuracion.nombre', 'configuracion.direccion', 'configuracion.colonia', 'configuracion.estado', 'configuracion.ciudad', 'configuracion.cp', 'configuracion.correo', 'configuracion.telefono', 'configuracion.ttraspaso', 'configuracion.ml_api', 'configuracion.ml_appkey', 'configuracion.ml_appsecret', 'configuracion.ml_code', 'configuracion.ml_token', 'configuracion.ml_rtoken', 'configuracion.ml_tokenexpire', 'configuracion.ml_usr', 'configuracion.ml_pws', 'configuracion.celular', 'configuracion.iva', 'configuracion.logo', 'configuracion.icono', 'configuracion.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getEdit(){

        $data = \App\admin\Configuracion::find(1);

        $config = array();

        $config['titulo'] = "configuracion";

        $config['cancelar'] = url('/admin/configuracion');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de configuracion",
            'href' => url('/admin/configuracion'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar configuracion",
            'href' => url('/admin/configuracion/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/configuracion/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/configuracion/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $configuracion = new \App\admin\Configuracion;
        if($configuracion->updateConfiguracion($request)){
            $request->session()->flash('message', 'configuracion Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ConfiguracionController@getEdit');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ConfiguracionController@getEdit');
        }
    }

    public function view($id){

      $configuracion = new \App\admin\Configuracion;

      $data = $configuracion->getConfiguracionView($id);

      $config = array();

      $config['titulo'] = "configuracion";

      $config['cancelar'] = url('/admin/configuracion');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de configuracion",
          'href' => url('/admin/configuracion'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de configuracion",
          'href' => url('/admin/configuracion/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/configuracion/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/configuracion/view');

      }

    }

    public function baja($id){

        $configuracion = new \App\admin\Configuracion;
        $flag = $configuracion->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$configuracion deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ConfiguracionController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ConfiguracionController@index');
        }
    }

    public function alta($id){
        $configuracion = new \App\admin\Configuracion;
        $flag = $configuracion->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$configuracion habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ConfiguracionController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ConfiguracionController@index');
        }
    }

    public function getAjax($id){

      $configuracion = new \App\admin\Configuracion;

      $data = $configuracion->getConfiguracionView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $configuracion = new \App\admin\Configuracion;

      $data = $configuracion->getConfiguracionExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$configuracion', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
