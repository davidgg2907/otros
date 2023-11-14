<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $table = 'recruitment';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getRecruitment($id){
      $data =  Recruitment::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getRecruitmentView($id){
      $recruitment = Recruitment::select(array('recruitment.*'));
      $recruitment->where('recruitment.id', $id);
      
      return $recruitment->get()[0];

    }

    public function updateStatus($id, $num){
      $recruitment = $this->getRecruitment($id);
      if(count($recruitment)){
        $recruitment->status = $num;
        $recruitment->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $recruitment = $this->getRecruitment($id);
      if(count($recruitment)){
        $img = public_path().'/uploads/'.$recruitment->featured_img;
            if($recruitment->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $recruitment->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getRecruitmentData($per_page, $request, $sortBy, $order){
      $recruitment = Recruitment::select(array('recruitment.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $recruitment->where('recruitment.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $recruitment->where('recruitment.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $recruitment->where('recruitment.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $recruitment->orderBy('recruitment.id', 'desc');

        return $recruitment->paginate($per_page);
    }

    public function getRecruitmentExport($request){
      $recruitment = Recruitment::select(array('recruitment.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $recruitment->where('recruitment.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $recruitment->orderBy('recruitment.id', 'desc');

        return $recruitment->get();
    }

    public function updateRecruitment($request){
      $id = $request->input('id');
      $recruitment = Recruitment::getRecruitment($id);
      if(count($recruitment)){

          $recruitment->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$recruitment->edad = $request->input('edad')!="" ? $request->input('edad') : "";
	$recruitment->edo_civil = $request->input('edo_civil')!="" ? $request->input('edo_civil') : "";
	$recruitment->escolaridad = $request->input('escolaridad')!="" ? $request->input('escolaridad') : "";
	$recruitment->experiencia = $request->input('experiencia')!="" ? $request->input('experiencia') : "";
	$recruitment->habilidades = $request->input('habilidades')!="" ? $request->input('habilidades') : "";
	$recruitment->fortalezas = $request->input('fortalezas')!="" ? $request->input('fortalezas') : "";
	$recruitment->debilidades = $request->input('debilidades')!="" ? $request->input('debilidades') : "";
	$recruitment->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$recruitment->correo = $request->input('correo')!="" ? $request->input('correo') : "";
	$recruitment->cv = $request->input('cv')=="" ? $request->input('old_cv') : $request->input('cv') ;
	
                    // image upload code
                    $cv_name='';
                    $cv_file = $request->file('cv');
                    if(!is_null($cv_file) && in_array($cv_file->getClientOriginalExtension(), $this->allow_image)){
                        $cv_name = time().'_'.$cv_file->getClientOriginalName();
                        $cv_file->move('uploads',$cv_name);
                        $recruitment->cv = $cv_name;
                    }
                    

          $recruitment->save();
          return true;
      } else{
        return false;
      }
    }

    public function addRecruitment($request){
      $recruitment = new Recruitment;

        $recruitment->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$recruitment->edad = $request->input('edad')!="" ? $request->input('edad') : "";
	$recruitment->edo_civil = $request->input('edo_civil')!="" ? $request->input('edo_civil') : "";
	$recruitment->escolaridad = $request->input('escolaridad')!="" ? $request->input('escolaridad') : "";
	$recruitment->experiencia = $request->input('experiencia')!="" ? $request->input('experiencia') : "";
	$recruitment->habilidades = $request->input('habilidades')!="" ? $request->input('habilidades') : "";
	$recruitment->fortalezas = $request->input('fortalezas')!="" ? $request->input('fortalezas') : "";
	$recruitment->debilidades = $request->input('debilidades')!="" ? $request->input('debilidades') : "";
	$recruitment->telefono = $request->input('telefono')!="" ? $request->input('telefono') : "";
	$recruitment->correo = $request->input('correo')!="" ? $request->input('correo') : "";
	$recruitment->cv = $request->input('cv')=="" ? $request->input('old_cv') : $request->input('cv') ;
	
                    // image upload code
                    $cv_name='';
                    $cv_file = $request->file('cv');
                    if(!is_null($cv_file) && in_array($cv_file->getClientOriginalExtension(), $this->allow_image)){
                        $cv_name = time().'_'.$cv_file->getClientOriginalName();
                        $cv_file->move('uploads',$cv_name);
                        $recruitment->cv = $cv_name;
                    }
                    

        $recruitment->save();
        return true;
    }
}
