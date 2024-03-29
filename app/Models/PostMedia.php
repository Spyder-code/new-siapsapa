<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    use HasFactory;

    protected $table = 'post_media';
    protected $fillable = [
        'post_id',
        'user_id',
        'type',
        'path',
        'status',
    ];
}