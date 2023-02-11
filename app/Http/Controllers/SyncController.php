<?php

namespace App\Http\Controllers;

use App\Jobs\SyncAnggotaKta;
use App\Jobs\SyncFoto;
use App\Jobs\SyncGender;
use App\Jobs\SyncGolongan;
use App\Jobs\SyncGudepCode;
use App\Jobs\SyncStatusAnggota;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Document;
use App\Models\Gudep;
use App\Models\Kta;
use App\Models\PendaftaranAgenda;
use App\Models\Provinsi;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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
        $documents = Document::all()->where('status',1)->groupBy('user_id');
        $i = 0;
        foreach ($documents as $document) {
            $now = 0;
            $pramuka = 0;
            foreach ($document as $item) {
                if($item->document_type_id>$now){
                    $now = $item->document_type_id;
                    $pramuka = $item->pramuka;
                }
            }
            $anggota = User::find($document->first()->user_id)->anggota;
            if($pramuka<8){
                if($anggota){
                    $anggota->update(['tingkat'=>$now,'pramuka'=>$pramuka]);
                }else{
                    Document::where('user_id',$document->first()->user_id)->delete();
                }
            }
            $i++;
        }

        return response()->json([
            'message' => 'Berhasil mengupdate : '.$i.' data'
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

    public function dataAnggota($gudep_id)
    {
        $data = Anggota::where('gudep',$gudep_id)->get();
        $i = 0;
        foreach ($data as $item ) {
            if (!filter_var($item->email, FILTER_VALIDATE_EMAIL)) {
                // invalid
                $item->update([
                    'email' => $item->nohp,
                    'jk' => $item->gol_darah,
                    'agama' => $item->email,
                    'gol_darah' => $item->keterangan,
                    'nohp' => $item->jk,
                    'alamat' => $item->agama,
                    'keterangan' => '-'
                ]);
                $i++;
            }
        }

        return response($i.' data berhasil terupdate');
    }

    public function pramukaNull()
    {
        $data = Anggota::whereNull('pramuka')->get();
        $i = 0;
        foreach ($data as $item ) {
            if($item->tingkat >= 13 ){
                $golongan = 6;
            }else{
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
            }
            $item->update(['pramuka'=>$golongan]);
            $i++;
        }

        return response($i.' Data berhasil terupdate');
    }

    public function kodeGudep($id)
    {
        $anggota = Anggota::where('gudep',$id)->get();
        dispatch(new SyncGudepCode($anggota));


        return response()->json([
            'message' => 'Berhasil mengupdate data'
        ], 200);
    }

    public function agendaDaftar()
    {
        $i = 0;
        $data = PendaftaranAgenda::all();
        foreach ($data as $item ) {
            $gudep = $item->anggota->gudep;
            if(!is_null($gudep)){
                $item->update([
                    'gudep_id' => $gudep
                ]);
                $i++;
            }
        }

        return response()->json([
            'message' => 'Berhasil mengupdate '.$i.' data'
        ], 200);
    }

    public function addKta()
    {
        $i=0;
        $trx = TransactionDetail::find(1000);
        if (!$trx) {
            TransactionDetail::create([
                'id' => 1000,
                'user_id' => 1,
                'code' => 'TEST',
                'penerima' => 'TEST',
                'phone' => '0987654321256',
                'province_id' => 1,
                'city_id' => 32,
                'alamat' => 'TEST',
                'kota' => 'TEST',
                'kode_pos' => 'T990',
                'item_price' => 20000,
                'ekspedisi_name' => 'JNE',
                'ekspedisi_tipe' => 'TEST',
                'ekspedisi_price' => 1000,
                'total' => 21000,
                'status' => 4,
                'payment_status' => 3,
                'resi' => 'TEST',
                'snap_token' => 'TEST',
            ]);
        }
        $data = Anggota::whereDoesntHave('cetak')->get();
        foreach ($data as $item ) {
            Transaction::create([
                'user_id' => $item->user_id,
                'transaction_detail_id' => 1000,
                'kta_id' => 5,
                'anggota_id' => $item->id,
                'harga' => 10000,
                'golongan' => $item->pramuka,
                'status_percetakan' =>1
            ]);
            $i++;
        }
        return response()->json([
            'message' => 'Berhasil mengupdate '.$i.' data'
        ], 200);
    }
}
