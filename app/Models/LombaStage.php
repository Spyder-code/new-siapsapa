<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LombaStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'peserta_id',
        'gudep_id',
        'stage',
        'point',
        'is_elimination',
        'status',
    ];

    public function gudep(){
        return $this->belongsTo(Gudep::class,'gudep_id');
    }

    public function peserta(){
        return $this->belongsTo(PesertaLomba::class,'peserta_id');
    }

    public function lomba(){
        return $this->belongsTo(Lomba::class,'lomba_id');
    }
}
