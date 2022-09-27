<?php

namespace App\Http\Controllers;

use App\Jobs\SyncAnggotaKta;
use App\Jobs\SyncFoto;
use App\Jobs\SyncGender;
use App\Jobs\SyncGolongan;
use App\Jobs\SyncStatusAnggota;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Document;
use App\Models\Gudep;
use App\Models\Kta;
use App\Models\Provinsi;
use App\Models\Transaction;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    public function kodeNull()
    {
        $data = Anggota::all()->whereNull('kode');
        $i = 0;
        foreach ($data as $item ) {
            $i++;
            $kecamatan = $item->kecamatan;
            $gudep = $item->gudep;
            $jk = $item->jk;
            $kec = Distrik::find($kecamatan);
            $kab = City::find($kec->regency_id);
            $prov = Provinsi::find($kab->province_id);
            $kode_wil = $prov->no_prov .'.'. $kab->no_kab .'.'. $kec->no_kec .'.';
            if ($gudep == null) {
                $kode_gudep = '000';
            }else{
                $gud = Gudep::find($gudep);
                if($jk=='Perempuan'){
                    $kode_gudep = $gud->no_putri;
                }else{
                    $kode_gudep = $gud->no_putra;
                }
            }

            $rand = rand(99999, 999999);
            $kode = $kode_wil . $kode_gudep .'.'. $rand;
            $item->kode = $kode;
            $item->save();
        }

        return $i.' Data berhasil diupdate';
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

    public function gender()
    {
        $data = Anggota::whereRaw('LENGTH(jk) > 1')->get();
        $i = 0;
        foreach ($data->chunk(500) as $anggota) {
            dispatch(new SyncGender($anggota))->delay(now()->addMinutes(1));
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

    public function foto()
    {
        $anggota = Anggota::all();
        $i = 0;
        foreach ($anggota->chunk(500) as $item ) {
            dispatch(new SyncFoto($item))->delay(now()->addMinutes(1));
            $i++;
        }

        return response()->json([
            'message' => 'Berhasil mengupdate '.$i.' data'
        ], 200);
    }

    public function golonganDocument()
    {
        $document = Document::all()->where('status',1);
        foreach ($document as $item ) {
            $item->update(['pramuka'=>$item->documentType->pramuka_id]);
            $anggota = User::find($item->user_id)->anggota;
            $anggota->update([
                'pramuka'=>$item->pramuka
            ]);
        };

        return response()->json([
            'message' => 'Berhasil mengupdate data'
        ], 200);
    }

    public function transaction()
    {
        $transaction = Transaction::all();
        $i = 0;
        foreach ($transaction as $item ) {
            $item->update([
                'golongan'=>$item->anggota->pramuka,
                'kta_id'=>$item->anggota->kta_id,
            ]);
            $i++;
        };
        return response()->json([
            'message' => $i.' Berhasil terupdate'
        ], 200);
    }
}
