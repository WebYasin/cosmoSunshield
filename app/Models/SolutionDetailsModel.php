<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SolutionDetailsModel extends Model
{
    protected $fillable = [
        'solution_id',
        'title',
        'image',
        'sort_order',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'solution_details';

    function save_data($data = array())
    {

        if ($data) {

            $solution_id = $data['solution_id'];
            DB::table('solution_details')->where('solution_id',$solution_id)->delete();
            if (!empty($data['sort_order'])) {
                $num = count($data['sort_order']);
                for ($i = 0; $i < $num; $i++) {
                  $array['solution_id'] = $solution_id;

                  if (!empty($data['image'][$i])) {
                    $array['image']     = $data['image'][$i];
                  } else {
                    $array['image']     = @$data['old_image'][$i];
                  }

                  $array['title']       = $data['title'][$i];
                  $array['sort_order']  = $data['sort_order'][$i];
                  $array['status']      = $data['status'][$i];
                  $result = DB::table('solution_details')->insert($array);
                }
              }

        }
              return $result;

    }
}
