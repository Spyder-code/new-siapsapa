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
      'tingkat',
      'kategori',
      'jenis',
      'is_finish',
      'sertifikat',
      'is_daftar',
      'foto',
      'created_by'
   ];
   protected $guarded = ['id'];

   public function provinsi()
   {
      return $this->belongsTo(Provinsi::class , 'provinsi_id', 'id');
   }

   public function kabupaten()
   {
      return $this->belongsTo(City::class , 'kabupaten_id', 'id');
   }

   public function kecamatan()
   {
      return $this->belongsTo(Distrik::class , 'kecamatan_id', 'id');
   }

   public function kegiatan()
   {
      return $this->hasMany(Kegiatan::class , 'agenda_id', 'id');
   }

   public function panitia()
   {
      return $this->hasMany(PanitiaAgenda::class,'agenda_id');
   }

   public function owner()
   {
      return $this->belongsTo(User::class,'created_by');
   }

   public function peserta()
   {
    return $this->hasMany(PendaftaranAgenda::class,'agenda_id');
   }
}
