<?php

namespace App\Repositories;

use App\Models\Anggota;
use App\Models\Gudep;

class GudepService extends Repository
{

    public function updateKodeAnggota($gudep_id)
    {
        $anggota = Anggota::where('gudep',$gudep_id)->get();
        foreach ($anggota->chunk(500) as $data) {
            foreach ($data as $item) {
                $kode = $item->kode;
                $arr = explode('.',$kode);
                $depan = $arr[0].'.'.$arr[1].'.'.$arr[2].'.';
                $belakang = '.'.end($arr);
                $lk = $item->gudepInfo->no_putra;
                $pr = $item->gudepInfo->no_putri;
                if ($item->jk=='L') {
                    $new = $depan.$lk.$belakang;
                }else{
                    $new = $depan.$pr.$belakang;
                }
                $item->update([
                    'kode' => $new
                ]);
            }
        }
    }
}
