<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'solution_id',
        'sort_order',
        'image',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'product';
}
