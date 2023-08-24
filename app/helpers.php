<?php
use Illuminate\Support\Facades\DB;


function websetting(){
    $setting            = DB::table('setting')->where(array('code'=>'config'))->get();

    foreach($setting as $value){
     $wconfig[$value->key] = $value->value;
    }

    return $wconfig;

}


?>
