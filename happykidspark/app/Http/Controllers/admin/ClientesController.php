<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clientes;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ClientesController extends Controller
{
    public $v_fields=array('clientes.nombre', 'clientes.direccion', 'clientes.telefono', 'clientes.celular', 'clientes.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $clientes = new \App\admin\Clientes;

        $config = array();

        $config['titulo'] = "clientes";

        $config['cancelar'] = url('/admin/clientes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de clientes",
            'href' => url('/admin/clientes'),
            'active' => false
        );

        $data = $clientes->getClientesData($per_page, $request, $sortBy, $order);

        return view('admin/clientes/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $clientes = new \App\admin\Clientes;

      $config = array();

      $config['titulo'] = "clientes";

      $config['cancelar'] = url('/admin/clientes');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de clientes",
          'href' => url('/admin/clientes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar clientes",
          'href' => url('/admin/clientes/add'),
          'active' => true
      );

      $data = new $clientes;

    	return view('admin/clientes/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [

        ]);

        $clientes = new \App\admin\Clientes;
        $clientes->addClientes($request);
        $request->session()->flash('message', 'clientes Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ClientesController@index');
    }

    public function getEdit($id=''){

        $clientes = new \App\admin\Clientes;

        $users = $clientes->getAll('clientes');

        $data = $clientes->getClientes($id);

        $config = array();

        $config['titulo'] = "clientes";

        $config['cancelar'] = url('/admin/clientes');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de clientes",
            'href' => url('/admin/clientes'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar clientes",
            'href' => url('/admin/clientes/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/clientes/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/clientes/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $clientes = new \App\admin\Clientes;
        if($clientes->updateClientes($request)){
            $request->session()->flash('message', 'clientes Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ClientesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ClientesController@index');
        }
    }

    public function view($id){

      $clientes = new \App\admin\Clientes;

      $data = $clientes->getClientesView($id);

      $config = array();

      $config['titulo'] = "clientes";

      $config['cancelar'] = url('/admin/clientes');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de clientes",
          'href' => url('/admin/clientes'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de clientes",
          'href' => url('/admin/clientes/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/clientes/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/clientes/view');

      }

    }

    public function baja($id){

        $clientes = new \App\admin\Clientes;
        $flag = $clientes->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$clientes deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ClientesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ClientesController@index');
        }
    }

    public function alta($id){
        $clientes = new \App\admin\Clientes;
        $flag = $clientes->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$clientes habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ClientesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ClientesController@index');
        }
    }

    public function getAjax($id){

      $clientes = new \App\admin\Clientes;

      $data = $clientes->getClientesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $clientes = new \App\admin\Clientes;

      $data = $clientes->getClientesExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$clientes', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

    public function getAutocomplete(Request $request) {

      $query = \App\admin\Clientes::where('nombre','LIKE','%' . $request->input('search') . '%')
                                  ->orWhere('telefono','LIKE','%' . $request->input('search') . '%')
                                  ->orWhere('celular','LIKE','%' . $request->input('search') . '%')
                                  ->limit(10)
                                  ->get();

      $html = '';
      foreach($query as $value) {

        $html .= '<tr >
                    <td>' . $value->nombre . '</td>
                    <td>' . $value->direccion . '</td>
                    <td>' . $value->telefono . '</td>
                    <td>' . $value->celular . '</td>
                    <td>
                      <button type="button" data-toggle="tooltip" title="Seleccionar Cliente" style="border:0px; background:none" onclick="selectCustom(' . $value->id . ',\'' . $value->nombre .'\')">
                        <i class="fa fa-check-circle fa-lg text-success m-r-10"></i>
                      </button>
                    </td>
                  </tr>';

      }

      return array('error' =>0 , 'html' => $html);

    }

    public function postSaveAjax(Request $request) {

      $clientes = new \App\admin\Clientes;

      $clientes->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      $clientes->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
      $clientes->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
      $clientes->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      $clientes->status = $request->input('status')!="" ? $request->input('status') : "";
      $clientes->save();

      return array('error' =>0,'data' => $clientes);
    }
}
