<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointJuri extends Model
{
    use HasFactory;
    protected $table = 'point_juri';
    protected $fillable = [
        'agenda_id',
        'agenda_file_id',
        'gudep_id',
        'peserta_id',
        'point',
        'description',
        'status',
        'juri_id',
    ];
}
