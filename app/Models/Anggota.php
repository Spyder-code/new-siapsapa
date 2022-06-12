<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = "tb_anggota";
    protected $fillable = [
        'kode',
        'pramuka',
        'email',
        'nik',
        'password',
        'nama',
        'tgl_lahir',
        'tempat_lahir',
        'jk',
        'agama',
        'gol_darah',
        'nohp',
        'alamat',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'gudep',
        'status_anggota',
        'keterangan',
        'status',
        'foto',
        'kawin',
        'user_id',
        'tingkat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gudepInfo()
    {
        return $this->belongsTo(Gudep::class,'gudep');
    }

    public function province(){
        return $this->belongsTo(Provinsi::class, 'provinsi', 'id');
    }

    public function city(){
        return $this->belongsTo(Kabupaten::class, 'kabupaten', 'id');
    }

    public function district(){
        return $this->belongsTo(Kecamatan::class, 'kecamatan', 'id');
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'tingkat');
    }
}
