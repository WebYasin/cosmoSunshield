<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTeamHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading1',
        'name1',
        'designation1',
        'description1',
        'image1',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps  = false;
    protected $table    = 'about_team_heading';
}
