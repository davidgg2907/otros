<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class ProductosController extends Controller
{
    public $v_fields=array('productos.id', 'productos.descripcion', 'productos.precio', 'productos.iva', 'productos.valor_iva', 'productos.precio_neto', 'productos.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $productos = new \App\admin\Productos;

        $config = array();

        $config['titulo'] = "Catalogo de Servicios";

        $config['cancelar'] = url('/admin/productos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos",
            'href' => url('/admin/productos'),
            'active' => false
        );

        $data = $productos->getProductosData($per_page, $request, $sortBy, $order);

        return view('admin/productos/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $productos = new \App\admin\Productos;

      $empresa   = \App\admin\Empresas::find(1);

      $config = array();

      $config['titulo'] = "Catalogo de Servicios";

      $config['cancelar'] = url('/admin/productos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos",
          'href' => url('/admin/productos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Agregar productos",
          'href' => url('/admin/productos/add'),
          'active' => true
      );

      $data = new $productos;

    	return view('admin/productos/add', ['config'=>$config,'data'=>$data ,'empresa' => $empresa ]);
    }

    public function postAdd(Request $request){

      $this->validate($request, [
           'descripcion'=> 'required' ,
           'precio'=> 'required' ,
           'iva'=> 'required' ,
           'status'=> 'required'
      ]);

        $productos = new \App\admin\Productos;
        $productos->addProductos($request);
        $request->session()->flash('message', 'productos Agregado exitosamente!');
        $request->session()->flash('exito', 'true');
        return redirect()->action('admin\ProductosController@index');
    }

    public function getEdit($id=''){

        $productos = new \App\admin\Productos;

        $empresa   = \App\admin\Empresas::find(1);

        $users = $productos->getAll('productos');

        $data = $productos->getProductos($id);

        $config = array();

        $config['titulo'] = "Catalogo de Servicios";

        $config['cancelar'] = url('/admin/productos');

        $config['breadcrumbs'][] = array(
            'text' => "Escritorio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de productos",
            'href' => url('/admin/productos'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Editar productos",
            'href' => url('/admin/productos/edit'),
            'active' => true
        );

        if(count($data)){
          return view('admin/productos/edit', ['data'=>$data, 'config'=>$config ,'empresa' => $empresa]);
        } else{
          return view('admin/productos/edit');
        }
    }

    public function postEdit(Request $request){

      $this->validate($request, [
           'descripcion'=> 'required' ,
           'precio'=> 'required' ,
           'iva'=> 'required' ,
           'status'=> 'required'
      ]);

        $productos = new \App\admin\Productos;
        if($productos->updateProductos($request)){
            $request->session()->flash('message', 'productos Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ProductosController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ProductosController@index');
        }
    }

    public function view($id){

      $productos = new \App\admin\Productos;

      $data = $productos->getProductosView($id);

      $config = array();

      $config['titulo'] = "Catalogo de Servicios";

      $config['cancelar'] = url('/admin/productos');

      $config['breadcrumbs'][] = array(
          'text' => "Escritorio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de productos",
          'href' => url('/admin/productos'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de productos",
          'href' => url('/admin/productos/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/productos/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/productos/view');

      }

    }

    public function baja($id){

        $productos = new \App\admin\Productos;
        $flag = $productos->updateStatus($id,0);
        if($flag){
            Session::flash('message', '$productos deshabilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProductosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProductosController@index');
        }
    }

    public function alta($id){
        $productos = new \App\admin\Productos;
        $flag = $productos->updateStatus($id,1);
        if($flag){
            Session::flash('message', '$productos habilitado correctamente!');
            Session::flash('exito', 'true');
            return redirect()->action('admin\ProductosController@index');
        } else{
            Session::flash('message', 'Hubo un problema al cambiar el estado del banco');
            Session::flash('fracaso', 'true');
            return redirect()->action('admin\ProductosController@index');
        }
    }

    public function getAjax($id){

      $productos = new \App\admin\Productos;

      $data = $productos->getProductosView($id);

      if(count($data)){

        return array('error' =>0, 'msg' => '','data' => $data);

      } else{

        return array('error' =>0, 'msg' => 'No se encontro la informacion solicitada','data' => array());

      }

    }

}
