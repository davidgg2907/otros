<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Codigos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class CodigosController extends Controller
{
    public $v_fields=array('codigos.usr_crea_id', 'codigos.usr_usa_id', 'codigos.creado', 'codigos.caducado', 'codigos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $codigos = new \App\admin\Codigos;

        $config = array();

        $config['titulo'] = "codigos";

        $config['cancelar'] = url('/admin/codigos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de codigos",
            'href' => url('/admin/codigos'),
            'active' => false
        );

        $data = $codigos->getCodigosData($per_page, $request, $sortBy, $order);

        return view('admin/codigos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(){

      $codigos = new \App\admin\Codigos;

      $code = $codigos->addCodigos();

      return array('error' => 0, 'code' => $code);

    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $codigos = new \App\admin\Codigos;
        $codigos->addCodigos($request);
        $request->session()->flash('message', 'codigos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\CodigosController@index');
    }

    public function getEdit($id=''){

        $codigos = new \App\admin\Codigos;

        $users = $codigos->getAll('codigos');

        $data = $codigos->getCodigos($id);

        $config = array();

        $config['titulo'] = "codigos";

        $config['cancelar'] = url('/admin/codigos');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de codigos",
            'href' => url('/admin/codigos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar codigos",
            'href' => url('/admin/codigos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/codigos/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/codigos/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $codigos = new \App\admin\Codigos;
        if($codigos->updateCodigos($request)){
            $request->session()->flash('message', 'codigos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\CodigosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\CodigosController@index');
        }
    }

    public function view($id){

      $codigos = new \App\admin\Codigos;

      $data = $codigos->getCodigosView($id);

      $config = array();

      $config['titulo'] = "codigos";

      $config['cancelar'] = url('/admin/codigos');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de codigos",
          'href' => url('/admin/codigos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de codigos",
          'href' => url('/admin/codigos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/codigos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/codigos/view');

      }

    }

    public function baja($id){

        $codigos = new \App\admin\Codigos;
        $flag = $codigos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$codigos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CodigosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CodigosController@index');
        }
    }

    public function alta($id){
        $codigos = new \App\admin\Codigos;
        $flag = $codigos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$codigos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\CodigosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\CodigosController@index');
        }
    }

    public function getAjax($id){

      $data = \App\admin\Codigos::where('codigo',$id)->first();

      if(count($data)){

        if($data->status == 1) {
          return array('error' =>0, 'msg' => '','code_id' => $data->id);
        } elseif($data->status == 2) {
          return array('error' =>1, 'msg' => 'El codigo ya ha sido utilizado','data' => array());
        } elseif ($data->status == 0) {
          return array('error' =>1, 'msg' => 'El codigo especificado ya ha caducado','data' => array());
        }
      } else{

        return array('error' =>1, 'msg' => 'El codigo especificado no existe','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $codigos = new \App\admin\Codigos;

      $data = $codigos->getCodigosExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$codigos', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
