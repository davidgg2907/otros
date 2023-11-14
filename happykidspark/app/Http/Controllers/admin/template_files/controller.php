<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\controller_name;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class controller_nameController extends Controller
{
    public @@@v_fields=array(++sort_fields_arr++);
    public @@@allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request @@@request){

        // pagination per page
        @@@per_page = 25;
        // get by modal
        @@@==table== = new \App\admin\controller_name;

        @@@config = array();

        @@@config['titulo'] = "==table==";

        @@@config['cancelar'] = url('/admin/==table==');

        @@@config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        @@@config['breadcrumbs'][] = array(
            'text' => "Listado de ==table==",
            'href' => url('/admin/==table=='),
            'active' => false
        );

        @@@data = @@@==table==->getcontroller_nameData(@@@per_page, @@@request, @@@sortBy, @@@order);

        return view('admin/==table==/index', ['data'=>@@@data->appends(Input::except('page')), 'per_page'=>@@@per_page, 'links'=>@@@links,'config'=>@@@config,'query' =>@@@_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request @@@request){

      @@@==table== = new \App\admin\controller_name;

      @@@config = array();

      @@@config['titulo'] = "==table==";

      @@@config['cancelar'] = url('/admin/==table==');

      @@@config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      @@@config['breadcrumbs'][] = array(
          'text' => "Listado de ==table==",
          'href' => url('/admin/==table=='),
          'active' => false
      );

      @@@config['breadcrumbs'][] = array(
          'text' => "Agregar ==table==",
          'href' => url('/admin/==table==/add'),
          'active' => true
      );

      @@@data = new @@@==table==;

    	return view('admin/==table==/add', ['config'=>@@@config,'data'=>@@@data, ==foreign_view_parameters==]);
    }

    public function postAdd(Request @@@request){

        @@@this->validate(@@@request, [
            ==validation==
        ]);

        @@@==table== = new \App\admin\controller_name;
        @@@==table==->addcontroller_name(@@@request);
        @@@request->session()->flash('message', '==table== Agregado exitosamente!');
        @@@request->session()->flash('exito', 'true');
        return redirect()->action('admin\controller_nameController@index');
    }

    public function getEdit(@@@id=''){

        @@@==table== = new \App\admin\controller_name;

        @@@users = @@@==table==->getAll('==table==');

        @@@data = @@@==table==->getcontroller_name(@@@id);

        @@@config = array();

        @@@config['titulo'] = "==table==";

        @@@config['cancelar'] = url('/admin/==table==');

        @@@config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        @@@config['breadcrumbs'][] = array(
            'text' => "Listado de ==table==",
            'href' => url('/admin/==table=='),
            'active' => false
        );

        @@@config['breadcrumbs'][] = array(
            'text' => "Editar ==table==",
            'href' => url('/admin/==table==/edit'),
            'active' => true
        );

        if(count(@@@data)){
          return view('admin/==table==/edit', ['data'=>@@@data, 'config'=>@@@config ==foreign_comma_view_parameters==]);
        } else{
          return view('admin/==table==/edit');
        }
    }

    public function postEdit(Request @@@request){

        @@@this->validate(@@@request, [
            ==validation==
        ]);

        @@@==table== = new \App\admin\controller_name;
        if(@@@==table==->updatecontroller_name(@@@request)){
            @@@request->session()->flash('message', '==table== Editado exitosamente!');
            @@@request->session()->flash('exito', 'true');
            return redirect()->action('admin\controller_nameController@index');
        } else{
            @@@request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            @@@request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\controller_nameController@index');
        }
    }

    public function view(@@@id){

      @@@==table== = new \App\admin\controller_name;

      @@@data = @@@==table==->getcontroller_nameView(@@@id);

      @@@config = array();

      @@@config['titulo'] = "==table==";

      @@@config['cancelar'] = url('/admin/==table==');

      @@@config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      @@@config['breadcrumbs'][] = array(
          'text' => "Listado de ==table==",
          'href' => url('/admin/==table=='),
          'active' => false
      );

      @@@config['breadcrumbs'][] = array(
          'text' => "Detalledel de ==table==",
          'href' => url('/admin/==table==/view'),
          'active' => true
      );

      if(count(@@@data)){

        return view('admin/==table==/view', ['data'=>@@@data, 'config'=>@@@config]);

      } else{

        return view('admin/==table==/view');

      }

    }

    public function baja(@@@id){

        @@@==table== = new \App\admin\controller_name;
        @@@flag = @@@==table==->updateStatus(@@@id,0);
        if(@@@flag){
            Session::flash('message', '@@@==table== deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\controller_nameController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\controller_nameController@index');
        }
    }

    public function alta(@@@id){
        @@@==table== = new \App\admin\controller_name;
        @@@flag = @@@==table==->updateStatus(@@@id,1);
        if(@@@flag){
            Session::flash('message', '@@@==table== habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\controller_nameController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\controller_nameController@index');
        }
    }

    public function getAjax(@@@id){

      @@@==table== = new \App\admin\controller_name;

      @@@data = @@@==table==->getcontroller_nameView(@@@id);

      if(count(@@@data)){

        return array('error' =>0, 'msg' => '','data' => @@@data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request @@@request) {

      @@@==table== = new \App\admin\controller_name;

      $data = @@@==table==->getcontroller_nameExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('@@@==table==', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
