<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chat;
use DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use PDF;

class ChatController extends Controller
{
    public $v_fields=array('chat.usr_envia_id', 'chat.usr_recibe_id', 'chat.fecha', 'chat.hora', 'chat.mensaje', 'chat.status');
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function index(Request $request){

        // pagination per page
        $per_page = 25;
        // get by modal
        $chat = new \App\admin\Chat;

        $config = array();

        $config['titulo'] = "chat";

        $config['cancelar'] = url('/admin/chat');

        $config['breadcrumbs'][] = array(
            'text' => "Inicio",
            'href' => url('/'),
            'active' => false
        );

        $config['breadcrumbs'][] = array(
            'text' => "Listado de chat",
            'href' => url('/admin/chat'),
            'active' => false
        );

        $data = $chat->getChatData($per_page, $request, $sortBy, $order);

        return view('admin/chat/index', ['data'=>$data->appends(Input::except('page')), 'per_page'=>$per_page, 'links'=>$links,'config'=>$config,'query' =>$_SERVER['QUERY_STRING']]);
    }

    public function getAdd(Request $request){

      $chat = new \App\admin\Chat;

      $chat->usr_envia_id   = Auth::user()->id;
      $chat->usr_recibe_id  = $request->input('usr_envia_id');
      $chat->mensaje        = $request->input('mensaje');
      $chat->fecha          = date('Y-m-d');
      $chat->hora           = date('G:i:s');
      $chat->status         = 1;
      $chat->save();

      return array('error' =>0, 'msg' => '');

    }

    public function getEdit($id){

        \App\admin\Chat::whereIn('usr_envia_id',[Auth::user()->id,$id])
                               ->whereIn('usr_recibe_id',[Auth::user()->id,$id])
                               ->update(['status' => 0]);

        return array('error' =>0, 'msg' => '');

    }

    public function postEdit(Request $request){

        $this->validate($request, [

        ]);

        $chat = new \App\admin\Chat;
        if($chat->updateChat($request)){
            $request->session()->flash('message', 'chat Editado exitosamente!');
            $request->session()->flash('exito', 'true');
            return redirect()->action('admin\ChatController@index');
        } else{
            $request->session()->flash('message', 'Se ha producido un error inesperado, no se puede realizar la operación!');
            $request->session()->flash('fracaso', 'true');
            return redirect()->action('admin\ChatController@index');
        }
    }

    public function view($id){

      $chat = new \App\admin\Chat;

      $data = $chat->getChatView($id);

      $config = array();

      $config['titulo'] = "chat";

      $config['cancelar'] = url('/admin/chat');

      $config['breadcrumbs'][] = array(
          'text' => "Inicio",
          'href' => url('/'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Listado de chat",
          'href' => url('/admin/chat'),
          'active' => false
      );

      $config['breadcrumbs'][] = array(
          'text' => "Detalledel de chat",
          'href' => url('/admin/chat/view'),
          'active' => true
      );

      if(count($data)){

        return view('admin/chat/view', ['data'=>$data, 'config'=>$config]);

      } else{

        return view('admin/chat/view');

      }

    }

    public function getNewMessages(){

        $chats = \App\admin\Chat::where('usr_recibe_id',Auth::user()->id)->where('status',1)->count();
        return array('chats' => $chats,);
    }

    public function getContacts(){

      $html = '';

      foreach(\App\admin\Users::where('status',1)->where('id','!=',Auth::user()->id)->get() as $value) {

        $chats = \App\admin\Chat::where('usr_envia_id',$value->id)->where('usr_recibe_id',Auth::user()->id)->where('status',1)->count();

        $html .= '<div class="row" onclick="openChat(' . $value->id . ')" style="cursor:pointer; border-bottom:1px solid #E9E9E9; padding:10px 10px 10px;">
          <div class="col-md-2">';
            if($data->photo) {
              $html .= '<img src="' . asset('uploads/usuarios/' . $data->photo) . '" class="rounded-circle img-border gradient-summer" height="40" alt="Card image">';
            } else {
              $html .= '<img src="' . asset('images/portrait/small/avatar-s-4.jpg' . $data->photo) . '" class="rounded-circle img-border gradient-summer " height="40" alt="Card image">';
            }
          $html .= '</div>';
          $html .= '<div class="col-md-10"><p>';
          if($chats > 0) {
            $html .= '<small class="text-info" id="contentCountChats"> <b>' . $chats . '</b> <i class="fa fa-comment fa-lg"></i></small> ';
          }
          $html .= $value->name  .'</p>';
          if($value->online == 1) {
            $html .= '<p><span class="text-success">EN LINEA</span></p>';
          } else {
            $html .= '<p><span class="text-danger">DESCONECTADO</span></p>';
          }
        $html .='</div>
          </div>';

      }

      return array('error' => 0,'html' => $html);
    }

    public function getAjax($id){

      $html = '';

      $data = \App\admin\Chat::whereIn('usr_envia_id',[Auth::user()->id,$id])
                             ->whereIn('usr_recibe_id',[Auth::user()->id,$id])
                             ->where('status','!=',0)
                             ->get();

      if(count($data)) {

        foreach($data as $chats) {

          if(Auth::user()->id == $chats->usr_recibe_id) {
            $chats->status = 2;
            $chats->save();
          }

          $html .= '<div class="row" style="padding:10px;  margin-bottom:10px;width:99%;">';
          if($chats->usr_envia_id != Auth::user()->id) {

            $html .= '<div class="col-md-1">';
              if($chats->recibe->photo) {
                $html .= '<img src="' . asset('uploads/usuarios/' . $chats->recibe->photo) . '" class="rounded-circle img-border gradient-summer" height="40" alt="Card image">';
              } else {
                $html .= '<img src="' . asset('images/portrait/small/avatar-s-4.jpg') . '" class="rounded-circle img-border gradient-summer " height="40" alt="Card image">';
              }
            $html .= '</div>
            <div class="col-md-7" style="text-align: left; background:#FFF; padding:10px; border-radius:10px;">' . $chats->mensaje . '</div>
            <div class="col-md-4">
            </div>';

          } else {

            $html .= '<div class="col-md-4"></div>
              <div class="col-md-7" style="text-align: right; background-image:linear-gradient(80deg, #7367f0, #9e95f5); padding:10px; color:#FFF; border-radius:10px;">' .
                $chats->mensaje .
              '</div>
              <div class="col-md-1">';
              if($chats->envia->photo) {
                $html .= '<img src="' . asset('uploads/usuarios/' . $chats->envia->photo) . '" class="rounded-circle img-border gradient-summer" height="40" alt="Card image">';
              } else {
                $html .= '<img src="' . asset('images/portrait/small/avatar-s-4.jpg') . '" class="rounded-circle img-border gradient-summer " height="40" alt="Card image">';
              }
              $html .= '</div>';

          }
          $html .= '</div>';
        }

      } else {
        $html .= '<div class="row" style="padding:10px;  margin-bottom:10px;width:99%;">';
          $html .= '<div class="col-md-12 text-center">Se el primero en enviar un mensaje para saludar a este usuario</div>';
        $html .= '</div>';
      }

      return array('error' => 0,'msg' => "Se el primero en enviar un mensaje para saludar a este usuario",'html' => $html);
    }

}
