<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnggotaResource;
use App\Models\Anggota;
use App\Models\User;
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

    public function deleteAnggota()
    {
        $id = request('id_anggota');
        $anggota = Anggota::destroy($id);
        return response()->json([
            'status' => 'success',
            'data' => $anggota,
            'message' => 'Anggota berhasil di validasi'
        ]);
    }

    public function getAnggotaById ($id)
    {
        // get anggota response with error message
        $anggota = Anggota::find($id);
        if (!$anggota) {
            return response()->json([
                'message' => 'Anggota not found'
            ], 404);
        }
        return new AnggotaResource($anggota);
    }

    public function getAnggotaByNik ()
    {
        // get anggota response with error message
        $anggota = Anggota::where('nik',request('nik'))->first();
        if (!$anggota) {
            return response()->json([
                'status' => 404,
                'message' => 'Anggota not found'
            ], 200);
        }
        return new AnggotaResource($anggota);
    }

    public function getAnggotaByAdminLogin($id)
    {
        // get anggota response with error message
        $user = User::find($id);
        $provinsi = $user->anggota->provinsi;
        $kabupaten = $user->anggota->kabupaten;
        $anggota = Anggota::where('provinsi', $provinsi)->where('kabupaten', $kabupaten)->get();
        if (!$anggota) {
            return response()->json([
                'message' => 'Anggota not found'
            ], 404);
        }
        return AnggotaResource::collection($anggota);
    }
}
