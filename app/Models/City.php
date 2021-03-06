<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "regencies";
    protected $fillable = [
        'id',
        'province_id',
        'name',
        'no_kab',
        'harga',
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'kabupaten');
    }

    public function province()
    {
        return $this->belongsTo(Provinsi::class, 'province_id');
    }

    public function district()
    {
        return $this->hasMany(Distrik::class, 'regency_id');
    }
}
