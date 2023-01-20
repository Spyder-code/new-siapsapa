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

    public function pointJuriGudep($lomba_id,$juri_id)
    {
        return PointJuri::where('lomba_id',$lomba_id)->where('juri_id',$juri_id)->where('gudep_id',$this->gudep_id)->first()->point ?? '';
    }

    public function idJuriGudep($lomba_id,$juri_id)
    {
        return PointJuri::where('lomba_id',$lomba_id)->where('juri_id',$juri_id)->where('gudep_id',$this->gudep_id)->first()->id ?? null;
    }

    public function deskripsiJuriGudep($lomba_id,$juri_id)
    {
        return PointJuri::where('lomba_id',$lomba_id)->where('juri_id',$juri_id)->where('gudep_id',$this->gudep_id)->first()->description ?? '';
    }

    public function pointJuriPeserta($lomba_id,$juri_id)
    {
        return PointJuri::where('lomba_id',$lomba_id)->where('juri_id',$juri_id)->where('peserta_id',$this->id)->first()->point ?? '';
    }

    public function idJuriPeserta($lomba_id,$juri_id)
    {
        return PointJuri::where('lomba_id',$lomba_id)->where('juri_id',$juri_id)->where('peserta_id',$this->id)->first()->id ?? null;
    }

    public function deskripsiJuriPeserta($lomba_id,$juri_id)
    {
        return PointJuri::where('lomba_id',$lomba_id)->where('juri_id',$juri_id)->where('peserta_id',$this->id)->first()->description ?? '';
    }
}
