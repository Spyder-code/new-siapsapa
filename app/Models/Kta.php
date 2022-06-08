<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kta extends Model
{
    use HasFactory;
    protected $table = "kta";
    protected $fillable = [
        'pramuka_id',
        'provinsi',
        'kabupaten',
        'depan',
        'belakang',
    ];
}
