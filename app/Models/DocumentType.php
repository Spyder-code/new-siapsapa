<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $table = 'document_type';
    protected $fillable = [
        'pramuka_id',
        'name'
    ];

    public function pramuka()
    {
        return $this->belongsTo(Pramuka::class, 'pramuka_id');
    }
}
