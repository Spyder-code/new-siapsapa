<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_detail_id',
        'kta_id',
        'anggota_id',
        'harga',
        'golongan',
        'status_percetakan'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function pramuka()
    {
        return $this->belongsTo(Pramuka::class, 'golongan');
    }

    public function kta()
    {
        return $this->belongsTo(Kta::class, 'kta_id');
    }

    public function transactionDetail()
    {
        return $this->belongsTo(TransactionDetail::class, 'transaction_detail_id');
    }
}
