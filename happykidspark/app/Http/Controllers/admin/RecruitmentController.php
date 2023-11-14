<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recruitment;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class RecruitmentController extends Controller
{
    public $v_fields=array('recruitment.nombre', 'recruitment.edad', 'recruitment.edo_civil', 'recruitment.escolaridad', 'recruitment.experiencia', 'recruitment.habilidades', 'recruitment.fortalezas', 'recruitment.debilidades', 'recruitment.telefono', 'recruitment.correo', 'recruitment.cv');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $recruitment = new \App\admin\Recruitment;

        $config = array();

        $config['titulo'] = "recruitment";

        $config['cancelar'] = url('/admin/recruitment');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de recruitment",
            'href' => url('/admin/recruitment'),
            'active' => false
        );

        $data = $recruitment->getRecruitmentData($per_page, $request, $sortBy, $order);

        return view('admin/recruitment/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $recruitment = new \App\admin\Recruitment;

      $config = array();

      $config['titulo'] = "recruitment";

      $config['cancelar'] = url('/admin/recruitment');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de recruitment",
          'href' => url('/admin/recruitment'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar recruitment",
          'href' => url('/admin/recruitment/add'),
          'active' => true
      );

      $data = new $recruitment;

    	return view('admin/recruitment/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [
            
        ]);

        $recruitment = new \App\admin\Recruitment;
        $recruitment->addRecruitment($request);
        $request->session()->flash('message', 'recruitment Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\RecruitmentController@index');
    }

    public function getEdit($id=''){

        $recruitment = new \App\admin\Recruitment;

        $users = $recruitment->getAll('recruitment');

        $data = $recruitment->getRecruitment($id);

        $config = array();

        $config['titulo'] = "recruitment";

        $config['cancelar'] = url('/admin/recruitment');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de recruitment",
            'href' => url('/admin/recruitment'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar recruitment",
            'href' => url('/admin/recruitment/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/recruitment/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/recruitment/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [
            
        ]);

        $recruitment = new \App\admin\Recruitment;
        if($recruitment->updateRecruitment($request)){
            $request->session()->flash('message', 'recruitment Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\RecruitmentController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\RecruitmentController@index');
        }
    }

    public function view($id){

      $recruitment = new \App\admin\Recruitment;

      $data = $recruitment->getRecruitmentView($id);

      $config = array();

      $config['titulo'] = "recruitment";

      $config['cancelar'] = url('/admin/recruitment');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de recruitment",
          'href' => url('/admin/recruitment'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de recruitment",
          'href' => url('/admin/recruitment/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/recruitment/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/recruitment/view');

      }

    }

    public function baja($id){

        $recruitment = new \App\admin\Recruitment;
        $flag = $recruitment->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$recruitment deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\RecruitmentController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\RecruitmentController@index');
        }
    }

    public function alta($id){
        $recruitment = new \App\admin\Recruitment;
        $flag = $recruitment->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$recruitment habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\RecruitmentController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\RecruitmentController@index');
        }
    }

    public function getAjax($id){

      $recruitment = new \App\admin\Recruitment;

      $data = $recruitment->getRecruitmentView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request) {

      $recruitment = new \App\admin\Recruitment;

      $data = $recruitment->getRecruitmentExport($request);

      \Maatwebsite\Excel\Facades\Excel::create('$recruitment', function($excel) use ($data) {
          $excel->sheet('Sheetname', function($sheet) use ($data) {
              $sheet->fromArray($data);
          });

      })->export('xls');

    }

}
