<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function getProvince()
    {
        $province = Provinsi::all();
        return response($province);
    }

    public function getKabupatenByIdProvinsi($id)
    {
        $data = City::all()->where('province_id',$id);
        return response($data);
    }

    public function getKecamatanByIdKabupaten($id)
    {
        $data = Distrik::all()->where('regency_id',$id);
        return response($data);
    }
}
