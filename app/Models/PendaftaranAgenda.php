<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAgenda extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_agenda';
    protected $fillable = ['agenda_id', 'anggota_id', 'status'];
}