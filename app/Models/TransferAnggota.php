<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferAnggota extends Model
{
    use HasFactory;
    protected $table = 'transfer_anggota';
    protected $fillable = [
        'anggota_id',
        'from_gudep',
        'to_gudep',
        'status',
        'user_created',
    ];

    public function gudepFrom()
    {
        return $this->belongsTo(Gudep::class,'from_gudep');
    }
    public function gudepTo()
    {
        return $this->belongsTo(Gudep::class,'to_gudep');
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }
}
