<?php

namespace App\Http\Controllers;

use App\Jobs\SyncAnggotaKta;
use App\Jobs\SyncGolongan;
use App\Jobs\SyncStatusAnggota;
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
        $data = Anggota::all();
        $i = 0;
        foreach ($data->chunk(500) as $anggota) {
            // foreach ($anggota as $item) {
            //     $kta = Kta::where('kabupaten',$item->kabupaten)->first();
            //     if($kta){
            //         $item->update(['kta_id'=>$kta->id]);
            //     }
            // }
            dispatch(new SyncAnggotaKta($anggota))->delay(now()->addMinutes(1));
            $i++;
        }

        return response()->json([
            'message' => 'Berhasil mengupdate data '. $i .' data'
        ], 200);
    }

    public function golongan()
    {
        $anggota = Anggota::all();
        $i = 0;
        foreach ($anggota->chunk(500) as $item ) {
            dispatch(new SyncGolongan($item))->delay(now()->addMinutes(1));
            $i++;
        }

        return response()->json([
            'message' => 'Berhasil mengupdate '.$i.' data'
        ], 200);
    }

    public function status()
    {
        $anggota = Anggota::all();
        $i = 0;
        foreach ($anggota->chunk(500) as $item ) {
            dispatch(new SyncStatusAnggota($item))->delay(now()->addMinutes(1));
            $i++;
        }

        return response()->json([
            'message' => 'Berhasil mengupdate '.$i.' data'
        ], 200);
    }
}
