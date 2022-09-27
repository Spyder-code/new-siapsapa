<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pramuka extends Model
{
    use HasFactory;

    protected $table = 'pramuka';
    protected $fillable = [
        'name',
        'count'
    ];

    public function documentTypes()
    {
        return $this->hasMany(DocumentType::class,'pramuka_id');
    }
}
