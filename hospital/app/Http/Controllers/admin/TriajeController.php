<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Triaje;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;
use Excel;


class TriajeController extends Controller
{
    public $v_fields=array('triaje.folio', 'triaje.fecha', 'triaje.hora', 'triaje.paciente', 'triaje.edad', 'triaje.genero', 'triaje.peso', 'triaje.talla', 'triaje.ta', 'triaje.fr', 'triaje.fc', 'triaje.t', 'triaje.sp02', 'triaje.gcapilar', 'triaje.ocular', 'triaje.verbal', 'triaje.motriz', 'triaje.gtotal', 'triaje.diabetes', 'triaje.hipertencion', 'triaje.alergias', 'triaje.fum', 'triaje.ecardiacas', 'triaje.otras', 'triaje.otras_definicion', 'triaje.tarjeta', 'triaje.valoracion', 'triaje.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $triaje = new \App\admin\Triaje;

        $config = array();

        $config['titulo'] = "Admon. triage";

        $config['cancelar'] = url('/admin/triaje');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de triage",
            'href' => url('/admin/triaje'),
            'active' => false
        );

        $data = $triaje->getTriajeData($per_page, $request, $sortBy, $order);

        return view('admin/triaje/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $triaje = new \App\admin\Triaje;

      $config = array();

      $config['titulo'] = "Admon. triage";

      $config['cancelar'] = url('/admin/triaje');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de triage",
          'href' => url('/admin/triaje'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar triaje",
          'href' => url('/admin/triaje/add'),
          'active' => true
      );

      $data = new $triaje;

    	return view('admin/triaje/add', ['config'=>$config,'data'=>$data, ]);
    }

    public function postAdd(Request $request){

        $this->validate($request, [              
            'paciente'=> 'required' , 
            'edad'=> 'required' , 
            'genero'=> 'required' ,
            'domicilio'=> 'required' ,
            'colonia'=> 'required' ,
            'cp'=> 'required' ,
            'peso'=> 'required' , 
            'talla'=> 'required' , 
            'ta'=> 'required' , 
            'fr'=> 'required' , 
            'fc'=> 'required' , 
            't'=> 'required' , 
            'sp02'=> 'required' , 
            'gcapilar'=> 'required' , 
            'ocular'=> 'required' , 
            'verbal'=> 'required' , 
            'motriz'=> 'required' , 
            'gtotal'=> 'required' , 
            'diabetes'=> 'required' , 
            'hipertencion'=> 'required' , 
            'alergias'=> 'required' , 
            'fum'=> 'required' , 
            'ecardiacas'=> 'required' , 
            'otras'=> 'required' , 
            'tarjeta'=> 'required' , 
            'valoracion'=> 'required',
            'doctor'=> 'required',
            'enfermera'=> 'required',
            'jefa'=> 'required',
        ]);

        $triaje = new \App\admin\Triaje;
        $triaje->addTriaje($request);
        $request->session()->flash('message', 'triaje Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\TriajeController@index');
    }

    public function getEdit($id=''){

        $triaje = new \App\admin\Triaje;

        $data = $triaje->getTriaje($id);

        $config = array();

        $config['titulo'] = "Admon. triage";

        $config['cancelar'] = url('/admin/triaje');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de triage",
            'href' => url('/admin/triaje'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar triaje",
            'href' => url('/admin/triaje/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/triaje/edit', ['data'=>$data, 'config'=>$config ,]);
        } else{
          return view('admin/triaje/edit');
        }
    }

    public function postEdit(Request $request){

        $this->validate($request, [              
            'paciente'=> 'required' , 
            'edad'=> 'required' , 
            'genero'=> 'required' ,
            'domicilio'=> 'required' ,
            'colonia'=> 'required' ,
            'cp'=> 'required' ,
            'peso'=> 'required' , 
            'talla'=> 'required' , 
            'ta'=> 'required' , 
            'fr'=> 'required' , 
            'fc'=> 'required' , 
            't'=> 'required' , 
            'sp02'=> 'required' , 
            'gcapilar'=> 'required' , 
            'ocular'=> 'required' , 
            'verbal'=> 'required' , 
            'motriz'=> 'required' , 
            'gtotal'=> 'required' , 
            'diabetes'=> 'required' , 
            'hipertencion'=> 'required' , 
            'alergias'=> 'required' , 
            'fum'=> 'required' , 
            'ecardiacas'=> 'required' , 
            'otras'=> 'required' , 
            'tarjeta'=> 'required' , 
            'valoracion'=> 'required', 
            'doctor'=> 'required',
            'enfermera'=> 'required',
            'jefa'=> 'required',
        ]);

        $triaje = new \App\admin\Triaje;
        if($triaje->updateTriaje($request)){
            $request->session()->flash('message', 'triaje Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\TriajeController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\TriajeController@index');
        }
    }

    public function view($id){

      $triaje = new \App\admin\Triaje;

      $data = $triaje->gettriajeView($id);
      $empresa = \App\admin\Empresas::find(1);


      $config = array();

      $config['titulo'] = "Admon. triage";

      $config['cancelar'] = url('/admin/triaje');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de triage",
          'href' => url('/admin/triaje'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de triaje",
          'href' => url('/admin/triaje/view'),
          'active' => true
      );

      
        $pdf = PDF::loadView('admin/triaje/view', ['data'=>$data, 'config'=>$config,'empresa' => $empresa,'consulta' => $consulta],
                                                [ 'title' => 'Expediente #' . $data->id, 'margin_top' => 0]);

      return $pdf->stream('receta' . $data->id . '.pdf');
      
    }

    public function baja($id){

        $triaje = new \App\admin\Triaje;
        $flag = $triaje->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$triaje deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\TriajeController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\TriajeController@index');
        }
    }

    public function alta($id){
        $triaje = new \App\admin\Triaje;
        $flag = $triaje->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$triaje habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\triajeController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\triajeController@index');
        }
    }

    public function getAjax($id){

      $triaje = new \App\admin\Triaje;

      $data = $triaje->gettriajeView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

    public function getExcel(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $data =  \App\admin\Triaje::select("id AS Folio","fecha","hora","paciente","domicilio","colonia","cp","edad","genero","peso","talla","ta","fr",
                                           "fc","t","sp02","gcapilar","ocular","verbal","motriz","gtotal","diabetes","hipertencion","alergias","fum",
                                           "ecardiacas AS enfermedades_cardiacas","otras","tarjeta","valoracion","folio","folio","folio")
                                  ->get();

        \Maatwebsite\Excel\Facades\Excel::create('triaje', function($excel) use ($data) {
            $excel->sheet('Sheetname', function($sheet) use ($data) {
                //$sheet->fromArray($data);
                $sheet->loadView('products.partials.table', compact('products'));
            });
  
        })->export('xls');
    }
}
