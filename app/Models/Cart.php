<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kta_id',
        'harga',
        'golongan',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'kta_id');
    }
}
