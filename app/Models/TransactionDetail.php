<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'code',
        'penerima',
        'phone',
        'province_id',
        'city_id',
        'district_id',
        'alamat',
        'kota',
        'kode_pos',
        'item_price',
        'ekspedisi_name',
        'ekspedisi_tipe',
        'ekspedisi_price',
        'total',
        'status',
        'payment_status',
        'payment_type',
        'file',
        'resi',
        'snap_token',
    ];

    public function statusInfo()
    {
        return $this->belongsTo(TransactionStatus::class, 'status');
    }

    public function paymentInfo()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class,'transaction_detail_id');
    }
}
