<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommonModel extends Model
{

    use HasFactory;


    public function insertData($table,$data=array())
	{
		return DB::table($table)->insert($data);

	}

	public function updateData($table,$data =array(),$condition= array())
	{
			return DB::table($table)->where($condition)->update($data);

	}

	public function deleteData($table,$condition =array())
	{
		return DB::table($table)->where($condition)->delete();

	}


	public function all_fetch($table,$condition= array(),$column = 'id',$sort_order = 'asc',$limit = NULL,$offset = NULL)
	{
             $result = DB::table($table)
                        ->where($condition)
                        ->orderBy($column,$sort_order)
                        // ->skip($offset)->take($limit)
                        ->get();
             return   $result;
	}


	public function allCount($table,$condition= array())
	{
		return DB::table($table)->where($condition)->count();

	}

    public function fs($table,$condition= array())
	{

        return   DB::table($table)->where($condition)->first();

	}


    function hasPermission($menu_id){
		$user = $this->fs('admin',array('id'=>session()->get('adminID')));
		$ug = $this->fs('admin_group',array('id'=>$user->user_group_id));
		$permission = json_decode($ug->permission);
		$result = in_array($menu_id,$permission);
		   if($result){
			   return true;
		   }else{
			   return false;
		   }
	   }


	   function permission($url){
	   $link = 'admin/'.$url;
	   $row = $this->fs('menu',array('link'=>$link));
	   $result = $this->hasPermission($row->id);
		   if($result){
			   return true;
		   }else{
			   return false;
		   }
	   }

}
