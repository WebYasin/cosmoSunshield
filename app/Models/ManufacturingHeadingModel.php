<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'heading1',
        'description1',
        'heading2',
        'description2',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'manufacturing_heading';
}
