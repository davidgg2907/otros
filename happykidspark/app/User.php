<?php

namespace App;

use App\Group;
use App\admin\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rol','cliente_id','online'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken()
  {
      $this->api_token = str_random(60);
      $this->save();

      return $this->api_token;
  }

    public function identities() {
      return $this->hasMany('App\SocialIdentity');
    }


    public function permisos() {
      return $this->hasOne(\App\admin\Roles::class,'id','rol');

    }

    public function sucursal() {
      return $this->hasOne(\App\admin\Sucursales::class,'id','sucursal_id');
    }

}
