<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LombaFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'lomba_id',
        'anggota_id',
        'peserta_id',
        'gudep_id',
        'file_name',
        'file_path',
        'mime',
        'size',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class,'lomba_id');
    }

    public function gudep()
    {
        return $this->belongsTo(Gudep::class,'gudep_id');
    }

    public function votes()
    {
        return $this->hasMany(PointVote::class,'lomba_file_id');
    }

    public function peserta()
    {
        return $this->belongsTo(PendaftaranAgenda::class,'peserta_id');
    }
}
