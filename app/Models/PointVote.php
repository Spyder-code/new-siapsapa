<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_file_id',
        'anggota_id'
    ];

    public function agenda_file()
    {
        return $this->belongsTo(AgendaFile::class,'agenda_file_id');
    }
}
