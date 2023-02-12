<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaAgenda extends Model
{
    use HasFactory;

    protected $table = 'panitia_agenda';
    protected $fillable = [
        'agenda_id',
        'anggota_id',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class,'agenda_id');
    }
}
