<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";
    protected $fillable = [
        'post_category_id',
        'title',
        'cover_image',
        'content',
        'user_created',
        'admin_validated',
        'status',
    ];
}
