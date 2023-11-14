<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Medicamentos extends Model
{
    protected $table = 'medicamentos';
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

    public function getMedicamentos($id){
      $data =  Medicamentos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getMedicamentosView($id){
      $medicamentos = Medicamentos::select(array('medicamentos.*'));
      $medicamentos->where('medicamentos.id', $id);

      return $medicamentos->get()[0];

    }

    public function changeStatus($field, $id){
      $medicamentos = $this->getMedicamentos($id);
      if(count($medicamentos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $medicamentos = $this->getMedicamentos($id);
      if(count($medicamentos)){
        $medicamentos->status = $num;
        $medicamentos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $medicamentos = $this->getMedicamentos($id);
      if(count($medicamentos)){
        $img = public_path().'/uploads/'.$medicamentos->featured_img;
            if($medicamentos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $medicamentos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getMedicamentosData($per_page, $request, $sortBy, $order){
      $medicamentos = Medicamentos::select(array('medicamentos.*'));

      //join


        // where condition
        if($request->input('comercial') != ""){
          $enfermeria->where('comercial','LIKE','%' . $request->input('comercial') . '%');
        }

        if($request->input('generico') != ""){
          $enfermeria->where('generico','LIKE','%' . $request->input('generico') . '%');
        }


        if($request->input('farmaceutica') != ""){
          $enfermeria->where('farmaceutica','LIKE','%' . $request->input('farmaceutica') . '%');
        }


        if($request->input('activo') != ""){
          $enfermeria->where('activo','LIKE','%' . $request->input('activo') . '%');
        }

        $medicamentos->where('status',1);

        // sort option
        if($sortBy!='' && $order!=''){
          $medicamentos->orderBy($sortBy, $order);
        } else{
          $medicamentos->orderBy('medicamentos.id', 'desc');
        }

        return $medicamentos->paginate($per_page);
    }

    public function getMedicamentosExport($searchBy, $searchValue, $sortBy, $order){
      $medicamentos = Medicamentos::select(array('medicamentos.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $medicamentos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $medicamentos->orderBy($sortBy, $order);
        } else{
          $medicamentos->orderBy('medicamentos.id', 'desc');
        }
        return $medicamentos->get();
    }

    public function updateMedicamentos($request){
      $id = $request->input('id');
      $medicamentos = Medicamentos::getMedicamentos($id);
      if(count($medicamentos)){

          $medicamentos->comercial = $request->input('comercial')!="" ? $request->input('comercial') : "";
	$medicamentos->generico = $request->input('generico')!="" ? $request->input('generico') : "";
	$medicamentos->activo = $request->input('activo')!="" ? $request->input('activo') : "";
	$medicamentos->componentes = $request->input('componentes')!="" ? $request->input('componentes') : "";
	$medicamentos->farmaceutica = $request->input('farmaceutica')!="" ? $request->input('farmaceutica') : "";
	$medicamentos->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$medicamentos->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$medicamentos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$medicamentos->caducidad = $request->input('caducidad')!="" ? $request->input('caducidad') : "";
	$medicamentos->efectos = $request->input('efectos')!="" ? $request->input('efectos') : "";
	$medicamentos->recomendaciones = $request->input('recomendaciones')!="" ? $request->input('recomendaciones') : "";
	$medicamentos->status = $request->input('status')!="" ? $request->input('status') : "";

          $medicamentos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addMedicamentos($request){
      $medicamentos = new Medicamentos;

        $medicamentos->comercial = $request->input('comercial')!="" ? $request->input('comercial') : "";
	$medicamentos->generico = $request->input('generico')!="" ? $request->input('generico') : "";
	$medicamentos->activo = $request->input('activo')!="" ? $request->input('activo') : "";
	$medicamentos->componentes = $request->input('componentes')!="" ? $request->input('componentes') : "";
	$medicamentos->farmaceutica = $request->input('farmaceutica')!="" ? $request->input('farmaceutica') : "";
	$medicamentos->cantidad = $request->input('cantidad')!="" ? $request->input('cantidad') : "";
	$medicamentos->costo = $request->input('costo')!="" ? $request->input('costo') : "";
	$medicamentos->precio = $request->input('precio')!="" ? $request->input('precio') : "";
	$medicamentos->caducidad = $request->input('caducidad')!="" ? $request->input('caducidad') : "";
	$medicamentos->efectos = $request->input('efectos')!="" ? $request->input('efectos') : "";
	$medicamentos->recomendaciones = $request->input('recomendaciones')!="" ? $request->input('recomendaciones') : "";
	$medicamentos->status = $request->input('status')!="" ? $request->input('status') : "";

        $medicamentos->save();
        return true;
    }
}
