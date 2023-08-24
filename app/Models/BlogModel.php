<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'cat_id',
        'short_description',
        'description',
        'image',
        'thumbnail',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'featured',
        'publish_date',
        'related',
        'show_on_home',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'blogs';
}
