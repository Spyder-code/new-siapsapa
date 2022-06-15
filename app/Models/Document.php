<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'document_type_id',
        'file',
        'pramuka',
        'status'
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class,'document_type_id');
    }

    public function golongan()
    {
        return $this->belongsTo(Pramuka::class,'pramuka');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
