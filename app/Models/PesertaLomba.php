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

    public function pointJuriPesertaKelompok($lomba_id,$juri_id)
    {
        $tingkat = Lomba::find($lomba_id)->kegiatan->agenda->tingkat;
        if($tingkat=='provinsi'){
            $wilayah = $this->anggota->provinsi;
        }elseif($tingkat=='kabupaten'){
            $wilayah = $this->anggota->kecamatan;
        }elseif($tingkat=='kecamatan'){
            $wilayah = $this->anggota->kecamatan;
        }else{
            $wilayah = $this->anggota->gudep;
        }
        return PointJuri::join('peserta_lomba','peserta_lomba.id','=','point_juri.peserta_id')
                ->join('tb_anggota','tb_anggota.id','=','peserta_lomba.anggota_id')
                ->where('point_juri.lomba_id',$lomba_id)
                ->where('point_juri.juri_id',$juri_id)
                ->where('tb_anggota.'.$tingkat,$wilayah)->first()->point ?? '';
    }

    public function idJuriPesertaKelompok($lomba_id,$juri_id)
    {
        $tingkat = Lomba::find($lomba_id)->kegiatan->agenda->tingkat;
        if($tingkat=='provinsi'){
            $wilayah = $this->anggota->provinsi;
        }elseif($tingkat=='kabupaten'){
            $wilayah = $this->anggota->kecamatan;
        }elseif($tingkat=='kecamatan'){
            $wilayah = $this->anggota->kecamatan;
        }else{
            $wilayah = $this->anggota->gudep;
        }
        return PointJuri::join('peserta_lomba','peserta_lomba.id','=','point_juri.peserta_id')
                ->join('tb_anggota','tb_anggota.id','=','peserta_lomba.anggota_id')
                ->where('point_juri.lomba_id',$lomba_id)
                ->where('point_juri.juri_id',$juri_id)
                ->where('tb_anggota.'.$tingkat,$wilayah)->first()->id ?? null;
    }

    public function deskripsiJuriPesertaKelompok($lomba_id,$juri_id)
    {
        $tingkat = Lomba::find($lomba_id)->kegiatan->agenda->tingkat;
        if($tingkat=='provinsi'){
            $wilayah = $this->anggota->provinsi;
        }elseif($tingkat=='kabupaten'){
            $wilayah = $this->anggota->kecamatan;
        }elseif($tingkat=='kecamatan'){
            $wilayah = $this->anggota->kecamatan;
        }else{
            $wilayah = $this->anggota->gudep;
        }
        return PointJuri::join('peserta_lomba','peserta_lomba.id','=','point_juri.peserta_id')
                ->join('tb_anggota','tb_anggota.id','=','peserta_lomba.anggota_id')
                ->where('point_juri.lomba_id',$lomba_id)
                ->where('point_juri.juri_id',$juri_id)
                ->where('tb_anggota.'.$tingkat,$wilayah)->first()->description ?? '';
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
