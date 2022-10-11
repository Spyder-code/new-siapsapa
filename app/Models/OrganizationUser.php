<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'anggota_id',
        'organization_id',
        'type',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organizations::class);
    }
}
