<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Provinsi;
use App\Models\TransferAnggota;
use Illuminate\Http\Request;

class TransferAnggotaController extends Controller
{
    public function cancel(TransferAnggota $transfer_anggota)
    {
        $transfer_anggota->delete();
        return back()->with('success','Transfer Anggota Berhasil di Batalkan');
    }

    public function reject(TransferAnggota $transfer_anggota)
    {
        $transfer_anggota->update(['status'=>2]);
        return back()->with('success','Transfer Anggota Berhasil di Tolak');
    }

    public function approve(TransferAnggota $transfer_anggota)
    {
        $transfer_anggota->update(['status'=>1]);
        $gudep = Gudep::find($transfer_anggota->to_gudep);
        $kode = $this->generateCode($gudep,strtoupper($transfer_anggota->anggota->jk[0]));
        $anggota = $transfer_anggota->anggota->update(['kode'=>$kode,'gudep'=>$transfer_anggota->to_gudep]);
        return back()->with('success','Transfer Anggota Berhasil di Setujui');
    }

    public function generateCode(Gudep $gudep, $jk = null)
    {
        $kec = Distrik::find($gudep->kecamatan);
        $kab = City::find($gudep->kabupaten);
        $prov = Provinsi::find($gudep->provinsi);
        $kode_wil = $prov->no_prov .'.'. $kab->no_kab .'.'. $kec->no_kec .'.';
        if($jk=='P'){
            $kode_gudep = $gudep->no_putri;
        }else{
            $kode_gudep = $gudep->no_putra;
        }

        $rand = rand(99999, 999999);
        $kode = $kode_wil . $kode_gudep .'.'. $rand;
        return $kode;
    }
}
