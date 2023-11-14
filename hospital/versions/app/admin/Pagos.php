<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';
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

    public function getPagos($id){
      $data =  Pagos::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPagosView($id){
      $pagos = Pagos::select(array('pagos.*' , 'pacientes.nombre' , 'consultas.fecha' , 'hospitalizacion.fecha_ingreso' , 'medicos.nombre' , 'enfermeria.nombre'));
      $pagos->where('pagos.id', $id);
      $pagos->leftJoin('pacientes', 'pagos.paciente_id', '=','pacientes.id');$pagos->leftJoin('consultas', 'pagos.consulta_id', '=','consultas.id');$pagos->leftJoin('hospitalizacion', 'pagos.hospitalizacion_id', '=','hospitalizacion.id');$pagos->leftJoin('medicos', 'pagos.medico_id', '=','medicos.id');$pagos->leftJoin('enfermeria', 'pagos.enfermera_id', '=','enfermeria.id');
      return $pagos->get()[0];

    }

    public function changeStatus($field, $id){
      $pagos = $this->getPagos($id);
      if(count($pagos)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $pagos = $this->getPagos($id);
      if(count($pagos)){
        $pagos->status = $num;
        if($num == 2) {
          $pagos->fecha_pago = date('Y-m-d H:i:s');
        }
        $pagos->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $pagos = $this->getPagos($id);
      if(count($pagos)){
        $img = public_path().'/uploads/'.$pagos->featured_img;
            if($pagos->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $pagos->delete();
        return true;
      } else{
        return false;
      }
    }

    public function ultimos() {

      $pagos = Pagos::limit(5)->orderBy('id','DESC');

      return $pagos->get();

    }

    public function getPagosData($per_page, $request, $sortBy, $order){
      $pagos = Pagos::select(array('pagos.*' , 'pacientes.nombre' , 'consultas.fecha' , 'hospitalizacion.fecha_ingreso' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $pagos->leftJoin('pacientes', 'pagos.paciente_id', '=','pacientes.id');$pagos->leftJoin('consultas', 'pagos.consulta_id', '=','consultas.id');$pagos->leftJoin('hospitalizacion', 'pagos.hospitalizacion_id', '=','hospitalizacion.id');$pagos->leftJoin('medicos', 'pagos.medico_id', '=','medicos.id');$pagos->leftJoin('enfermeria', 'pagos.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $pagos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $pagos->orderBy('pagos.id', 'DESC');

        return $pagos->paginate($per_page);
    }

    public function getPagosExport($searchBy, $searchValue, $sortBy, $order){
      $pagos = Pagos::select(array('pagos.*' , 'pacientes.nombre' , 'consultas.fecha' , 'hospitalizacion.fecha_ingreso' , 'medicos.nombre' , 'enfermeria.nombre'));

      //join
        $pagos->leftJoin('pacientes', 'pagos.paciente_id', '=','pacientes.id');$pagos->leftJoin('consultas', 'pagos.consulta_id', '=','consultas.id');$pagos->leftJoin('hospitalizacion', 'pagos.hospitalizacion_id', '=','hospitalizacion.id');$pagos->leftJoin('medicos', 'pagos.medico_id', '=','medicos.id');$pagos->leftJoin('enfermeria', 'pagos.enfermera_id', '=','enfermeria.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $pagos->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $pagos->orderBy($sortBy, $order);
        } else{
          $pagos->orderBy('pagos.id', 'desc');
        }
        return $pagos->get();
    }

    public function updatePagos($request){
      $id = $request->input('id');
      $pagos = Pagos::getPagos($id);
      if(count($pagos)){

        $pagos->fecha_pago = date('Y-m-d H:i:s');
	      $pagos->monto = $request->input('costo_total')!="" ? $request->input('costo_total') : "";
	      $pagos->status = 2;

          $pagos->save();
          return true;
      } else{
        return false;
      }
    }

    public function addPagos($request){

      $pagos = new Pagos;

        $pagos->paciente_id =  $request['paciente_id'];
      	$pagos->consulta_id =  $request['consulta_id'];
      	$pagos->hospitalizacion_id =   $request['hospitalizacion_id'];
        $pagos->urgencia_id     =   $request['urgencia_id'];
      	$pagos->medico_id =  $request['medico_id'];
      	$pagos->enfermera_id =  $request['enfermera_id'];
      	$pagos->fecha_apertura =  $request['fecha_apertura'];
      	$pagos->fecha_pago =  $request['fecha_pago'];
      	$pagos->monto =  $request['monto'];
        $pagos->servicios =  $request['servicios'];
      	$pagos->status =  $request['status'];

        $pagos->save();
        return $pagos->id;
    }

    public function doctor() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');

    }

    public function paciente() {

      return $this->hasOne('\App\admin\Pacientes', 'id', 'paciente_id');

    }

    public function consulta() {

      return $this->hasOne('\App\admin\Consultas', 'id', 'consulta_id');

    }

    public function hospitalizacion() {

      return $this->hasOne('\App\admin\Hospitalizacion', 'id', 'hospitalizacion_id');
    }

    public function urgencia() {

      return $this->hasOne('\App\admin\Urgencias', 'id', 'urgencia_id');
    }

}
