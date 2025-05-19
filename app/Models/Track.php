<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'artist',
        'file_name',
        'image',
        'displayed',
        'play_count'
    ];

    protected $casts = [
        'displayed' => 'boolean',
        'play_count' => 'integer',
    ];
}
