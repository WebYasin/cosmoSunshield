<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading1',
        'description1',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'solution_heading';
}
