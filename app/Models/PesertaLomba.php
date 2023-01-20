<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaLomba extends Model
{
    use HasFactory;
    protected $table = 'peserta_lomba';
    protected $fillable = [
        'nodaf',
        'lomba_id',
        'anggota_id',
        'gudep_id',
        'nama_kelompok',
        'order',
        'status',
    ];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class,'lomba_id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function gudep()
    {
        return $this->belongsTo(Gudep::class,'gudep_id');
    }
}
