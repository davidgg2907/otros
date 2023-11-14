<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class UrgServ extends Model
{
    protected $table = 'urgencias_servicios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

}

class Urgencias extends Model
{
    protected $table = 'urgencias';
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

    public function getUrgencias($id){
      $data =  Urgencias::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getUrgenciasView($id){
      $urgencias = Urgencias::select(array('urgencias.*'));
      $urgencias->where('urgencias.id', $id);

      return $urgencias->get()[0];

    }

    public function changeStatus($field, $id){
      $urgencias = $this->getUrgencias($id);
      if(count($urgencias)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $urgencias = $this->getUrgencias($id);
      if(count($urgencias)){
        $urgencias->status = $num;
        $urgencias->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $urgencias = $this->getUrgencias($id);
      if(count($urgencias)){
        $img = public_path().'/uploads/'.$urgencias->featured_img;
            if($urgencias->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $urgencias->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getUrgenciasData($per_page, $request, $sortBy, $order){
      $urgencias = Urgencias::select(array('urgencias.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $urgencias->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $urgencias->where('urgencias.status', 1);


        // sort option
        if($sortBy!='' && $order!=''){
          $urgencias->orderBy($sortBy, $order);
        } else{
          $urgencias->orderBy('urgencias.id', 'desc');
        }

        return $urgencias->paginate($per_page);
    }

    public function getUrgenciasExport($searchBy, $searchValue, $sortBy, $order){
      $urgencias = Urgencias::select(array('urgencias.*'));

      //join


        // where condition
        if($searchBy!='' && $searchValue!=''){
          $urgencias->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $urgencias->orderBy($sortBy, $order);
        } else{
          $urgencias->orderBy('urgencias.id', 'desc');
        }
        return $urgencias->get();
    }

    public function updateUrgencias($request){
      $id = $request->input('id');
      $urgencias = Urgencias::getUrgencias($id);
      if(count($urgencias)){

          $urgencias->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
        	$urgencias->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
        	$urgencias->hora = $request->input('hora')!="" ? $request->input('hora') : "";
        	$urgencias->medico_nombre = $request->input('medico')!="" ? $request->input('medico') : "";
          $urgencias->paciente = $request->input('paciente')!="" ? $request->input('paciente') : "";
        	$urgencias->edad = $request->input('edad')!="" ? $request->input('edad') : "";
        	$urgencias->peso = $request->input('peso')!="" ? $request->input('peso') : "";
        	$urgencias->talla = $request->input('talla')!="" ? $request->input('talla') : "";
        	$urgencias->motivo = $request->input('motivo')!="" ? $request->input('motivo') : "";
        	$urgencias->padecimiento = $request->input('padecimiento')!="" ? $request->input('padecimiento') : "";
        	$urgencias->heredo_diabetes = $request->input('heredo_diabetes')!="" ? $request->input('heredo_diabetes') : "";
        	$urgencias->heredo_hipertencion = $request->input('heredo_hipertencion')!="" ? $request->input('heredo_hipertencion') : "";
        	$urgencias->heredo_cancer = $request->input('heredo_cancer')!="" ? $request->input('heredo_cancer') : "";
        	$urgencias->heredo_convulsiones = $request->input('heredo_convulsiones')!="" ? $request->input('heredo_convulsiones') : "";
        	$urgencias->heredo_lar = $request->input('heredo_lar')!="" ? $request->input('heredo_lar') : "";
        	$urgencias->heredo_leulin = $request->input('heredo_leulin')!="" ? $request->input('heredo_leulin') : "";
        	$urgencias->patolo_diabetes = $request->input('patolo_diabetes')!="" ? $request->input('patolo_diabetes') : "";
        	$urgencias->patolo_hipertencion = $request->input('patolo_hipertencion')!="" ? $request->input('patolo_hipertencion') : "";
        	$urgencias->patolo_cancer = $request->input('patolo_cancer')!="" ? $request->input('patolo_cancer') : "";
        	$urgencias->patolo_otros = $request->input('patolo_otros')!="" ? $request->input('patolo_otros') : "";
        	$urgencias->operaciones = $request->input('operaciones')!="" ? $request->input('operaciones') : "";
        	$urgencias->transfuciones = $request->input('transfuciones')!="" ? $request->input('transfuciones') : "";
        	$urgencias->fracturas = $request->input('fracturas')!="" ? $request->input('fracturas') : "";
        	$urgencias->alergias = $request->input('alergias')!="" ? $request->input('alergias') : "";
          $urgencias->status = 1;

          $urgencias->save();
          return true;
      } else{
        return false;
      }
    }

    public function addUrgencias($request){
      $urgencias = new Urgencias;

        $urgencias->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "0";
      	$urgencias->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
      	$urgencias->hora = $request->input('hora')!="" ? $request->input('hora') : "";
        $urgencias->medico_nombre = $request->input('medico')!="" ? $request->input('medico') : "";
        $urgencias->paciente = $request->input('paciente')!="" ? $request->input('paciente') : "";
      	$urgencias->edad = $request->input('edad')!="" ? $request->input('edad') : "";
      	$urgencias->peso = $request->input('peso')!="" ? $request->input('peso') : "";
      	$urgencias->talla = $request->input('talla')!="" ? $request->input('talla') : "";
      	$urgencias->motivo = $request->input('motivo')!="" ? $request->input('motivo') : "";
      	$urgencias->padecimiento = $request->input('padecimiento')!="" ? $request->input('padecimiento') : "";
      	$urgencias->heredo_diabetes = $request->input('heredo_diabetes')!="" ? $request->input('heredo_diabetes') : "";
      	$urgencias->heredo_hipertencion = $request->input('heredo_hipertencion')!="" ? $request->input('heredo_hipertencion') : "";
      	$urgencias->heredo_cancer = $request->input('heredo_cancer')!="" ? $request->input('heredo_cancer') : "";
      	$urgencias->heredo_convulsiones = $request->input('heredo_convulsiones')!="" ? $request->input('heredo_convulsiones') : "";
      	$urgencias->heredo_lar = $request->input('heredo_lar')!="" ? $request->input('heredo_lar') : "";
      	$urgencias->heredo_leulin = $request->input('heredo_leulin')!="" ? $request->input('heredo_leulin') : "";
      	$urgencias->patolo_diabetes = $request->input('patolo_diabetes')!="" ? $request->input('patolo_diabetes') : "";
      	$urgencias->patolo_hipertencion = $request->input('patolo_hipertencion')!="" ? $request->input('patolo_hipertencion') : "";
      	$urgencias->patolo_cancer = $request->input('patolo_cancer')!="" ? $request->input('patolo_cancer') : "";
      	$urgencias->patolo_otros = $request->input('patolo_otros')!="" ? $request->input('patolo_otros') : "";
      	$urgencias->operaciones = $request->input('operaciones')!="" ? $request->input('operaciones') : "";
      	$urgencias->transfuciones = $request->input('transfuciones')!="" ? $request->input('transfuciones') : "";
      	$urgencias->fracturas = $request->input('fracturas')!="" ? $request->input('fracturas') : "";
      	$urgencias->alergias = $request->input('alergias')!="" ? $request->input('alergias') : "";

        $urgencias->subtotal = 0;
        $urgencias->iva = 0;
        $urgencias->total = 0;
        $urgencias->pagado = 0;
        $urgencias->pendiente = 0;



      	$urgencias->status = 1;

        $urgencias->save();
        return true;
    }

    public function actualizaTotales($request) {

      $id = $request->input('urgencia_id');
      $urgencia =Urgencias::getUrgencias($id);
      if(count($urgencia)){

          $urgencia->subtotal = $request->input('subtotal')!="" ? $request->input('subtotal') : "";
          $urgencia->iva = $request->input('iva')!="" ? $request->input('iva') : "";
          $urgencia->total = $request->input('total')!="" ? $request->input('total') : "";
          $urgencia->pendiente = $hospitalizacion->total - $hospitalizacion->pagado;

          $urgencia->save();
          return true;
      } else{
        return false;
      }

    }

    public function abonarAcuenta($id, $request) {

      $urgencia = Urgencias::getUrgencias($id);

      if(count($urgencia)){

        $urgencia->pendiente   = $request->input('pendiente');
        $urgencia->pagado      = $request->input('pagado');

        if($request->input('pendiente') <= 0) {

          $urgencia->status = 2;

        }

        $urgencia->save();

      }
    }

    public function addServicios($request) {

      foreach($request->input('servicios') as $value) {

        $servicios = new UrgServ;

        $servicios->urgencia_id = $request->input('urgencia_id');

        $servicios->fecha_servicio  = date('Y-m-d');
        $servicios->servicio_id     = $value['concepto_id'];
        $servicios->pago_id         = null;
        $servicios->descripcion     = $value['concepto'];
        $servicios->cantidad        = $value['cantidad'];
        $servicios->precio          = $value['precio'];
        $servicios->iva             = $value['iva'];
        $servicios->importe         = $value['importe'];
        $servicios->status          = 1;
        $servicios->save();

      }

    }

    public function getServicios($urgencia_id) {

      $data = UrgServ::where('urgencia_id',$urgencia_id)->where('status','!=',0)->get();

      if(count($data)) {
        return $data;
      } else {
        return array();
      }

    }

    public function getServicio($id) {

      $data = UrgServ::where('id',$id)->get();

      if(count($data)) {
        return $data[0];
      } else {
        return array();
      }

    }

    public function sumaServicios($urgencia_id) {

      $query = UrgServ::select(DB::raw('SUM(importe) as importes'),DB::raw('SUM(iva) as ivas','hospitalizacion_id'))
                        ->where('urgencia_id',$urgencia_id)
                        ->groupBy('hospitalizacion_id');

      $data = $query->get();

      return $data[0];

    }

    public function bajaServicio($id) {

      $data = UrgServ::where('id',$id)->update(['status' => 0]);
      return true;
    }

    public function liquidaServicio($id,$pago_id) {

      $data = UrgServ::where('id',$id)->update(['status' => 2,'pago_id' => $pago_id]);
      return true;
    }

    public function medico() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');

    }
}
