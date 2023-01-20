<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'lomba_file_id',
        'anggota_id'
    ];

    public function lomba_file()
    {
        return $this->belongsTo(LombaFile::class,'lomba_file_id');
    }
}
