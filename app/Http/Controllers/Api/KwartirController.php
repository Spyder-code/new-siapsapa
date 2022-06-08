<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KwartirController extends Controller
{
    public function numberOfMemberAndAdmin($id_wilayah)
    {
        if($id_wilayah=='all'){
            $admin = Anggota::whereHas('user', function($q){
                $q->where('role','kwarda');
            })->count();
            $anggota = Anggota::count();
            $type = 1;
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $data = Provinsi::where('id',$id_wilayah)->select('id')->first();
                $type = 2;
            }elseif($len==4){
                $data =  City::where('id',$id_wilayah)->select('id')->first();
                $type = 3;
            }else{
                $data =  Distrik::where('id',$id_wilayah)->select('id')->first();
                $type = 4;
            }
        }

        if($type==2){
            $admin = Anggota::where('provinsi',$data->id)->whereHas('user', function ($query) {
                $query->where('role','kwarcab');
            })->count();
            $anggota = Anggota::where('provinsi',$data->id)->count();
        }elseif($type==3){
            $admin = Anggota::where('kabupaten',$data->id)->whereHas('user', function ($query) {
                $query->where('role','kwaran');
            })->count();
            $anggota = Anggota::where('kabupaten',$data->id)->count();
        }elseif($type==4){
            $admin = Anggota::where('kecamatan',$data->id)->whereHas('user', function ($query) {
                $query->where('role','gudep');
            })->count();
            $anggota = Anggota::where('kecamatan',$data->id)->count();
        }

        return response()->json([
            'admin' => $admin,
            'anggota' => $anggota
        ]);
    }

    public function showAdmin($id_wilayah)
    {

    }

    public function anggotaAdmin($id_wilayah)
    {
        $id_wilayah = request('id_wilayah');
        if($id_wilayah=='all'){
            return false;
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $admin = 'kwarda';
                $data = Anggota::where('provinsi',$id_wilayah)->whereHas('user', function ($query) use ($admin) {
                    $query->where('role',$admin);
                })->select('id','nama','email');
            }elseif($len==4){
                $admin = 'kwarcab';
                $data =  Anggota::where('kabupaten',$id_wilayah)->whereHas('user', function ($query) use ($admin){
                    $query->where('role',$admin);
                })->select('id','nama','email');
            }else{
                $admin = 'kwaran';
                $data = Anggota::where('kecamatan',$id_wilayah)->whereHas('user', function ($query) use ($admin){
                    $query->where('role',$admin);
                })->select('id','nama','email');
            }
        }

        return response()->json([
            'data' => $data,
            'admin' => $admin
        ]);
    }
}
