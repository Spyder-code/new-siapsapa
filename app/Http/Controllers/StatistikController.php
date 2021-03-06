<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Distrik;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
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
            if($role=='gudep')
                return redirect()->route('gudep.show', $user->anggota->gudep);
        }

        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Nasional';
        $kwartir = $data[1];

        return view('admin.statistik', compact('id_wilayah','title','kwartir'));
    }

    public function getData($id_wilayah)
    {
        if ($id_wilayah=='all') {
            return [null,null];
        }
        $len = strlen($id_wilayah);
        if ($len==2) {
            $data = Provinsi::find($id_wilayah, ['name', 'id', 'no_prov as code', 'id as prev']);
            $kwartir = 'Provinsi';
        }elseif($len==4){
            $data = City::find($id_wilayah, ['name', 'id', 'no_kab as code', 'province_id as prev']);
            $kwartir = 'Kabupaten';
        }else{
            $data = Distrik::find($id_wilayah, ['name', 'id', 'no_kec as code', 'regency_id as prev']);
            $kwartir = 'Kecamatan';
        }

        return [$data, $kwartir];
    }
}
