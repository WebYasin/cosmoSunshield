<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'cat_id',
        'location',
        'industry',
        'slug',
        'experience',
        'short_description',
        'description',
        'salary',
        'skills',
        'remuneration',
        'qualification',
        'show_in_career',
        'sort_order',
        'metaTitle',
        'metaKeyword',
        'metaDescription',
        'create_date',
        'modify_date',
        'status',
    ];

    public $timestamps = false;
    protected $table = 'careers';
}
