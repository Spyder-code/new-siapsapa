<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAgenda extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_agenda';
    protected $fillable = ['nodaf', 'agenda_id', 'anggota_id', 'status', 'order','gudep_id'];
    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class,'agenda_id');
    }

    public function gudep()
    {
        return $this->belongsTo(Gudep::class,'gudep_id');
    }

    public function pointJuriAgendaGudep($agenda_id,$juri_id)
    {
        return PointJuri::where('agenda_id',$agenda_id)->where('juri_id',$juri_id)->where('gudep_id',$this->gudep_id)->first()->point ?? '';
    }

    public function idJuriAgendaGudep($agenda_id,$juri_id)
    {
        return PointJuri::where('agenda_id',$agenda_id)->where('juri_id',$juri_id)->where('gudep_id',$this->gudep_id)->first()->id ?? null;
    }

    public function deskripsiJuriAgendaGudep($agenda_id,$juri_id)
    {
        return PointJuri::where('agenda_id',$agenda_id)->where('juri_id',$juri_id)->where('gudep_id',$this->gudep_id)->first()->description ?? '';
    }

    public function pointJuriAgendaPeserta($agenda_id,$juri_id)
    {
        return PointJuri::where('agenda_id',$agenda_id)->where('juri_id',$juri_id)->where('peserta_id',$this->id)->first()->point ?? '';
    }

    public function idJuriAgendaPeserta($agenda_id,$juri_id)
    {
        return PointJuri::where('agenda_id',$agenda_id)->where('juri_id',$juri_id)->where('peserta_id',$this->id)->first()->id ?? null;
    }

    public function deskripsiJuriAgendaPeserta($agenda_id,$juri_id)
    {
        return PointJuri::where('agenda_id',$agenda_id)->where('juri_id',$juri_id)->where('peserta_id',$this->id)->first()->description ?? '';
    }
}
