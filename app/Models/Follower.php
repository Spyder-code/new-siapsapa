<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'following',
    ];

    public function userFollower()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userFollowing()
    {
        return $this->belongsTo(User::class, 'following');
    }
}