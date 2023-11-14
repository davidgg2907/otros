<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getChat($id){
      $data =  Chat::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getChatView($id){
      $chat = Chat::select(array('chat.*'));
      $chat->where('chat.id', $id);

      return $chat->get()[0];

    }

    public function updateStatus($id, $num){
      $chat = $this->getChat($id);
      if(count($chat)){
        $chat->status = $num;
        $chat->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $chat = $this->getChat($id);
      if(count($chat)){
        $img = public_path().'/uploads/'.$chat->featured_img;
            if($chat->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $chat->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getChatData($per_page, $request, $sortBy, $order){
      $chat = Chat::select(array('chat.*'));

      //join


        if(Auth::user()->comercio_id != 0) {
          $chat->where('chat.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          $chat->where('chat.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          $chat->where('chat.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        $chat->orderBy('chat.id', 'desc');

        return $chat->paginate($per_page);
    }

    public function getChatExport($request){
      $chat = Chat::select(array('chat.*'));

      //join


        // where condition
        if(Auth::user()->empresa_id != 0) {
          $chat->where('chat.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        $chat->orderBy('chat.id', 'desc');

        return $chat->get();
    }

    public function updateChat($request){
      $id = $request->input('id');
      $chat = Chat::getChat($id);
      if(count($chat)){

          $chat->usr_envia_id = $request->input('usr_envia_id')!="" ? $request->input('usr_envia_id') : "";
	$chat->usr_recibe_id = $request->input('usr_recibe_id')!="" ? $request->input('usr_recibe_id') : "";
	$chat->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$chat->hora = $request->input('hora')!="" ? $request->input('hora') : "";
	$chat->mensaje = $request->input('mensaje')!="" ? $request->input('mensaje') : "";
	$chat->status = $request->input('status')!="" ? $request->input('status') : "";

          $chat->save();
          return true;
      } else{
        return false;
      }
    }

    public function addChat($request){
      $chat = new Chat;

        $chat->usr_envia_id = $request->input('usr_envia_id')!="" ? $request->input('usr_envia_id') : "";
	$chat->usr_recibe_id = $request->input('usr_recibe_id')!="" ? $request->input('usr_recibe_id') : "";
	$chat->fecha = $request->input('fecha')!="" ? $request->input('fecha') : "";
	$chat->hora = $request->input('hora')!="" ? $request->input('hora') : "";
	$chat->mensaje = $request->input('mensaje')!="" ? $request->input('mensaje') : "";
	$chat->status = $request->input('status')!="" ? $request->input('status') : "";

        $chat->save();
        return true;
    }

    public function envia(){
      return $this->hasOne('\App\admin\Users', 'id', 'usr_envia_id');
    }

    public function recibe(){
      return $this->hasOne('\App\admin\Users', 'id', 'usr_recibe_id');
    }
}
