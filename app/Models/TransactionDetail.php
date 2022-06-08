<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code',
        'penerima',
        'phone',
        'alamat',
        'kota',
        'kode_pos',
        'item_price',
        'ekpedisi_price',
        'total',
        'status',
        'payment_status',
        'resi',
        'snap_token',
    ];

    public function statusInfo()
    {
        return $this->belongsTo(TransactionStatus::class, 'status');
    }
}
