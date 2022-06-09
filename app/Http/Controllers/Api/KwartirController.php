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
    public function getNumberOfMemberAndAdmin($id_wilayah)
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
                $query->where('role','kwarda');
            })->count();
            $anggota = Anggota::where('provinsi',$data->id)->count();
        }elseif($type==3){
            $admin = Anggota::where('kabupaten',$data->id)->whereHas('user', function ($query) {
                $query->where('role','kwarcab');
            })->count();
            $anggota = Anggota::where('kabupaten',$data->id)->count();
        }elseif($type==4){
            $admin = Anggota::where('kecamatan',$data->id)->whereHas('user', function ($query) {
                $query->where('role','kwaran');
            })->count();
            $anggota = Anggota::where('kecamatan',$data->id)->count();
        }

        return response()->json([
            'admin' => $admin,
            'anggota' => $anggota
        ]);
    }

    public function getAdmin($id_wilayah)
    {
        if($id_wilayah=='all'){
            return false;
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $admin = 'kwarda';
                $data = Anggota::where('provinsi',$id_wilayah)->whereHas('user', function ($query) use ($admin) {
                    $query->where('role',$admin);
                })->select('id','nama','email')->get();
            }elseif($len==4){
                $admin = 'kwarcab';
                $data =  Anggota::where('kabupaten',$id_wilayah)->whereHas('user', function ($query) use ($admin){
                    $query->where('role',$admin);
                })->select('id','nama','email')->get();
            }else{
                $admin = 'kwaran';
                $data = Anggota::where('kecamatan',$id_wilayah)->whereHas('user', function ($query) use ($admin){
                    $query->where('role',$admin);
                })->select('id','nama','email')->get();
            }
        }

        return response()->json([
            'data' => $data,
            'admin' => $admin
        ]);
    }

    public function getNumberOfPramuka($id_wilayah)
    {
        if($id_wilayah=='all'){
            $siaga = Anggota::where('pramuka',1)->count();
            $penggalang = Anggota::where('pramuka',2)->count();
            $penegak = Anggota::where('pramuka',3)->count();
            $pandega = Anggota::where('pramuka',4)->count();
            $dewasa = Anggota::where('pramuka',5)->count();
            $pelatih = Anggota::where('pramuka',6)->count();
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $query = Anggota::where('provinsi',$id_wilayah)->get();
            }elseif($len==4){
                $query = Anggota::where('kabupaten',$id_wilayah)->get();
            }else{
                $query = Anggota::where('kecamatan',$id_wilayah)->get();
            }

            $siaga = $query->where('pramuka',1)->count();
            $penggalang = $query->where('pramuka',2)->count();
            $penegak = $query->where('pramuka',3)->count();
            $pandega = $query->where('pramuka',4)->count();
            $dewasa = $query->where('pramuka',5)->count();
            $pelatih = $query->where('pramuka',6)->count();
        }

        return response()->json([
            'siaga' => $siaga,
            'penggalang' => $penggalang,
            'penegak' => $penegak,
            'pandega' => $pandega,
            'dewasa' => $dewasa,
            'pelatih' => $pelatih
        ]);
    }

    public function addAdmin()
    {
        $id_wilayah = request()->id_wilayah;
        $anggota_id = request()->anggota_id;
        $len = strlen($id_wilayah);
        if($id_wilayah=='all'){
            return false;
        }else{
            $len = strlen($id_wilayah);
            $anggota = Anggota::find($anggota_id);
            if ($len==2) {
                $role = 'kwarda';
            }elseif($len==4){
                $role = 'kwarcab';
            }else{
                $role = 'kwaran';
            }

            $anggota->user->role = $role;
            $anggota->user->save();
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function deleteAdmin()
    {
        $anggota_id = request()->anggota_id;
        $anggota = Anggota::find($anggota_id);
        $anggota->user->role = 'user';
        $anggota->user->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
