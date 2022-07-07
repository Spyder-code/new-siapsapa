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
        'anggota_id',
        'harga',
        'golongan',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function pramuka()
    {
        return $this->belongsTo(Pramuka::class, 'golongan');
    }

    public function kta()
    {
        return $this->belongsTo(Kta::class, 'kta_id');
    }
}
