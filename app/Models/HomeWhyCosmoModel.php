<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeWhyCosmoModel extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'icon',
        'sort_order',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'home_why_cosmo';
}
