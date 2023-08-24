<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ProductCategoryFeatureModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'sort_order',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'product_category_feature';
    function save_data($data = array())
    {

        if ($data) {

            $category_id = $data['category_id'];
            DB::table('product_category_feature')->where('category_id',$category_id)->delete();
            if (!empty($data['sort_order'])) {
                $num = count($data['sort_order']);
                for ($i = 0; $i < $num; $i++) {
                  $array['category_id'] = $category_id;
                  $array['title']       = $data['title'][$i];
                  $array['sort_order']  = $data['sort_order'][$i];
                  $array['status']      = $data['status'][$i];
                  $result = DB::table('product_category_feature')->insert($array);
                }
              }

        }
              return true;

    }
}
