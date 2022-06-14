<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Gudep;
use Illuminate\Http\Request;

class GudepController extends Controller
{
    public function getAdmin($gudep_id)
    {
        $admin = Anggota::where('gudep', $gudep_id)->whereHas('user', function($query) {
            $query->where('role', 'gudep');
        })->select('id', 'nama', 'email')->get();
        return response()->json([
            'data' => $admin,
        ]);
    }

    public function addAdmin()
    {
        $anggota_id = request()->anggota_id;
        $anggota = Anggota::find($anggota_id);
        $anggota->user->role = 'gudep';
        $anggota->user->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function deleteGudep()
    {
        $gudep_id = request()->gudep;
        $gudep = Gudep::find($gudep_id);
        $gudep->delete();
        Anggota::where('gudep', $gudep_id)->update(['gudep' => null]);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
