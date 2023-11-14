<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class InvLog extends Model
{
    protected $table = 'inventario_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

}
