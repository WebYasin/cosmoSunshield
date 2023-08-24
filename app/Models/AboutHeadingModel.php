<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading1',
        'description1',
        'image1',
        'heading2',
        'description2',
        'image2',
        'short_description2',
        'video2',
        'video_thumbnail',
        'heading3',
        'description3',
        'heading4',
        'description4',
        'image4',
        'heading5',
        'description5',
        'image5',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'about_heading';
}
