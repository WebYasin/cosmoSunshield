<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityAssuranceModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'sort_order',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'quality_assurance';
}
