<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class Servicios extends Model
{
    protected $table = 'hospitalizacion_servicios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');
}

class Hospitalizacion extends Model
{
    protected $table = 'hospitalizacion';
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

    public function getHospitalizacion($id){
      $data =  Hospitalizacion::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getHospitalizacionView($id){
      $hospitalizacion = Hospitalizacion::select(array('hospitalizacion.*' , 'medicos.nombre' , 'pacientes.nombre' , 'cuartos.descripcion'));
      $hospitalizacion->where('hospitalizacion.id', $id);
      $hospitalizacion->leftJoin('medicos', 'hospitalizacion.medico_id', '=','medicos.id');$hospitalizacion->leftJoin('pacientes', 'hospitalizacion.paciente_id', '=','pacientes.id');$hospitalizacion->leftJoin('cuartos', 'hospitalizacion.cuarto_id', '=','cuartos.id');
      return $hospitalizacion->get()[0];

    }

    public function changeStatus($field, $id){
      $hospitalizacion = $this->getHospitalizacion($id);
      if(count($hospitalizacion)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $hospitalizacion = $this->getHospitalizacion($id);
      if(count($hospitalizacion)){
        $hospitalizacion->status = $num;
        if($num == 1) {
          $hospitalizacion->fecha_alta = date('Y-m-d H:i:s');
        }
        $hospitalizacion->save();
        return true;
      } else{
        return false;
      }
    }

    public function deleteOne($id){
      $hospitalizacion = $this->getHospitalizacion($id);
      if(count($hospitalizacion)){
        $img = public_path().'/uploads/'.$hospitalizacion->featured_img;
            if($hospitalizacion->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $hospitalizacion->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getHospitalizacionData($per_page, $request, $sortBy, $order){
      $hospitalizacion = Hospitalizacion::select(array('hospitalizacion.*' , 'medicos.nombre' , 'pacientes.nombre' , 'cuartos.descripcion'));

      //join
        $hospitalizacion->leftJoin('medicos', 'hospitalizacion.medico_id', '=','medicos.id');$hospitalizacion->leftJoin('pacientes', 'hospitalizacion.paciente_id', '=','pacientes.id');$hospitalizacion->leftJoin('cuartos', 'hospitalizacion.cuarto_id', '=','cuartos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $hospitalizacion->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        if((int)Auth::user()->medico_id != 0) {

          $hospitalizacion->where('hospitalizacion.medico_id',Auth::user()->medico_id);

        }

        $hospitalizacion->where('hospitalizacion.status',1);


        // sort option
        if($sortBy!='' && $order!=''){
          $hospitalizacion->orderBy($sortBy, $order);
        } else{
          $hospitalizacion->orderBy('hospitalizacion.status', 'ASC');
          $hospitalizacion->orderBy('hospitalizacion.id', 'ASC');
        }

        return $hospitalizacion->paginate($per_page);
    }

    public function getHospitalizacionExport($searchBy, $searchValue, $sortBy, $order){
      $hospitalizacion = Hospitalizacion::select(array('hospitalizacion.*' , 'medicos.nombre' , 'pacientes.nombre' , 'cuartos.descripcion'));

      //join
        $hospitalizacion->leftJoin('medicos', 'hospitalizacion.medico_id', '=','medicos.id');$hospitalizacion->leftJoin('pacientes', 'hospitalizacion.paciente_id', '=','pacientes.id');$hospitalizacion->leftJoin('cuartos', 'hospitalizacion.cuarto_id', '=','cuartos.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $hospitalizacion->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $hospitalizacion->orderBy($sortBy, $order);
        } else{
          $hospitalizacion->orderBy('hospitalizacion.id', 'desc');
        }
        return $hospitalizacion->get();
    }

    public function updateHospitalizacion($request){
      $id = $request->input('hospitalizacion_id');
      $hospitalizacion = Hospitalizacion::getHospitalizacion($id);
      if(count($hospitalizacion)){

          $hospitalizacion->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
        	$hospitalizacion->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
        	$hospitalizacion->cuarto_id = $request->input('cuarto_id')!="" ? $request->input('cuarto_id') : "";

          $hospitalizacion->save();
          return true;
      } else{
        return false;
      }
    }

    public function addHospitalizacion($request){

      $hospitalizacion = new Hospitalizacion;

      $hospitalizacion->medico_id = $request->input('medico_id')!="" ? $request->input('medico_id') : "";
    	$hospitalizacion->paciente_id = $request->input('paciente_id')!="" ? $request->input('paciente_id') : "";
    	$hospitalizacion->cuarto_id = $request->input('cuarto_id')!="" ? $request->input('cuarto_id') : "";
      $hospitalizacion->motivo = $request->input('motivo')!="" ? $request->input('motivo') : "";
      $hospitalizacion->fecha_ingreso = date('Y-m-d H:i:s');
    	$hospitalizacion->fecha_alta = null;
    	$hospitalizacion->subtotal = $request->input('precio');
    	$hospitalizacion->iva = $request->input('iva_hospitalizacion');
    	$hospitalizacion->total = $request->input('importe');

      $hospitalizacion->pendiente = $request->input('importe');
      $hospitalizacion->pagado = 0;

    	$hospitalizacion->status = $request->input('status')!="" ? $request->input('status') : "";

      $hospitalizacion->save();

      $id = $hospitalizacion->id;

      //Agregamos el servicio de hospedaje del dia 1
      $servicios = new Servicios;

      $servicios->hospitalizacion_id  = $id;
      $servicios->fecha_servicio      = date('Y-m-d');
      $servicios->descripcion         = $request->input('concepto');
      $servicios->cantidad            = $request->input('cantidad');
      $servicios->precio              = $request->input('precio');
      $servicios->iva                 = $request->input('iva_hospitalizacion');
      $servicios->importe             = $request->input('importe');
      $servicios->status              = 1;
      $servicios->save();

      return true;

    }

    public function conteoIngresos() {

      $conteo = Hospitalizacion::select(DB::raw('count(*) as total, status'));

      if(Auth::user()->medico_id != 0) {
        $conteo->where('medico_id', Auth::user()->medico_id);
      }

      if(Auth::user()->asistente_id != 0) {

        $asistente = \App\admin\Asistentes::find(Auth::user()->asistente_id);

        $doctores = explode(',',$asistente->doctores);

        $conteo->whereIn('medico_id', $doctores);

      }

      $conteo->groupBy('status');

      $data = $conteo->get();

      if(count($data)) {
        return $data;
      } else {
        return array();
      }

    }

    public function actualizaTotales($request) {

      $id = $request->input('hospitalizacion_id');
      $hospitalizacion = Hospitalizacion::getHospitalizacion($id);
      if(count($hospitalizacion)){

        	$hospitalizacion->subtotal = $request->input('subtotal')!="" ? $request->input('subtotal') : "";
        	$hospitalizacion->iva = $request->input('iva')!="" ? $request->input('iva') : "";
        	$hospitalizacion->total = $request->input('total')!="" ? $request->input('total') : "";
          $hospitalizacion->pendiente = $hospitalizacion->total - $hospitalizacion->pagado;

          $hospitalizacion->save();
          return true;
      } else{
        return false;
      }

    }

    public function abonarAcuenta($id, $request) {

      $hospitalizacion = Hospitalizacion::getHospitalizacion($id);

      if(count($hospitalizacion)){

        $hospitalizacion->pendiente   = $request->input('pendiente');
        $hospitalizacion->pagado      = $request->input('pagado');

        if($request->input('pendiente') <= 0) {

          $hospitalizacion->status = 2;

        }

        $hospitalizacion->save();

      }
    }

    public function actualizaHospedajes() {

      $empresa = \App\admin\Empresas::find(1);

      $data = Hospitalizacion::select('hospitalizacion.fecha_ingreso',

                                      'hospitalizacion_servicios.id as servicio',

                                      'hospitalizacion_servicios.precio',

                                      'hospitalizacion_servicios.hospitalizacion_id')
                             ->join('hospitalizacion_servicios','hospitalizacion_servicios.hospitalizacion_id','=','hospitalizacion.id')
                             ->where('hospitalizacion.status',1)
                             ->where('hospitalizacion_servicios.descripcion',$empresa->hospedaje)
                             ->where('hospitalizacion.fecha_ingreso','<',date('Y-m-d 00:00:00'))
                             ->get();


      foreach($data as $value) {

        $hospitalizacion  = $this->getHospitalizacion($value->hospitalizacion_id);
        $servicio         = $this->getServicio($value->servicio);
        $subtotal         = 0;
        $iva              = 0;
        $total            = 0;

        //Calculamos los dias de hospedaje
        $cDate  = Carbon::parse($value->fecha_ingreso);

        $days   = Carbon::parse(Carbon::now())->diffInDays(date('Y-m-d 00:00:00',strtotime($value->fecha_ingreso)));

        $subtotal = $value->precio * $days;

        if($empresa->hospedaje_iva == 1) {
          $iva = $subtotal * ($empresa->impuesto/100);
          $total = $subtotal + $iva;
        } else {
          $total = $subtotal;
        }
        $servicio->cantidad     = $days;
        $servicio->iva          = $iva;
        $servicio->importe      = $total;
        $servicio->save();

        //sumamos todos los servicios y actualizamos los importes
        $totales = $this->sumaServicios($value->hospitalizacion_id);

        //Actualizamos los importes totales de la hospitalizacion
        $hospitalizacion->subtotal  = ($totales['importes'] - $totales['ivas']);
        $hospitalizacion->iva       = $totales['ivas'];
        $hospitalizacion->total     = $totales['importes'];

        $hospitalizacion->pendiente = $totales['importes'] - $hospitalizacion->pagado;
        $hospitalizacion->save();
      }

    }


    public function doctor() {

      return $this->hasOne('\App\admin\Medicos', 'id', 'medico_id');

    }

    public function paciente() {

      return $this->hasOne('\App\admin\Pacientes', 'id', 'paciente_id');

    }

    public function habitacion() {

      return $this->hasOne('\App\admin\Cuartos', 'id', 'cuarto_id');

    }

    public function addServicios($request) {

      foreach($request->input('servicios') as $value) {

        $servicios = new Servicios;

        $servicios->hospitalizacion_id = $request->input('hospitalizacion_id');

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

    public function getServicios($hospitalizacion) {

      $data = Servicios::where('hospitalizacion_id',$hospitalizacion)->where('status','!=',0)->get();

      if(count($data)) {
        return $data;
      } else {
        return array();
      }

    }

    public function getServicio($id) {

      $data = Servicios::where('id',$id)->get();

      if(count($data)) {
        return $data[0];
      } else {
        return array();
      }

    }

    public function sumaServicios($hospitalizacion_id) {

      $query = Servicios::select(DB::raw('SUM(importe) as importes'),DB::raw('SUM(iva) as ivas','hospitalizacion_id'))
                        ->where('hospitalizacion_id',$hospitalizacion_id)
                        ->groupBy('hospitalizacion_id');

      $data = $query->get();

      return $data[0];

    }

    public function bajaServicio($id) {

      $data = Servicios::where('id',$id)->update(['status' => 0]);
      return true;
    }

    public function liquidaServicio($id,$pago_id) {

      $data = Servicios::where('id',$id)->update(['status' => 2,'pago_id' => $pago_id]);
      return true;
    }

}
