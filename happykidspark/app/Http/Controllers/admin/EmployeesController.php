<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employees;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class EmployeesController extends Controller
{
    public $v_fields=array('employees.nombre', 'employees.apellidos', 'employees.posicion');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $employees = new \App\admin\Employees;

        $config = array();

        $config['titulo'] = "employees";

        $config['cancelar'] = url('/admin/employees');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de employees",
            'href' => url('/admin/employees'),
            'active' => false
        );

        $data = $employees->getEmployeesData($per_page, $request, $sortBy, $order);

        return view('admin/employees/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $employees = new \App\admin\Employees;

      $config = array();

      $config['titulo'] = "employees";

      $config['cancelar'] = url('/admin/employees');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de employees",
          'href' => url('/admin/employees'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar employees",
          'href' => url('/admin/employees/add'),
          'active' => true
      );

      $data = new $employees;

    	return view('admin/employees/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $employees = new \App\admin\Employees;
        $employees->addEmployees($request);
        $request->session()->flash('message', 'employees Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\EmployeesController@index');
    }

    public function getEdit($id=''){

        $employees = new \App\admin\Employees;

        $users = $employees->getAll('employees');

        $data = $employees->getEmployees($id);

        $config = array();

        $config['titulo'] = "employees";

        $config['cancelar'] = url('/admin/employees');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de employees",
            'href' => url('/admin/employees'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar employees",
            'href' => url('/admin/employees/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/employees/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/employees/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $employees = new \App\admin\Employees;
        if($employees->updateEmployees($request)){
            $request->session()->flash('message', 'employees Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\EmployeesController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\EmployeesController@index');
        }
    }

    public function view($id){

      $employees = new \App\admin\Employees;

      $data = $employees->getEmployeesView($id);

      $config = array();

      $config['titulo'] = "employees";

      $config['cancelar'] = url('/admin/employees');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de employees",
          'href' => url('/admin/employees'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de employees",
          'href' => url('/admin/employees/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/employees/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/employees/view');

      }

    }

    public function baja($id){

        $employees = new \App\admin\Employees;
        $flag = $employees->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$employees deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EmployeesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EmployeesController@index');
        }
    }

    public function alta($id){
        $employees = new \App\admin\Employees;
        $flag = $employees->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$employees habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\EmployeesController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\EmployeesController@index');
        }
    }

    public function getAjax($id){

      $employees = new \App\admin\Employees;

      $data = $employees->getEmployeesView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $employees = new \App\admin\Employees;

      $data = $employees->getEmployeesExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$employees', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
