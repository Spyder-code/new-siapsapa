<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Provinsi;
use App\Repositories\RajaOngkirService;
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

    public function getGudepByIdKecamatan($id)
    {
        $data = Gudep::all()->where('kecamatan', $id);
        return response($data);
    }

    public function getProvinceOngkir()
    {
        $ro = new RajaOngkirService();
        return $ro->getProvince(request('id'));
    }

    public function getCityOngkir()
    {
        $ro = new RajaOngkirService();
        return $ro->getCity(request('province_id'),request('id'));
    }

    public function getOngkir()
    {
        $ro = new RajaOngkirService();
        $data = [
            "origin"=>"23",
            "destination"=>request('destination'),
            "weight"=>request('weight'),
            "courier"=>request('courier')
        ];
        return $ro->getCost($data);
    }
}
