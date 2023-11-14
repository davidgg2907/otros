<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Triaje extends Model
{
    protected $table = 'triaje';
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

    public function getTriaje($id){
      $data =  Triaje::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getTriajeView($id){
      $triaje = Triaje::select(array('triaje.*'));
      $triaje->where('triaje.id', $id);
      
      return $triaje->get()[0];

    }

    public function changeStatus($field, $id){
      $triaje = $this->getTriaje($id);
      if(count($triaje)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $triaje = $this->getTriaje($id);
      if(count($triaje)){
        $triaje->status = $num;
        $triaje->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $triaje = $this->getTriaje($id);
      if(count($triaje)){
        $img = public_path().'/uploads/'.$triaje->featured_img;
            if($triaje->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $triaje->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getTriajeData($per_page, $request, $sortBy, $order){
      $triaje = Triaje::select(array('triaje.*'));

      //join
        if($request->input('fecha') != "") {
          $triaje->where('fecha','LIKE','%' . date('Y-m-d',strtotime($request->input('fecha'))) . '%');
        }       

        if($request->input('paciente') != "") {
          $triaje->where('paciente','LIKE','%' . $request->input('paciente') . '%');
        } 

        if($request->input('valoracion') != "") {
          $triaje->where('valoracion','LIKE','%' . $request->input('valoracion') . '%');
        } 

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $triaje->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $triaje->orderBy($sortBy, $order);
        } else{
          $triaje->orderBy('triaje.id', 'desc');
        }

        return $triaje->paginate($per_page);
    }

    public function getTriajeExport($searchBy, $searchValue, $sortBy, $order){
      $triaje = Triaje::select(array('triaje.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $triaje->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $triaje->orderBy($sortBy, $order);
        } else{
          $triaje->orderBy('triaje.id', 'desc');
        }
        return $triaje->get();
    }

    public function updateTriaje($request){
      $id = $request->input('id');
      $triaje = Triaje::getTriaje($id);
      if(count($triaje)){

          $triaje->paciente = $request->input('paciente')!="" ? $request->input('paciente') : "";
          $triaje->edad = $request->input('edad')!="" ? $request->input('edad') : "";
          $triaje->genero = $request->input('genero')!="" ? $request->input('genero') : "";
          $triaje->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
          $triaje->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
          $triaje->cp = $request->input('cp')!="" ? $request->input('cp') : "";
          $triaje->peso = $request->input('peso')!="" ? $request->input('peso') : "";
          $triaje->talla = $request->input('talla')!="" ? $request->input('talla') : "";
          $triaje->ta = $request->input('ta')!="" ? $request->input('ta') : "";
          $triaje->fr = $request->input('fr')!="" ? $request->input('fr') : "";
          $triaje->fc = $request->input('fc')!="" ? $request->input('fc') : "";
          $triaje->t = $request->input('t')!="" ? $request->input('t') : "";
          $triaje->sp02 = $request->input('sp02')!="" ? $request->input('sp02') : "";
          $triaje->gcapilar = $request->input('gcapilar')!="" ? $request->input('gcapilar') : "";
          $triaje->ocular = $request->input('ocular')!="" ? $request->input('ocular') : "";
          $triaje->verbal = $request->input('verbal')!="" ? $request->input('verbal') : "";
          $triaje->motriz = $request->input('motriz')!="" ? $request->input('motriz') : "";
          $triaje->gtotal = $request->input('gtotal')!="" ? $request->input('gtotal') : "";
          $triaje->diabetes = $request->input('diabetes')!="" ? $request->input('diabetes') : "";
          $triaje->hipertencion = $request->input('hipertencion')!="" ? $request->input('hipertencion') : "";
          $triaje->alergias = $request->input('alergias')!="" ? $request->input('alergias') : "";
          $triaje->fum = $request->input('fum')!="" ? $request->input('fum') : "";
          $triaje->ecardiacas = $request->input('ecardiacas')!="" ? $request->input('ecardiacas') : "";
          $triaje->otras = $request->input('otras')!="" ? $request->input('otras') : "";
          $triaje->otras_definicion = $request->input('otras_definicion')!="" ? $request->input('otras_definicion') : "";
          $triaje->tarjeta = $request->input('tarjeta')!="" ? $request->input('tarjeta') : "";
          $triaje->valoracion = $request->input('valoracion')!="" ? $request->input('valoracion') : "";
          $triaje->doctor = $request->input('doctor')!="" ? $request->input('doctor') : "";
          $triaje->enfermera = $request->input('enfermera')!="" ? $request->input('enfermera') : "";
          $triaje->jefa = $request->input('jefa')!="" ? $request->input('jefa') : "";

          $triaje->save();
          return true;
      } else{
        return false;
      }
    }

    public function addTriaje($request){
      $triaje = new Triaje;

        $triaje->fecha = date('Y-m-d');
        $triaje->hora = date('H:i:s');
        $triaje->paciente = $request->input('paciente')!="" ? $request->input('paciente') : "";
        $triaje->edad = $request->input('edad')!="" ? $request->input('edad') : "";
        $triaje->genero = $request->input('genero')!="" ? $request->input('genero') : "";
        $triaje->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
        $triaje->colonia = $request->input('colonia')!="" ? $request->input('colonia') : "";
        $triaje->cp = $request->input('cp')!="" ? $request->input('cp') : "";
        $triaje->peso = $request->input('peso')!="" ? $request->input('peso') : "";
        $triaje->talla = $request->input('talla')!="" ? $request->input('talla') : "";
        $triaje->ta = $request->input('ta')!="" ? $request->input('ta') : "";
        $triaje->fr = $request->input('fr')!="" ? $request->input('fr') : "";
        $triaje->fc = $request->input('fc')!="" ? $request->input('fc') : "";
        $triaje->t = $request->input('t')!="" ? $request->input('t') : "";
        $triaje->sp02 = $request->input('sp02')!="" ? $request->input('sp02') : "";
        $triaje->gcapilar = $request->input('gcapilar')!="" ? $request->input('gcapilar') : "";
        $triaje->ocular = $request->input('ocular')!="" ? $request->input('ocular') : "";
        $triaje->verbal = $request->input('verbal')!="" ? $request->input('verbal') : "";
        $triaje->motriz = $request->input('motriz')!="" ? $request->input('motriz') : "";
        $triaje->gtotal = $request->input('gtotal')!="" ? $request->input('gtotal') : "";
        $triaje->diabetes = $request->input('diabetes')!="" ? $request->input('diabetes') : "";
        $triaje->hipertencion = $request->input('hipertencion')!="" ? $request->input('hipertencion') : "";
        $triaje->alergias = $request->input('alergias')!="" ? $request->input('alergias') : "";
        $triaje->fum = $request->input('fum')!="" ? $request->input('fum') : "";
        $triaje->ecardiacas = $request->input('ecardiacas')!="" ? $request->input('ecardiacas') : "";
        $triaje->otras = $request->input('otras')!="" ? $request->input('otras') : "";
        $triaje->otras_definicion = $request->input('otras_definicion')!="" ? $request->input('otras_definicion') : "";
        $triaje->tarjeta = $request->input('tarjeta')!="" ? $request->input('tarjeta') : "";
        $triaje->valoracion = $request->input('valoracion')!="" ? $request->input('valoracion') : "";
        $triaje->doctor = $request->input('doctor')!="" ? $request->input('doctor') : "";
        $triaje->enfermera = $request->input('enfermera')!="" ? $request->input('enfermera') : "";
        $triaje->jefa = $request->input('jefa')!="" ? $request->input('jefa') : "";
        $triaje->status = 1;

        $triaje->save();
        return true;
    }
}
