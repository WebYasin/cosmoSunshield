<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading1',
        'description1',
        'heading2',
        'description2',
        'heading3',
        'heading4',
        'description4',
        'image4',
        'image4_1',
        'btn_link4',
        'heading5',
        'description5',
        'btn_link5_1',
        'btn_link5_2',
        'image5',
        'heading6',
        'description6',
        'heading7',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'home_heading';
}
