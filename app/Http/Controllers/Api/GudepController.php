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
}
