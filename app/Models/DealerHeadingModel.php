<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerHeadingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'description1',
        'description2',
        'status',
        'create_date',
        'modify_date',
    ];

    public $timestamps = false;
    protected $table = 'dealer_network_heading';
}
