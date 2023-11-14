<?php

namespace App\admin;
use DB;
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

    public function getPermissions($id){
      $data =  Permissions::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPermissionsView($id){
      $permissions = Permissions::select(array('permissions.*'));
      $permissions->where('permissions.id', $id);

      return $permissions->get()[0];

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

    public function changeStatus(@@@field, @@@id){
      @@@==table== = @@@this->get==big_table==(@@@id);
      if(count(@@@==table==)){
        ==change_status_fields==
            return true;
      } else{
        return false;
      }
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

        // where condition
        if(@@@searchBy!='' && @@@searchValue!=''){
          @@@==table==->where(@@@searchBy, 'like', '%'.@@@searchValue.'%');
        }

        // sort option
        if(@@@sortBy!='' && @@@order!=''){
          @@@==table==->orderBy(@@@sortBy, @@@order);
        } else{
          @@@==table==->orderBy('==table==.id', 'desc');
        }

        return @@@==table==->paginate(@@@per_page);
    }

    public function get==big_table==Export(@@@searchBy, @@@searchValue, @@@sortBy, @@@order){
      @@@==table== = ==big_table==::select(array('==table==.*'==select_alias==));

      //join
        ==select_join==

        // where condition
        if(@@@searchBy!='' && @@@searchValue!=''){
          @@@==table==->where(@@@searchBy, 'like', '%'.@@@searchValue.'%');
        }

        // sort option
        if(@@@sortBy!='' && @@@order!=''){
          @@@==table==->orderBy(@@@sortBy, @@@order);
        } else{
          @@@==table==->orderBy('==table==.id', 'desc');
        }
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
