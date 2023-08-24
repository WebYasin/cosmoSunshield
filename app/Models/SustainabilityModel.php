<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainabilityModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'sort_order',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'sustainability';
}
