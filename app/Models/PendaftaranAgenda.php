<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAgenda extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_agenda';
    protected $fillable = ['nodaf', 'agenda_id', 'anggota_id', 'status', 'order'];
    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class,'agenda_id');
    }
}
