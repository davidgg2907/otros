<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $url_movs = '/';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

      Auth::user()->online = 1;
      Auth::user()->save();
      Session::put('lightdark',0);
      if(Auth::user()->perfil == 0) {
        return view('panels/admin', ['config' => $config]);

      } elseif(Auth::user()->perfil == 1) {

        return redirect('admin/ventas/poss');

      } elseif(Auth::user()->perfil == 2) {

        return redirect('admin/temporizador');

      }

    }

    public function lightDarkTheme() {

      $user = \App\admin\Users::find(Auth::user()->id);

      if($user->darktheme == 1) {
        $user->darktheme = 0;
      } else {
        $user->darktheme = 1;
      }
      $user->save();
    }


}
