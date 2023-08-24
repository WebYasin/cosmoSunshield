<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SettingModel extends Model
{
    use HasFactory;
    protected $table = 'setting';

  function save_setting($data = array()){
        if ($data) {

        $code ='config';
        DB::table('setting')->where('code',$code)->delete();

        foreach ($data as $key => $value) {
          $array = array();
          $array['code'] = $code;
          $array['key'] = $key;
          $array['value'] = $value;
          if (is_array($value)) {
          $array['value'] = @json_encode($value);
          }else{
          $array['value'] = $value;
          }
           $result = DB::table('setting')->insert($array);
           }
          }
         return $result;
    }



}
