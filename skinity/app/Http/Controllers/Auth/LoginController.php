<?php

namespace App\Http\Controllers\Auth;

use Socialite;
Use App\User;
use App\SocialIdentity;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index()
    {
        //return view('auth/login');
    }

    public function redirectToProvider($provider) {
       return Socialite::driver($provider)->redirect();
    }

   public function handleProviderCallback($provider) {
       try {
           $user = Socialite::driver($provider)->user();
       } catch (Exception $e) {
           return redirect('/Login');
       }

       $authUser = $this->findOrCreateUser($user, $provider);

       Auth::login($authUser, true);
       return redirect('/cuenta');
   }

   public function findOrCreateUser($providerUser, $provider) {
     $user = User::whereEmail($providerUser->getEmail())->first();
     $ordenes = new \App\admin\Ordenes;

     if (! $user) {

       //Creamos al cliente y al usuario
       $clientes = new \App\admin\Clientes;
       //Creamos el cliente
       $clientes->nombre = $providerUser->getName();
       $clientes->status = 1;
       $clientes->save();

         $user = User::create([
             'email'        => $providerUser->getEmail(),
             'name'         => $providerUser->getName(),
             'rol'          => 0,
             'password'     => bcrypt($providerUser->getId()),
             'cliente_id'   => $clientes->id,
             'creativo_id'  => 0,
             'online'       => 0
         ]);
     }

     $ordenes->reasignaCarrito($user->cliente_id);

     return $user;
   }

}
