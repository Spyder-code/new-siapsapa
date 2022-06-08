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
        'status'
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class,'document_type_id');
    }
}
