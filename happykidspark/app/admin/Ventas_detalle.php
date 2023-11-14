<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Ventas_detalle extends Model
{
    protected $table = 'ventas_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function venta(){
      return $this->hasOne('\App\admin\Ventas', 'id', 'venta_id');
    }

    public function almacen(){
      return $this->hasOne('\App\admin\Almacenes', 'id', 'almacen_id');
    }

    public function producto(){
      return $this->hasOne('\App\admin\Productos', 'id', 'producto_id');
    }
}
