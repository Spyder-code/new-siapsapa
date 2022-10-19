<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReactPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'story_id',
        'agenda_id',
        'react_id',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function events()
    {
        return $this->hasMany(Agenda::class, 'agenda_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function react()
    {
        return $this->belongsTo(Reacts::class);
    }
}
