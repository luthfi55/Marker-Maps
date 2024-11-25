<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marker extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_name',
        'detail_address',
        'description',
        'latitude',
        'longitude',
        'category',
    ];
}
