<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'areas';
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

    public function getAreas($id){
      $data =  Areas::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getAreasView($id){
      $areas = Areas::select(array('areas.*'));
      $areas->where('areas.id', $id);
      
      return $areas->get()[0];

    }

    public function changeStatus($field, $id){
      $areas = $this->getAreas($id);
      if(count($areas)){
        
            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $areas = $this->getAreas($id);
      if(count($areas)){
        $areas->status = $num;
        $areas->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $areas = $this->getAreas($id);
      if(count($areas)){
        $img = public_path().'/uploads/'.$areas->featured_img;
            if($areas->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $areas->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getAreasData($per_page, $request, $sortBy, $order){
      $areas = Areas::select(array('areas.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $areas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $areas->orderBy($sortBy, $order);
        } else{
          $areas->orderBy('areas.id', 'desc');
        }

        return $areas->paginate($per_page);
    }

    public function getAreasExport($searchBy, $searchValue, $sortBy, $order){
      $areas = Areas::select(array('areas.*'));

      //join
        

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $areas->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $areas->orderBy($sortBy, $order);
        } else{
          $areas->orderBy('areas.id', 'desc');
        }
        return $areas->get();
    }

    public function updateAreas($request){
      $id = $request->input('id');
      $areas = Areas::getAreas($id);
      if(count($areas)){

          $areas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$areas->status = $request->input('status')!="" ? $request->input('status') : "";

          $areas->save();
          return true;
      } else{
        return false;
      }
    }

    public function addAreas($request){
      $areas = new Areas;

        $areas->nombre = $request->input('nombre')!="" ? $request->input('nombre') : "";
	$areas->status = $request->input('status')!="" ? $request->input('status') : "";

        $areas->save();
        return true;
    }
}
