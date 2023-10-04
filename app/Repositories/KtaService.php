<?php

namespace App\Repositories;

use App\Models\Anggota;
use App\Models\Kta;

class KtaService extends Repository
{

    public function insertData($data)
    {
        $kta = Kta::create([
            'pramuka_id' => $data['pramuka_id'],
            'provinsi' => $data['provinsi'],
            'kabupaten' => $data['kabupaten'],
            'depan' => 'depan',
            'belakang' => 'belakang',
        ]);

        if (!empty($data['depan'])) {
            $depan = $kta->id . '-depan.' . $data['depan']->getClientOriginalExtension();
            $data['depan']->move(public_path('/berkas/kta'),$depan);
            $kta->update([
                'depan' => $depan,
            ]);
        }
        if(!empty($data['belakang'])){
            $belakang = $kta->id . '-belakang.' . $data['belakang']->getClientOriginalExtension();
            $data['belakang']->move(public_path('/berkas/kta'),$belakang);
            $kta->update([
                'belakang' => $belakang,
            ]);
        }

        Anggota::where('provinsi',$data['provinsi'])->where('kabupaten',$data['kabupaten'])->where('pramuka',$data['pramuka_id'])->update([
            'kta_id' => $kta->id
        ]);

        return 'success';
    }

    public function updateData($data, Kta $kta)
    {
        if(!empty($data['depan'])) {
            $depan = $kta->id . '-depan.' . $data['depan']->getClientOriginalExtension();
            $data['depan']->move(public_path('/berkas/kta'),$depan);
            $kta->update([
                'depan' => $depan,
            ]);
        }
        if(!empty($data['belakang'])){
            $belakang = $kta->id . '-belakang.' . $data['belakang']->getClientOriginalExtension();
            $data['belakang']->move(public_path('/berkas/kta'),$belakang);
            $kta->update([
                'belakang' => $belakang,
            ]);
        }

        Anggota::where('provinsi',$data['provinsi'])->where('kabupaten',$data['kabupaten'])->where('pramuka',$kta->pramuka_id)->update([
            'kta_id' => $kta->id
        ]);

        return 'success';
    }
}
