<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "tb_anggota";
    protected $fillable = [
        'kta_id',
        'kode',
        'pramuka',
        'email',
        'nik',
        'password',
        'nama',
        'tgl_lahir',
        'tempat_lahir',
        'jk',
        'agama',
        'gol_darah',
        'nohp',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'gudep',
        'status_anggota',
        'keterangan',
        'status',
        'foto',
        'kawin',
        'user_id',
        'tingkat',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gudepInfo()
    {
        return $this->belongsTo(Gudep::class,'gudep');
    }

    public function province(){
        return $this->belongsTo(Provinsi::class, 'provinsi');
    }

    public function city(){
        return $this->belongsTo(City::class, 'kabupaten');
    }

    public function district(){
        return $this->belongsTo(Distrik::class, 'kecamatan');
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'tingkat');
    }

    public function kta()
    {
        return $this->belongsTo(Kta::class, 'kta_id');
    }

    public function golongan()
    {
        return $this->belongsTo(Pramuka::class, 'pramuka');
    }

    public function cetak()
    {
        return $this->hasOne(Transaction::class,'anggota_id');
    }

    public function nodaf($agenda_id)
    {
        return PendaftaranAgenda::where('agenda_id',$agenda_id)->where('anggota_id',$this->id)->first()->nodaf;
    }
}
