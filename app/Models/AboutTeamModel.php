<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTeamModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'designation',
        'description',
        'thumbnail',
        'image',
        'sort_order',
        'show_on_top',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'about_team';
}
