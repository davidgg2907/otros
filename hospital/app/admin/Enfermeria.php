<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Enfermeria extends Model
{
    protected $table = 'enfermeria';
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

    public function getEnfermeria($id){
      $data =  Enfermeria::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getEnfermeriaView($id){
      $enfermeria = Enfermeria::select(array('enfermeria.*'));
      $enfermeria->where('enfermeria.id', $id);

      return $enfermeria->get()[0];

    }

    public function changeStatus($field, $id){
      $enfermeria = $this->getEnfermeria($id);
      if(count($enfermeria)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $enfermeria = $this->getEnfermeria($id);
      if(count($enfermeria)){
        $enfermeria->status = $num;
        $enfermeria->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $enfermeria = $this->getEnfermeria($id);
      if(count($enfermeria)){
        $img = public_path().'/uploads/'.$enfermeria->featured_img;
            if($enfermeria->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $enfermeria->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getEnfermeriaData($per_page, $request, $sortBy, $order){
      $enfermeria = Enfermeria::select(array('enfermeria.*'));

      // where condition
      if($request->input('nombre') != ""){
        $enfermeria->where('nombre','LIKE','%' . $request->input('nombre') . '%');
      }

      if($request->input('cedula') != ""){
        $enfermeria->where('cedula','LIKE','%' . $request->input('cedula') . '%');
      }

      if($request->input('rfc') != ""){
        $enfermeria->where('rfc','LIKE','%' . $request->input('rfc') . '%');
      }

      if($request->input('celular') != ""){
        $enfermeria->where('celular','LIKE','%' . $request->input('celular') . '%');
      }

      $enfermeria->where('status',1);

      // sort option
      if($sortBy!='' && $order!=''){
        $enfermeria->orderBy($sortBy, $order);
      } else{
        $enfermeria->orderBy('enfermeria.id', 'desc');
      }

      return $enfermeria->paginate($per_page);
    }

    public function getEnfermeriaExport($searchBy, $searchValue, $sortBy, $order){
      $enfermeria = Enfermeria::select(array('enfermeria.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $enfermeria->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $enfermeria->orderBy($sortBy, $order);
        } else{
          $enfermeria->orderBy('enfermeria.id', 'desc');
        }
        return $enfermeria->get();
    }

    public function updateEnfermeria($request){
      $id = $request->input('id');
      $enfermeria = Enfermeria::getEnfermeria($id);
      if(count($enfermeria)){

          $enfermeria->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
        	$enfermeria->celular = $request->input('celular')!="" ? $request->input('celular') : "";
        	$enfermeria->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
        	$enfermeria->cedula = $request->input('cedula')!="" ? $request->input('cedula') : "";
        	$enfermeria->curp = $request->input('curp')!="" ? $request->input('curp') : "";
        	$enfermeria->honorarios = $request->input('honorarios')!="" ? $request->input('honorarios') : 0;
        	$enfermeria->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
        	$enfermeria->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

                    // image upload code
                    $fotografia_name='';
                    $fotografia_file = $request->file('fotografia');
                    if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
                        $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
                        $fotografia_file->move('uploads/enfermeras',$fotografia_name);
                        $enfermeria->fotografia = $fotografia_name;
                    }

        	$enfermeria->status = $request->input('status')!="" ? $request->input('status') : "";

          $enfermeria->save();
          return true;
      } else{
        return false;
      }
    }

    public function addEnfermeria($request){
      $enfermeria = new Enfermeria;

        $enfermeria->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
      	$enfermeria->celular = $request->input('celular')!="" ? $request->input('celular') : "";
      	$enfermeria->rfc = $request->input('rfc')!="" ? $request->input('rfc') : "";
      	$enfermeria->cedula = $request->input('cedula')!="" ? $request->input('cedula') : "";
      	$enfermeria->curp = $request->input('curp')!="" ? $request->input('curp') : "";
      	$enfermeria->honorarios = $request->input('honorarios')!="" ? $request->input('honorarios') : 0;
      	$enfermeria->domicilio = $request->input('domicilio')!="" ? $request->input('domicilio') : "";
      	$enfermeria->fotografia = $request->input('fotografia')=="" ? $request->input('old_fotografia') : $request->input('fotografia') ;

                    // image upload code
                    $fotografia_name='';
                    $fotografia_file = $request->file('fotografia');
                    if(!is_null($fotografia_file) && in_array($fotografia_file->getClientOriginalExtension(), $this->allow_image)){
                        $fotografia_name = time().'_'.$fotografia_file->getClientOriginalName();
                        $fotografia_file->move('uploads/enfermeras',$fotografia_name);
                        $enfermeria->fotografia = $fotografia_name;
                    }

      	$enfermeria->status = $request->input('status')!="" ? $request->input('status') : "";

        $enfermeria->save();
        return $enfermeria->id;
    }

    public function misConsultorios($id) {

      $consultorios = DB::table('consultorios')->where('status',1);

      $consultorios->where('enfermera_id',$id);

      return $consultorios->get();


    }

    public function misConsultas($id) {

      $consultorios = DB::table('consultas')->where('status',1);

      $consultorios->where('enfermera_id',$id);

      return $consultorios->get();

    }

    public function misCitas($id) {

      $consultorios = DB::table('citas')->select(array('citas.*','pacientes.nombre AS paciente','consultorios.descripcion AS consultorio','consultorios.numero'));

      $consultorios->join('pacientes','pacientes.id','citas.paciente_id');
      $consultorios->join('consultorios','consultorios.id','citas.consultorio_id');
      $consultorios->join('medicos','medicos.id','citas.medico_id');

      $consultorios->where('citas.status',1);

      $consultorios->where('citas.enfermera_id',$id);

      return $consultorios->get();

    }


    public function misRondas($id) {

      return 0;

    }


}
