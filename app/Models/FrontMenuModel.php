<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontMenuModel extends Model
{
    use HasFactory;
    protected $fillable    = ['parent_id','title','name','subTitle','description','image','metaTitle','metaKeyword','metaDescription','status','link','header','footer','position','sort_order','sort_order_footer','create_date','modify_date'];

    public $timestamps = false;
    protected $table = 'front_menu';
}
