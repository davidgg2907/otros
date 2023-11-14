<?php

namespace App\admin;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class ==big_table== extends Model
{
    protected @@@table = '==table==';
    protected @@@primaryKey = 'id';
    public @@@timestamps = false;
    public @@@allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll(@@@table){
      return DB::table(@@@table)->where('status',1)->get();
    }

    public function get==big_table==(@@@id){
      @@@data =  ==big_table==::where('id', @@@id)->get();
      if(count(@@@data)){
        return @@@data[0];
      } else{
        return array();
      }
    }

    public function get==big_table==View(@@@id){
      $==table== = ==big_table==::select(array('==table==.*'==select_alias==));
      $==table==->where('==table==.id', $id);
      ==select_join==
      return @@@==table==->get()[0];

    }

    public function updateStatus(@@@id, @@@num){
      @@@==table== = @@@this->get==big_table==(@@@id);
      if(count($==table==)){
        $==table==->status = @@@num;
        $==table==->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne(@@@id){
      @@@==table== = @@@this->get==big_table==(@@@id);
      if(count(@@@==table==)){
        @@@img = public_path().'/uploads/'.@@@==table==->featured_img;
            if(@@@==table==->featured_img!='' && file_exists(@@@img)){
                unlink(@@@img);
            }
            @@@==table==->delete();
        return true;
      } else{
        return false;
      }
    }

    public function get==big_table==Data(@@@per_page, @@@request, @@@sortBy, @@@order){
      @@@==table== = ==big_table==::select(array('==table==.*'==select_alias==));

      //join
        ==select_join==

        if(Auth::user()->comercio_id != 0) {
          @@@==table==->where('==table==.comercio_id', Auth::user()->comercio_id);
        } else if(Auth::user()->entidad_id != 0) {
          @@@==table==->where('==table==.entidad_id', Auth::user()->entidad_id);
        } else if(Auth::user()->tarjeta_id != 0) {
          @@@==table==->where('==table==.tarjeta_id', Auth::user()->tarjeta_id);
        }

        // sort option
        @@@==table==->orderBy('==table==.id', 'desc');

        return @@@==table==->paginate(@@@per_page);
    }

    public function get==big_table==Export(@@@request){
      @@@==table== = ==big_table==::select(array('==table==.*'==select_alias==));

      //join
        ==select_join==

        // where condition
        if(Auth::user()->empresa_id != 0) {
          @@@==table==->where('==table==.empresa_id', Auth::user()->empresa_id);
        }

        // sort option
        @@@==table==->orderBy('==table==.id', 'desc');

        return @@@==table==->get();
    }

    public function update==big_table==(@@@request){
      @@@id = @@@request->input('id');
      @@@==table== = ==big_table==::get==big_table==(@@@id);
      if(count(@@@==table==)){

          ==set_value_arr==

          @@@==table==->save();
          return true;
      } else{
        return false;
      }
    }

    public function add==big_table==(@@@request){
      @@@==table== = new ==big_table==;

        ==set_value_arr==

        @@@==table==->save();
        return true;
    }
}
