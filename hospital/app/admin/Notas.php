<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';
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

    public function getNotas($id){
      $data =  Notas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getNotasView($id){
      $notas = Notas::select(array('notas.*'));
      $notas->where('notas.id', $id);

      return $notas->get()[0];

    }

    public function changeStatus($field, $id){
      $notas = $this->getNotas($id);
      if(count($notas)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $notas = $this->getNotas($id);
      if(count($notas)){
        $notas->status = $num;
        $notas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $notas = $this->getNotas($id);
      if(count($notas)){
        $img = public_path().'/uploads/'.$notas->featured_img;
            if($notas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $notas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getNotasData($per_page, $request, $sortBy, $order){
      $notas = Notas::select(array('notas.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $notas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $notas->orderBy($sortBy, $order);
        } else{
          $notas->orderBy('notas.id', 'desc');
        }

        return $notas->paginate($per_page);
    }

    public function getNotasExport($searchBy, $searchValue, $sortBy, $order){
      $notas = Notas::select(array('notas.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $notas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $notas->orderBy($sortBy, $order);
        } else{
          $notas->orderBy('notas.id', 'desc');
        }
        return $notas->get();
    }

    public function updateNotas($request){
      $id = $request->input('id');
      $notas = Notas::getNotas($id);
      if(count($notas)){

          $notas->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
	$notas->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
	$notas->tipo = $request->input('tipo')!="" ? $request->input('tipo') : "";
	$notas->tipo_descripcion = $request->input('tipo_descripcion')!="" ? $request->input('tipo_descripcion') : "";
	$notas->nota_medica = $request->input('nota_medica')!="" ? $request->input('nota_medica') : "";
	$notas->status = $request->input('status')!="" ? $request->input('status') : "";

          $notas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addNotas($request){
      $notas = new Notas;

        $notas->medico_id       = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
      	$notas->paciente_id     = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
      	$notas->tipo            = $request->input('tipo')!="" ? $request->input('tipo') : "";
        $notas->nota_medica     = $request->input('comentarios')!="" ? $request->input('comentarios') : "";
        $notas->fecha           = date('Y-m-d');
        $notas->hora            = date('H:i:s');
        $notas->status          = 1;

        $notas->save();
        return true;
    }
}
