<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Ml_notifications extends Model
{
    protected $table = 'ml_notifications';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getMl_notifications($id){
      $data =  Ml_notifications::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getMl_notificationsView($id){
      $ml_notifications = Ml_notifications::select(array('ml_notifications.*'));
      $ml_notifications->where('ml_notifications.id', $id);
      
      return $ml_notifications->get()[0];

    }

    public function updateStatus($id, $num){
      $ml_notifications = $this->getMl_notifications($id);
      if(count($ml_notifications)){
        $ml_notifications->status = $num;
        $ml_notifications->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $ml_notifications = $this->getMl_notifications($id);
      if(count($ml_notifications)){
        $img = public_path().'/uploads/'.$ml_notifications->featured_img;
            if($ml_notifications->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $ml_notifications->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getMl_notificationsData($per_page, $request, $sortBy, $order){
      $ml_notifications = Ml_notifications::select(array('ml_notifications.*'));

      //join
        

        if(Auth::user()->comercio_id != 0) {
          $ml_notifications->where('ml_notifications.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $ml_notifications->where('ml_notifications.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $ml_notifications->where('ml_notifications.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $ml_notifications->orderBy('ml_notifications.id', 'desc');

        return $ml_notifications->paginate($per_page);
    }

    public function getMl_notificationsExport($request){
      $ml_notifications = Ml_notifications::select(array('ml_notifications.*'));

      //join
        

        // where condition
        if(Auth::user()->empresa_id != 0) {
          $ml_notifications->where('ml_notifications.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $ml_notifications->orderBy('ml_notifications.id', 'desc');

        return $ml_notifications->get();
    }

    public function updateMl_notifications($request){
      $id = $request->input('id');
      $ml_notifications = Ml_notifications::getMl_notifications($id);
      if(count($ml_notifications)){

          $ml_notifications->ml_id = $request->input('ml_id')!="" ? $request->input('ml_id') : "";
	$ml_notifications->resource = $request->input('resource')!="" ? $request->input('resource') : "";
	$ml_notifications->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
	$ml_notifications->application_id = $request->input('application_id')!="" ? $request->input('application_id') : "";
	$ml_notifications->attempts = $request->input('attempts')!="" ? $request->input('attempts') : "";
	$ml_notifications->sent = $request->input('sent')!="" ? $request->input('sent') : "";
	$ml_notifications->received = $request->input('received')!="" ? $request->input('received') : "";
	$ml_notifications->status = $request->input('status')!="" ? $request->input('status') : "";

          $ml_notifications->save();
          return true;
      } else{
        return false;
      }
    }

    public function addMl_notifications($request){
      $ml_notifications = new Ml_notifications;

        $ml_notifications->ml_id = $request->input('ml_id')!="" ? $request->input('ml_id') : "";
	$ml_notifications->resource = $request->input('resource')!="" ? $request->input('resource') : "";
	$ml_notifications->user_id = $request->input('user_id')!="" ? $request->input('user_id') : "";
	$ml_notifications->application_id = $request->input('application_id')!="" ? $request->input('application_id') : "";
	$ml_notifications->attempts = $request->input('attempts')!="" ? $request->input('attempts') : "";
	$ml_notifications->sent = $request->input('sent')!="" ? $request->input('sent') : "";
	$ml_notifications->received = $request->input('received')!="" ? $request->input('received') : "";
	$ml_notifications->status = $request->input('status')!="" ? $request->input('status') : "";

        $ml_notifications->save();
        return true;
    }
}
