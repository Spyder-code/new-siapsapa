<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "agenda";
    protected $fillable = [
        'nama',
        'deskripsi',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'alamat',
        'tanggal_mulai',
        'tanggal_selesai',
        'kepesertaan',
        'kategori',
        'jenis',
        'foto',
        'created_by'
    ];
    protected $guarded = ['id'];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kabupaten(){
        return $this->belongsTo(City::class, 'kabupaten_id', 'id');
    }

    public function kecamatan(){
        return $this->belongsTo(Distrik::class, 'kecamatan_id', 'id');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'agenda_id', 'id');
    }
}
