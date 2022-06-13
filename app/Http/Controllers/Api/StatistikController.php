<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Provinsi;
use App\Repositories\StatistikService;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function getNumberOfPramuka($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        if(request('type')){
            $data = $statistik->getNumberOfPramuka(request('type'));
        }else{
            $data = $statistik->getNumberOfPramuka();
        }
        return response()->json($data);
    }

    public function getGender($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->getGender();
        return response()->json($data);
    }

    public function getAnggotaActiveAndUnactive($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->getAnggotaActiveAndUnactive();
        return response()->json($data);
    }

    public function getAnggotaGudepAndNonGudep($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->getAnggotaGudepAndNonGudep();
        return response()->json($data);
    }

    public function getNumberOfTitle($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->getNumberOfTitle();
        return response()->json($data);
    }

    public function dashboard($id_wilayah)
    {
        $statistik = new StatistikService($id_wilayah);
        $data = $statistik->dashboard();
        return response()->json($data);
    }
}
