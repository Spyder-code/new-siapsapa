<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Distrik;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KwartirController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        if (request('id_wilayah')) {
            $id_wilayah = request('id_wilayah');
        }else{
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
        }
        // dd($role);

        $data = $this->getData($id_wilayah);
        $title = $data->name ?? 'Nasional';
        return view('admin.kwartir', compact('id_wilayah', 'title'));
    }

    public function getData($id_wilayah)
    {
        $len = strlen($id_wilayah);
        if ($len==2) {
            $data = Provinsi::where('id',$id_wilayah)->first();
        }elseif($len==4){
            $data = City::where('regencies.id',$id_wilayah)->first();
        }else{
            $data = Distrik::where('districts.id',$id_wilayah)->first();
        }

        return $data;
    }
}
