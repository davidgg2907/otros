<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getPermissions($id){
      $data =  Permissions::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPermissionsView($id){
      $permissions = Permissions::select(array('permissions.*'));
      $permissions->where('permissions.id', $id);

      return $permissions->get()[0];

    }

    public function getEmpresas($id){
      $data =  Empresas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getEmpresasView($id){
      $empresas = Empresas::select(array('empresas.*'));
      $empresas->where('empresas.id', $id);

      return $empresas->get()[0];

    }

    public function changeStatus($field, $id){
      $empresas = $this->getEmpresas($id);
      if(count($empresas)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $empresas = $this->getEmpresas($id);
      if(count($empresas)){
        $empresas->status = $num;
        $empresas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $empresas = $this->getEmpresas($id);
      if(count($empresas)){
        $img = public_path().'/uploads/'.$empresas->featured_img;
            if($empresas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $empresas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getEmpresasData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $empresas = Empresas::select(array('empresas.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $empresas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $empresas->orderBy($sortBy, $order);
        } else{
          $empresas->orderBy('empresas.id', 'desc');
        }

        return $empresas->paginate($per_page);
    }

    public function getEmpresasExport($searchBy, $searchValue, $sortBy, $order){
      $empresas = Empresas::select(array('empresas.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $empresas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $empresas->orderBy($sortBy, $order);
        } else{
          $empresas->orderBy('empresas.id', 'desc');
        }
        return $empresas->get();
    }

    public function updateEmpresas($request){
      $id = $request->input('id');
      $empresas = Empresas::getEmpresas($id);
      if(count($empresas)){

          $empresas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
          $empresas->impuesto = $request->input('impuesto')!="" ? $request->input('impuesto') : "";

          $empresas->direccion = $request->input('direccion')!="" ? $request->input('direccion') : "";
          $empresas->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
          $empresas->ciudad = $request->input('ciudad')!="" ? $request->input('ciudad') : "";
          $empresas->estado = $request->input('estado')!="" ? $request->input('estado') : "";
          $empresas->cp = $request->input('cp')!="" ? $request->input('cp') : "";

          $empresas->hospedaje = $request->input('hospedaje')!="" ? $request->input('hospedaje') : "";
          $empresas->hospedaje_iva = $request->input('hospedaje_iva')!="" ? $request->input('hospedaje_iva') : "";

          $empresas->correo = $request->input('correo')!="" ? $request->input('correo') : "";
        	$empresas->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
        	$empresas->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$empresas->twitter = $request->input('twitter')!="" ? $request->input('twitter') : "";
        	$empresas->facebook = $request->input('facebook')!="" ? $request->input('facebook') : "";
        	$empresas->instagram = $request->input('instagram')!="" ? $request->input('instagram') : "";

          // image upload code
          $imagen_name='';
          $imagen_file = $request->file('logotipo');
          if(!is_null($imagen_file) && in_array($imagen_file->getClientOriginalExtension(), $this->allow_image)){
              $imagen_name = time().'_'.$imagen_file->getClientOriginalName();
              $imagen_file->move('uploads/empresa',$imagen_name);
              $empresas->logotipo = $imagen_name;
          }
          $empresas->status = $request->input('status')!="" ? $request->input('status') : "";

          $empresas->save();
          return true;
      } else{
        return false;
      }
    }

}
