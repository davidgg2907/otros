<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Delegaciones extends Model
{
    protected $table = 'delegaciones';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->where('status',1)->get();
    }

    public function getDelegaciones($id){
      $data =  Delegaciones::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getDelegacionesView($id){
      $delegaciones = Delegaciones::select(array('delegaciones.*'));
      $delegaciones->where('delegaciones.id', $id);
      
      return $delegaciones->get()[0];

    }

    public function updateStatus($id, $num){
      $delegaciones = $this->getDelegaciones($id);
      if(count($delegaciones)){
        $delegaciones->status = $num;
        $delegaciones->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $delegaciones = $this->getDelegaciones($id);
      if(count($delegaciones)){
        $img = public_path().'/uploads/'.$delegaciones->featured_img;
            if($delegaciones->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $delegaciones->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getDelegacionesData($per_page, $request, $sortBy, $order){
      $delegaciones = Delegaciones::select(array('delegaciones.*'));

      //join
        

        // sort option
        $delegaciones->orderBy('delegaciones.id', 'desc');

        return $delegaciones->paginate($per_page);
    }

    public function updateDelegaciones($request){
      $id = $request->input('id');
      $delegaciones = Delegaciones::getDelegaciones($id);
      if(count($delegaciones)){

        $pre_seo = $request->input('nombre');

        $seo = str_replace('á','a',$pre_seo);
        $seo = str_replace('é','e',$seo);
        $seo = str_replace('í','i',$seo);
        $seo = str_replace('ó','o',$seo);
        $seo = str_replace('ú','u',$seo);
        $seo = str_replace('ñ','n',$seo);
  
        $seo = str_replace('Á','A',$seo);
        $seo = str_replace('É','E',$seo);
        $seo = str_replace('Í','I',$seo);
        $seo = str_replace('Ó','O',$seo);
        $seo = str_replace('Ú','U',$seo);
        $seo = str_replace('Ñ','N',$seo);
  
        $seo = str_replace(' ','-',$seo);
        
        $nomre = str_replace('á','a',$pre_seo);
        $nomre = str_replace('é','e',$nomre);
        $nomre = str_replace('í','i',$nomre);
        $nomre = str_replace('ó','o',$nomre);
        $nomre = str_replace('ú','u',$nomre);
        $nomre = str_replace('ñ','n',$nomre);
  
        $nomre = str_replace('Á','A',$nomre);
        $nomre = str_replace('É','E',$nomre);
        $nomre = str_replace('Í','I',$nomre);
        $nomre = str_replace('Ó','O',$nomre);
        $nomre = str_replace('Ú','U',$nomre);
        $nomre = str_replace('Ñ','N',$nomre);
  
  
          $delegaciones->nombre = $nomre;
          $delegaciones->seo = $seo;
          $delegaciones->status = $request->input('status')!="" ? $request->input('status') : "";

          $delegaciones->save();
          return true;
      } else{
        return false;
      }
    }

    public function addDelegaciones($request){
      $delegaciones = new Delegaciones;

      $pre_seo = $request->input('nombre');

      $seo = str_replace('á','a',$pre_seo);
      $seo = str_replace('é','e',$seo);
      $seo = str_replace('í','i',$seo);
      $seo = str_replace('ó','o',$seo);
      $seo = str_replace('ú','u',$seo);
      $seo = str_replace('ñ','n',$seo);

      $seo = str_replace('Á','A',$seo);
      $seo = str_replace('É','E',$seo);
      $seo = str_replace('Í','I',$seo);
      $seo = str_replace('Ó','O',$seo);
      $seo = str_replace('Ú','U',$seo);
      $seo = str_replace('Ñ','N',$seo);

      $seo = str_replace(' ','-',$seo);
      
      $nomre = str_replace('á','a',$pre_seo);
      $nomre = str_replace('é','e',$nomre);
      $nomre = str_replace('í','i',$nomre);
      $nomre = str_replace('ó','o',$nomre);
      $nomre = str_replace('ú','u',$nomre);
      $nomre = str_replace('ñ','n',$nomre);

      $nomre = str_replace('Á','A',$nomre);
      $nomre = str_replace('É','E',$nomre);
      $nomre = str_replace('Í','I',$nomre);
      $nomre = str_replace('Ó','O',$nomre);
      $nomre = str_replace('Ú','U',$nomre);
      $nomre = str_replace('Ñ','N',$nomre);


        $delegaciones->nombre = $nomre;
        $delegaciones->seo = $seo;
        $delegaciones->status = $request->input('status')!="" ? $request->input('status') : "";

        $delegaciones->save();
        return true;
    }
}
