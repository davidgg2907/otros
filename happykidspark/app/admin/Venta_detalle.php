<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Venta_detalle extends Model
{
    protected $table = 'venta_detalle';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function venta(){
      return $this->hasOne('\App\admin\Ventas', 'id', 'venta_id');
    }

    public function productos(){
      return $this->hasOne('\App\admin\Productos', 'id', 'producto_id');
    }
}
