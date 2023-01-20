<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $fillable = ['agenda_id', 'nama_kegiatan', 'waktu_mulai', 'waktu_selesai', 'tempat'];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function lomba()
    {
        return $this->hasOne(Lomba::class, 'kegiatan_id');
    }
}
