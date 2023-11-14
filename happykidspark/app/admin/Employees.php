<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getEmployees($id){
      $data =  Employees::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getEmployeesView($id){
      $employees = Employees::select(array('employees.*'));
      $employees->where('employees.id', $id);
      
      return $employees->get()[0];

    }

    public function updateStatus($id, $num){
      $employees = $this->getEmployees($id);
      if(count($employees)){
        $employees->status = $num;
        $employees->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $employees = $this->getEmployees($id);
      if(count($employees)){
        $img = public_path().'/uploads/'.$employees->featured_img;
            if($employees->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $employees->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getEmployeesData($per_page, $request, $sortBy, $order){
      $employees = Employees::select(array('employees.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $employees->where('employees.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $employees->where('employees.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $employees->where('employees.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $employees->orderBy('employees.id', 'desc');

        return $employees->paginate($per_page);
    }

    public function getEmployeesExport($request){
      $employees = Employees::select(array('employees.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $employees->where('employees.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $employees->orderBy('employees.id', 'desc');

        return $employees->get();
    }

    public function updateEmployees($request){
      $id = $request->input('id');
      $employees = Employees::getEmployees($id);
      if(count($employees)){

          $employees->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$employees->apellidos = $request->input('apellidos')!="" ? $request->input('apellidos') : "";
	$employees->posicion = $request->input('posicion')!="" ? $request->input('posicion') : "";

          $employees->save();
          return true;
      } else{
        return false;
      }
    }

    public function addEmployees($request){
      $employees = new Employees;

        $employees->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$employees->apellidos = $request->input('apellidos')!="" ? $request->input('apellidos') : "";
	$employees->posicion = $request->input('posicion')!="" ? $request->input('posicion') : "";

        $employees->save();
        return true;
    }
}
