<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\DocumentType;
use App\Models\Gudep;
use App\Models\Organizations;
use App\Models\Pramuka;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{
    public function new()
    {
        $user = Auth::user();
        $role = $user->role;
        if (request('id_wilayah')) {
            $id_wilayah = request('id_wilayah');
            $len = strlen($id_wilayah);
            if ($len==2) {
                $active = Anggota::where('provinsi',$id_wilayah)->where('status',1)->count();
                $cetak = Anggota::where('provinsi',$id_wilayah)->where('is_cetak',1)->count();
                $kwarcab = City::where('province_id',$id_wilayah)->count();
                $kwaran = Distrik::whereHas('regency', function($q) use($id_wilayah){
                    $q->where('province_id',$id_wilayah);
                })->count();
                $gudep = Gudep::where('provinsi',$id_wilayah)->count();
            }elseif($len==4){
                $active = Anggota::where('kabupaten',$id_wilayah)->where('status',1)->count();
                $cetak = Anggota::where('kabupaten',$id_wilayah)->where('is_cetak',1)->count();
                $kwarcab = Anggota::where('kabupaten',$id_wilayah)->where('status',0)->count();
                $kwaran = Distrik::where('regency_id', $id_wilayah)->count();
                $gudep = Gudep::where('kabupaten',$id_wilayah)->count();
            }else{
                $active = Anggota::where('kecamatan',$id_wilayah)->where('status',1)->count();
                $cetak = Anggota::where('kecamatan',$id_wilayah)->where('is_cetak',1)->count();
                $kwarcab = Anggota::where('kecamatan',$id_wilayah)->where('status',0)->count();
                $kwaran = Anggota::where('kecamatan',$id_wilayah)->where('status',1)->whereNull('gudep')->count();
                $gudep = Gudep::where('kecamatan',$id_wilayah)->count();
            }
        }else{
            if($role=='admin' || $role=='kwarnas'){
                $id_wilayah = 'all';
                $active = Anggota::where('status',1)->count();
                $cetak = Anggota::where('is_cetak',1)->count();
                $kwarcab = City::count();
                $kwaran = Distrik::count();
                $gudep = Gudep::count();
            }
            if($role=='kwarda'){
                $id_wilayah = $user->anggota->provinsi;
                $active = Anggota::where('provinsi',$id_wilayah)->where('status',1)->count();
                $cetak = Anggota::where('provinsi',$id_wilayah)->where('is_cetak',1)->count();
                $kwarcab = City::where('province_id',$id_wilayah)->count();
                $kwaran = Distrik::whereHas('regency', function($q) use($id_wilayah){
                    $q->where('province_id',$id_wilayah);
                })->count();
                $gudep = Gudep::where('provinsi',$id_wilayah)->count();
            }
            if($role=='kwarcab'){
                $id_wilayah = $user->anggota->kabupaten;
                $active = Anggota::where('kabupaten',$id_wilayah)->where('status',1)->count();
                $cetak = Anggota::where('kabupaten',$id_wilayah)->where('is_cetak',1)->count();
                $kwarcab = Anggota::where('kabupaten',$id_wilayah)->where('status',0)->count();
                $kwaran = Distrik::where('regency_id', $id_wilayah)->count();
                $gudep = Gudep::where('kabupaten',$id_wilayah)->count();
            }
            if($role=='kwaran'){
                $id_wilayah = $user->anggota->kecamatan;
                $active = Anggota::where('kecamatan',$id_wilayah)->where('status',1)->count();
                $cetak = Anggota::where('kecamatan',$id_wilayah)->where('is_cetak',1)->count();
                $kwarcab = Anggota::where('kecamatan',$id_wilayah)->where('status',0)->count();
                $kwaran = Anggota::where('kecamatan',$id_wilayah)->where('status',1)->whereNull('gudep')->count();
                $gudep = Gudep::where('kecamatan',$id_wilayah)->count();
            }
            if($role=='gudep'){
                return redirect()->route('gudep.show', $user->anggota->gudep);
            }
        }

        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Kwartir Nasional';
        $kwartir = $data[1];
        return view('admin.new-statistik', compact('id_wilayah','title','kwartir', 'data','active','kwarcab','kwaran','gudep','cetak'));
    }

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
        $title = $data[0]->name ?? 'Kwartir Nasional';
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
            $kwartir = 'Kwartiir Daerah';
        }elseif($len==4){
            $data = City::find($id_wilayah, ['name', 'id', 'no_kab as code', 'province_id as prev']);
            $kwartir = 'Kwartir Cabang';
        }else{
            $data = Distrik::find($id_wilayah, ['name', 'id', 'no_kec as code', 'regency_id as prev']);
            $kwartir = 'Kwartir Ranting';
        }

        return [$data, $kwartir];
    }
}
