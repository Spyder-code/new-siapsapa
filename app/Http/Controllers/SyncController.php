<?php

namespace App\Http\Controllers;

use App\Jobs\SyncAnggotaKta;
use App\Models\Anggota;
use App\Models\Document;
use App\Models\Kta;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SyncController extends Controller
{
    public function document()
    {
        $data = Document::all();
        foreach ($data as $item ) {
            $item->pramuka = $item->documentType->pramuka_id;
            $item->save();
        }

    }

    public function kta()
    {
        $old_kta = DB::table('tb_kta')->get();
        $kta = array();
        $j=0;
        foreach ($old_kta as $item ) {
            $kta['provinsi'] = $item->provinsi;
            $kta['kabupaten'] = $item->kabupaten;
            if($item->tipe==1){
                if(Str::upper($item->kategori)=='SIAGA')
                    $kta['pramuka_id'] = 1;
                if(Str::upper($item->kategori)=='PENGGALANG')
                    $kta['pramuka_id'] = 2;
                if(Str::upper($item->kategori)=='PENEGAK')
                    $kta['pramuka_id'] = 3;
                if(Str::upper($item->kategori)=='PANDEGA')
                    $kta['pramuka_id'] = 4;
                if(Str::upper($item->kategori)=='DEWASA')
                    $kta['pramuka_id'] = 5;

                    $kta['depan'] = $item->kta;
            }else{
                $kta['belakang'] = $item->kta;
                Kta::create($kta);
                $j++;
            }
        }
    }

    public function anggotaKta()
    {
        // chunk anggota
        $data = Anggota::all(['id', 'kabupaten','kta_id']);
        foreach ($data->chunk(1000) as $anggota) {
            // foreach ($anggota as $item) {
            //     $kta = Kta::where('kabupaten',$item->kabupaten)->first();
            //     if($kta){
            //         $item->update(['kta_id'=>$kta->id]);
            //     }
            // }
            dispatch(new SyncAnggotaKta($anggota))->delay(now()->addMinutes(1));
        }

        return response()->json([
            'message' => 'Berhasil mengupdate data'
        ], 200);
    }

    public function golongan()
    {
        $anggota = Anggota::all();
        $i = 0;
        foreach ($anggota as $item ) {
            if($item->kawin==1){
                $golongan = 5;
            }else{
                $tgl = new DateTime($item->tgl_lahir);
                $now = new DateTime();
                $difference = $tgl->diff($now);
                $usia   = $difference->y; //hitung tahun
                if ($usia < 10) {
                    $golongan = 1;
                } else if ($usia >= 10 && $usia <= 15) {
                    $golongan = 2;
                } else if ($usia >= 16 && $usia <= 20) {
                    $golongan = 3;
                } else if ($usia >= 21 && $usia < 25) {
                    $golongan = 4;
                } else if ($usia >= 25) {
                    $golongan = 5;
                }
            }
            $item->update(['pramuka'=>$golongan]);
            $i++;
        }

        return response()->json([
            'message' => 'Berhasil mengupdate '.$i.' data'
        ], 200);
    }
}
