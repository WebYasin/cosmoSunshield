<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading1',
        'description1',
        'heading2',
        'heading2_1',
        'description2',
        'name2',
        'img2',
        'heading3',
        'description3',
        'heading4',
        'description4',
        'heading5',
        'description5',
        'btn_name',
        'btn_link',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'career_heading';
}
