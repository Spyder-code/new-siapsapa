<?php

namespace App\Repositories;

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

        return 'success';
    }
}
