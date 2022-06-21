<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function anggotaValidate()
    {
        $id = request('id');
        $anggota = Anggota::find($id);
        $anggota->status = 1;
        $anggota->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Anggota berhasil di validasi'
        ]);
    }

    public function anggotaReject()
    {
        $id = request('id');
        $anggota = Anggota::find($id);
        $anggota->status = 3;
        $anggota->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Validasi Anggota berhasil di tolak'
        ]);
    }
}
