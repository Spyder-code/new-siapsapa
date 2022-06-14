<?php namespace App\Repositories;

use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Provinsi;
use App\Models\User;
use DateTime;

class AnggotaService{

    public function createUser($data)
    {
        $user_data = [
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => bcrypt('pramuka'),
            'role' => 'anggota',
            'user_id' => $data['nik'],
            'id_wilayah' => $data['kecamatan'],
        ];

        $user = User::create($user_data);

        $data['user_id'] = $user->id;
        $data['pramuka'] = $this->getPramuka($data['tgl_lahir']);
        $data['kode'] = $this->generateCode($data['kecamatan'], $data['gudep'], $data['jk']);
        $data['foto'] = $this->uploadImage($data['foto']);

        $anggota = Anggota::create($data);
        return $anggota;
    }

    public function updateUser($data, $anggota)
    {
        $user_data = [
            'name' => $data['nama'],
            'email' => $data['email'],
            'id_wilayah' => $data['kecamatan'],
        ];

        $data['pramuka'] = $this->getPramuka($data['tgl_lahir']);
        if(!empty($data['foto'])){
            $data['foto'] = $this->uploadImage($data['foto']);
        }
        $anggota->update($data);
        $user = User::find($anggota->user_id)->update($user_data);

        return $anggota;
    }

    public function getPramuka($tgl_lahir)
    {
        $tgl = new DateTime($tgl_lahir);
        $now = new DateTime();
        $difference = $tgl->diff($now);
        $usia   = $difference->y; //hitung tahun
        if ($usia < 10) {
            $golongan = 1;
        } else if ($usia >= 10 && $usia <= 15) {
            $golongan = 2;
        } else if ($usia >= 16 && $usia <= 20) {
            $golongan = 3;
        } else if ($usia >= 21 && $usia <= 25) {
            $golongan = 4;
        } else if ($usia > 25) {
            $golongan = 5;
        }

        return $golongan;
    }

    public function generateCode($kecamatan, $gudep = null, $jk = null)
    {
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
        return $kode;
    }

    public function uploadImage($file)
    {
        if($file){
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/berkas/anggota'),$image_name);
            return $image_name;
        }
    }
}
