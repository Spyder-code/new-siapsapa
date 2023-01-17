<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
    use HasFactory;
    protected $table = 'juri';

    protected $fillable = [
        'agenda_id',
        'anggota_id'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }
}
