<?php

namespace App\Repositories;

use App\Models\Anggota;
use App\Models\Gudep;

class GudepService extends Repository
{

    public function updateKodeAnggota($gudep_id)
    {
        $gudep = Gudep::find($gudep_id);
        $anggota = Anggota::where('gudep',$gudep_id)->get();
        foreach ($anggota->chunk(500) as $data) {
            foreach ($data as $item) {
                $kode = $item->jk=='Perempuan'? $gudep->no_putri : $gudep->no_putra;
                $item->update([
                    'kode' => substr_replace($item->kode,$kode,9,3)
                ]);
            }
        }
    }
}
