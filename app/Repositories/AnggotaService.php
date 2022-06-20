<?php namespace App\Repositories;

use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Gudep;
use App\Models\Kta;
use App\Models\Provinsi;
use App\Models\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AnggotaService{

    public function createUserArray($data)
    {
        $data_arr = [];
        $prov = Auth::user()->anggota->provinsi;
        $kab = Auth::user()->anggota->kabupaten;
        $kec = Auth::user()->anggota->kecamatan;
        $gud = Auth::user()->anggota->gudep;
        foreach ($data['nik'] as $key => $value) {
            $email = $data['email'][$key] == '-' ? $data['nik'][$key].'@siapsapa.id' : $data['email'][$key];
            $data_arr[$key]['foto'] =  $data['foto'][$key];
            $data_arr[$key]['tempat_lahir'] =  $data['tempat_lahir'][$key];
            $data_arr[$key]['nohp'] =  $data['nohp'][$key];
            $data_arr[$key]['agama'] =  $data['agama'][$key];
            $data_arr[$key]['jk'] =  $data['jk'][$key];
            $data_arr[$key]['gol_darah'] =  $data['gol_darah'][$key];
            $data_arr[$key]['nik'] =  $value;
            $data_arr[$key]['tgl_lahir'] = Carbon::createFromFormat('d/m/Y', $data['tgl_lahir'][$key])->format('Y-m-d');
            $data_arr[$key]['alamat'] =  $data['alamat'][$key];
            $data_arr[$key]['nama'] =  $data['nama'][$key];
            $data_arr[$key]['email'] =   $email;
            $data_arr[$key]['provinsi'] =  $prov;
            $data_arr[$key]['kabupaten'] =  $kab;
            $data_arr[$key]['kecamatan'] =  $kec;
            $data_arr[$key]['gudep'] =  $gud;
            $data_arr[$key]['status'] =  1;
        }

        foreach ($data_arr as $item) {
            $this->createUser($item, false);
        }

        return 'success';
    }

    public function createUser($data, $ulpoad_foto = true)
    {
        $user_data = [
            'name' => $data['nama'],
            'email' => $data['email'],
            'role' => 'anggota',
            'user_id' => $data['nik'],
            'id_wilayah' => $data['kecamatan'],
        ];

        $user_check = User::where('email', $user_data['email'])->first();
        if($user_check==null){
            $user_data['password'] = bcrypt('pramuka');
            $user = User::create($user_data);
        }else{
            $user_check->update($user_data);
            $user = $user_check;
        }

        if(empty($data['kawin'])){
            $data['kawin'] = 0;
        }
        $data['user_id'] = $user->id;
        $data['pramuka'] = $this->getPramuka($data['tgl_lahir'], $data['kawin']);
        $data['kode'] = $this->generateCode($data['kecamatan'], $data['gudep'], $data['jk']);
        if($ulpoad_foto){
            $data['foto'] = $this->uploadImage($data['foto']);
        }else{
            File::move(public_path('berkas/import/foto/'.$data['foto']), public_path('berkas/anggota/'.$data['foto']));
        }

        $kta = Kta::where('kabupaten', $data['kabupaten'])->where('pramuka_id', $data['pramuka'])->first();
        if($kta){
            $data['kta_id'] = $kta->id;
        }

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

        $data['pramuka'] = $this->getPramuka($data['tgl_lahir'],$data['kawin']);
        if(!empty($data['foto'])){
            $data['foto'] = $this->uploadImage($data['foto']);
        }
        $anggota->update($data);
        $user = User::find($anggota->user_id)->update($user_data);

        return $anggota;
    }

    public function getPramuka($tgl_lahir, $kawin = 0)
    {
        if($kawin==1){
            $golongan = 5;
        }else{
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
