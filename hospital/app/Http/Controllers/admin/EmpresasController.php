<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class EmpresasController extends Controller
{
    public $v_fields=array('empresas.nombre', 'empresas.direccion', 'empresas.telefono', 'empresas.celular', 'empresas.twitter', 'empresas.facebook', 'empresas.instagram', 'empresas.logotipo', 'empresas.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index($id=1){

        $empresas = new \App\admin\Empresas;

        $users = $empresas->getAll('empresas');

        $data = $empresas->getEmpresas($id);

        $config = array();

        $config['titulo'] = "empresas";

        $config['cancelar'] = url('/admin/empresas');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
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
             'nombre'=> 'required'
        ]);

        $empresas = new \App\admin\Empresas;
        if($empresas->updateEmpresas($request)){
            $request->session()->flash('message', 'empresas Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\EmpresasController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\EmpresasController@index');
        }
    }

}
