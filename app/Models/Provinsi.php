<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "provinces";
    protected $fillable = [
        'id',
        'name',
        'no_prov',
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class,'provinsi');
    }
}