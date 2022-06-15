<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaStatus extends Model
{
    use HasFactory;
    protected $table = 'anggota_status';
    protected $fillable = ['nama', 'deskripsi'];
}
