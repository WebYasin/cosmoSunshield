<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HomeBannerModel extends Model
{
    protected $fillable = [
        'title',
        'content',
        'video',
        'btn_name',
        'btn_link',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'home_banner';
}
