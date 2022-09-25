<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'pramuka_id',
        'name',
        'id'
    ];

    public function pramuka()
    {
        return $this->belongsTo(Pramuka::class, 'pramuka_id');
    }
}
