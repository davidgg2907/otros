<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Assignments;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class AssignmentsController extends Controller
{
    public $v_fields=array('employees.nombre', 'assignments.tarea', 'assignments.descripcion', 'assignments.inicia', 'assignments.termina', 'assignments.asignacion', 'assignments.estatus');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $assignments = new \App\admin\Assignments;

        $config = array();

        $config['titulo'] = "assignments";

        $config['cancelar'] = url('/admin/assignments');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de assignments",
            'href' => url('/admin/assignments'),
            'active' => false
        );

        $data = $assignments->getAssignmentsData($per_page, $request, $sortBy, $order);

        return view('admin/assignments/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $assignments = new \App\admin\Assignments;

      $config = array();

      $config['titulo'] = "assignments";

      $config['cancelar'] = url('/admin/assignments');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de assignments",
          'href' => url('/admin/assignments'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar assignments",
          'href' => url('/admin/assignments/add'),
          'active' => true
      );

      $data = new $assignments;

    	return view('admin/assignments/add', ['config'=>$config,'data'=>$data, 'employees'=>$assignments->getAll('employees')]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $assignments = new \App\admin\Assignments;
        $assignments->addAssignments($request);
        $request->session()->flash('message', 'assignments Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\AssignmentsController@index');
    }

    public function getEdit($id=''){

        $assignments = new \App\admin\Assignments;

        $users = $assignments->getAll('assignments');

        $data = $assignments->getAssignments($id);

        $config = array();

        $config['titulo'] = "assignments";

        $config['cancelar'] = url('/admin/assignments');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de assignments",
            'href' => url('/admin/assignments'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar assignments",
            'href' => url('/admin/assignments/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/assignments/edit', ['data'=>$data, 'config'=>$config ,'employees'=>$assignments->getAll('employees')]);
        } else{
          return view('admin/assignments/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $assignments = new \App\admin\Assignments;
        if($assignments->updateAssignments($request)){
            $request->session()->flash('message', 'assignments Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\AssignmentsController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\AssignmentsController@index');
        }
    }

    public function view($id){

      $assignments = new \App\admin\Assignments;

      $data = $assignments->getAssignmentsView($id);

      $config = array();

      $config['titulo'] = "assignments";

      $config['cancelar'] = url('/admin/assignments');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de assignments",
          'href' => url('/admin/assignments'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de assignments",
          'href' => url('/admin/assignments/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/assignments/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/assignments/view');

      }

    }

    public function baja($id){

        $assignments = new \App\admin\Assignments;
        $flag = $assignments->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$assignments deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AssignmentsController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AssignmentsController@index');
        }
    }

    public function alta($id){
        $assignments = new \App\admin\Assignments;
        $flag = $assignments->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$assignments habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\AssignmentsController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\AssignmentsController@index');
        }
    }

    public function getAjax($id){

      $assignments = new \App\admin\Assignments;

      $data = $assignments->getAssignmentsView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $assignments = new \App\admin\Assignments;

      $data = $assignments->getAssignmentsExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$assignments', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
