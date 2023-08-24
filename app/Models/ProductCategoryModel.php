<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'sort_order',
        'thumbnail',
        'image',
        'banner_image',
        'video',
        'video_image',
        'before_image',
        'after_image',
        'show_on_home',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'product_category';
}
