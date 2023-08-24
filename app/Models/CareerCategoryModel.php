<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerCategoryModel extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'career_category';
}
