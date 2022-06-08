<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrik extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "districts";
    protected $fillable = [
        'id',
        'regency_id',
        'name',
        'no_kec',

    ];
}