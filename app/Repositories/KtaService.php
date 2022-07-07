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

        $depan = $kta->id . '-depan.' . $data['depan']->getClientOriginalExtension();
        $belakang = $kta->id . '-belakang.' . $data['belakang']->getClientOriginalExtension();
        $data['depan']->move(public_path('/berkas/kta'),$depan);
        $data['belakang']->move(public_path('/berkas/kta'),$belakang);

        $kta->update([
            'depan' => $depan,
            'belakang' => $belakang,
        ]);

        return 'success';
    }

    public function updateData($data, Kta $kta)
    {
        $depan = $kta->id . '-depan.' . $data['depan']->getClientOriginalExtension();
        $belakang = $kta->id . '-belakang.' . $data['belakang']->getClientOriginalExtension();
        $data['depan']->move(public_path('/berkas/kta'),$depan);
        $data['belakang']->move(public_path('/berkas/kta'),$belakang);

        $kta->update([
            'depan' => $depan,
            'belakang' => $belakang,
        ]);

        return 'success';
    }
}
