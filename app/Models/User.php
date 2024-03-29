<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'id_wilayah',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'user_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_created');
    }

    public function juriAgenda($agenda_id)
    {
        return Juri::where('agenda_id', $agenda_id)->where('anggota_id', Auth::user()->anggota->id)->first();
    }
}
