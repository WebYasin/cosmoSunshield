<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SustainabilityHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading1',
        'description1',
        'heading2',
        'description2',
        'image2',
        'heading3',
        'description3',
        'heading4',
        'description4',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'sustainability_heading';
}
