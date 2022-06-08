<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudep extends Model
{
    use HasFactory;
    protected $table = "tb_gudep";
    protected $guarded = [
        'id'
    ];
    protected $fillable = ['npsn','nama_sekolah','no_putra', 'no_putri', 'nama_gudep_putra', 'nama_gudep_putri', 'provinsi', 'kabupaten', 'kecamatan', 'status'];

    public function district()
    {
        return $this->belongsTo(Distrik::class,'kecamatan');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'kabupaten');
    }

    public function province()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi');
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'gudep');
    }
}
