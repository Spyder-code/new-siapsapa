<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;
    protected $table = 'lomba';
    protected $fillable = [
        'kegiatan_id',
        'kategori',
        'kepesertaan',
        'penilaian',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class,'kegiatan_id');
    }
}
