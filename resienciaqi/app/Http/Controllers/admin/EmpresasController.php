<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class EmpresasController extends Controller
{
    public $v_fields=array('empresas.id', 'empresas.nombre', 'empresas.impuesto', 'empresas.direccion', 'empresas.colonia', 'empresas.estado', 'empresas.ciudad', 'empresas.cp', 'empresas.correo', 'empresas.telefono', 'empresas.celular', 'empresas.hospedaje', 'empresas.hospedaje_iva', 'empresas.twitter', 'empresas.facebook', 'empresas.instagram', 'empresas.logotipo', 'empresas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

      $empresas = new \App\admin\Empresas;

      $data = $empresas->getEmpresas(1);

      $config = array();

      $config['titulo'] = "Configuracion";

      $config['cancelar'] = url('/admin/empresas');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de empresas",
          'href' => url('/admin/empresas'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Editar empresas",
          'href' => url('/admin/empresas/edit'),
          'active' => true
      );

      if(count($data)){
        return view('admin/empresas/edit', ['data'=>$data, 'config'=>$config ,]);
      } else{
        return view('admin/empresas/edit');
      }
    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $empresas = new \App\admin\Empresas;
        if($empresas->updateEmpresas($request)){
            $request->session()->flash('message', 'empresas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
        }
        return redirect()->action('admin\EmpresasController@index');
    }

    public function captureQuiz($delegacion,$type) {

      if($delegacion == "") {
        Session::flash('message', 'Empresa no definida, contacte a su administrador o solicite una vez mas el enlace de evaluacion');
        Session::flash('fracaso', 'true');
      }


      if($type == "") {
        Session::flash('message', 'Evaluacion no definida, contacte a su administrador o solicite una vez mas el enlace de evaluacion');
        Session::flash('fracaso', 'true');
      }
      $empresa = \App\admin\Delegaciones::where('seo',$delegacion)
                                        ->where('status',1)
                                        ->first();

      $areas = \App\admin\Areas::where('status',1)
                               ->where('delegacion_id',$empresa->id)
                               ->get();

      $resilencia = array();

      $groups = \App\admin\Resiliencia_preguntas::select('grupo')->groupBy('grupo')->get();

      $results = array();

      foreach($groups as $group) {

        $rst = \App\admin\Resiliencia_preguntas::where('resiliencia_preguntas.grupo',$group->grupo)->get();

         foreach($rst as $resultSet) {

           $resilencia[$group->grupo][] = array( 'pregunta' => $resultSet->pregunta,'tipo' => $resultSet->tipo);

         }

      }

      $quiz = \App\admin\Preguntas::createQuiz();

      return view('admin/quiz/capture',['resilencia' => $resilencia,'quiz' => $quiz,'type' => $type,'delegacion' => $empresa,'areas' => $areas]);

    }

    public function saveQuiz(Request $request) {

      $paciente = \App\admin\Pacientes::where('status',1)->where('curp',$request->input('curp'))->first();

      if(count($paciente)) {
        $paciente_id = $paciente->id;
        $paciente->delegacion_id   = $request->input('delegacion_id');
        $paciente->area_id         = $request->input('area_id');
        $paciente->genero_id       = $request->input('genero_id');
        $paciente->educacion_id    = $request->input('educacion_id');
        $paciente->edo_civil_id    = $request->input('edo_civil_id');
        $paciente->ocupacion_id    = $request->input('ocupacion_id');
        $paciente->nombre          = $request->input('nombre');
        $paciente->telefono        = $request->input('telefono');
        $paciente->celular         = $request->input('celular');
        $paciente->curp            = $request->input('curp');
        $paciente->sexo            = $request->input('sexo');
        $paciente->status          = 1;
        $paciente->save();
        //El paciente existe, registramos el quiz con su id

      } else {
        //El paciente no existe, lo registramos
        $pacientes = new \App\admin\Pacientes;
        $pacientes->delegacion_id   = $request->input('delegacion_id');
        $pacientes->area_id         = $request->input('area_id');
        $pacientes->genero_id       = $request->input('genero_id');
        $pacientes->educacion_id    = $request->input('educacion_id');
        $pacientes->edo_civil_id    = $request->input('edo_civil_id');
        $pacientes->ocupacion_id    = $request->input('ocupacion_id');
        $pacientes->nombre          = $request->input('nombre');
        $pacientes->telefono        = $request->input('telefono');
        $pacientes->celular         = $request->input('celular');
        $pacientes->curp            = $request->input('curp');
        $pacientes->sexo            = $request->input('sexo');
        $pacientes->status          = 1;
        $pacientes->save();
        $paciente_id = $pacientes->id;
      }

      $resultados = new \App\admin\Resultados;

      $resultados->tipo           = $request->input('tipo');
      $resultados->paciente_id    = $paciente_id;
      $resultados->delegacion_id  = $request->input('delegacion_id');
      $resultados->area_id        = $request->input('area_id');
      $resultados->fecha          = date('Y-m-d');
      $resultados->status         = 1;

      $resultados->save();

      foreach($request->input('questions') as $question => $answer) {
        $detail = new  \App\admin\ResultadosDetalle;

        $detail->resultado_id   = $resultados->id;
        $detail->delegacion_id  = $request->input('delegacion_id');
        $detail->area_id        = $request->input('area_id');
        $detail->pregunta_id    = $question;

        if($answer['answer_type'] == 'O') {
          $detail->respuesta_id = $answer['answer_id'];
          $detail->valor        = $answer['answer_value'];
        } else {
          $detail->respuesta_id = $answer['answer_value'];
          $detail->valor        = $answer['answer_value'];
        }
        $detail->status       = 1;
        $detail->save();

      }

      return redirect('quiz/end');
    }

    public function thanksQuiz() {
      return view('admin/quiz/thanks');
    }

    public function getAjax($id){

      $empresas = new \App\admin\Empresas;

      $data = $empresas->getEmpresasView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
