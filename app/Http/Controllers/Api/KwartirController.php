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
