<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $table = 'assignments';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getAssignments($id){
      $data =  Assignments::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAssignmentsView($id){
      $assignments = Assignments::select(array('assignments.*' , 'employees.nombre'));
      $assignments->where('assignments.id', $id);
      $assignments->leftJoin('employees', 'assignments.employe_id', '=','employees.id');
      return $assignments->get()[0];

    }

    public function updateStatus($id, $num){
      $assignments = $this->getAssignments($id);
      if(count($assignments)){
        $assignments->status = $num;
        $assignments->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $assignments = $this->getAssignments($id);
      if(count($assignments)){
        $img = public_path().'/uploads/'.$assignments->featured_img;
            if($assignments->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $assignments->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAssignmentsData($per_page, $request, $sortBy, $order){
      $assignments = Assignments::select(array('assignments.*' , 'employees.nombre'));

      //join
        $assignments->leftJoin('employees', 'assignments.employe_id', '=','employees.id');

        if(Auth::user()->comercio_id != 0) {
          $assignments->where('assignments.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $assignments->where('assignments.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $assignments->where('assignments.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $assignments->orderBy('assignments.id', 'desc');

        return $assignments->paginate($per_page);
    }

    public function getAssignmentsExport($request){
      $assignments = Assignments::select(array('assignments.*' , 'employees.nombre'));

      //join
        $assignments->leftJoin('employees', 'assignments.employe_id', '=','employees.id');

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $assignments->where('assignments.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $assignments->orderBy('assignments.id', 'desc');

        return $assignments->get();
    }

    public function updateAssignments($request){
      $id = $request->input('id');
      $assignments = Assignments::getAssignments($id);
      if(count($assignments)){

          $assignments->employe_id = $request->input('employe_id')!="" ? $request->input('employe_id') : "";
	$assignments->tarea = $request->input('tarea')!="" ? $request->input('tarea') : "";
	$assignments->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
	$assignments->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
	$assignments->termina = $request->input('termina')!="" ? $request->input('termina') : "";
	$assignments->asignacion = $request->input('asignacion')!="" ? $request->input('asignacion') : "";
	$assignments->estatus = $request->input('estatus')!="" ? $request->input('estatus') : "";

          $assignments->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAssignments($request){
      $assignments = new Assignments;

        $assignments->employe_id = $request->input('employe_id')!="" ? $request->input('employe_id') : "";
	$assignments->tarea = $request->input('tarea')!="" ? $request->input('tarea') : "";
	$assignments->descripcion = $request->input('descripcion')!="" ? $request->input('descripcion') : "";
	$assignments->inicia = $request->input('inicia')!="" ? $request->input('inicia') : "";
	$assignments->termina = $request->input('termina')!="" ? $request->input('termina') : "";
	$assignments->asignacion = $request->input('asignacion')!="" ? $request->input('asignacion') : "";
	$assignments->estatus = $request->input('estatus')!="" ? $request->input('estatus') : "";

        $assignments->save();
        return true;
    }
}
