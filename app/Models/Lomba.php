<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    use HasFactory;
    protected $table = 'lomba';
    protected $fillable = [
        'kegiatan_id',
        'kategori',
        'kepesertaan',
        'penilaian',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class,'kegiatan_id');
    }

    public function stage($id){
        if($this->kepesertaan=='kelompok'){
            $max = LombaStage::where('lomba_id',$this->id)->where('gudep_id',$id)->max('stage');
            if($max==0){$max=1;}
            return $max;
        }else{
            $max = LombaStage::where('lomba_id',$this->id)->where('peserta_id',$id)->max('stage');
            if($max==0){$max=1;}
            return $max;
        }
    }

    public function point($id){
        if($this->kepesertaan=='kelompok'){
            $p = LombaStage::where('lomba_id',$this->id)->where('gudep_id',$id)->first();
            if(!$p){
                $p = '-';
            }
            return $p;
        }else{
            $p = LombaStage::where('lomba_id',$this->id)->where('peserta_id',$id)->first();
            if(!$p){
                $p = '-';
            }
            return $p;
        }
    }
}
