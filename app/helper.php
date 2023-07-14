<?php

use App\Models\Anggota;

if (! function_exists('umur')) {
    function umur($tgl)
    {
        $tanggal_sekarang = date("Y-m-d");

        // Mengubah tanggal lahir menjadi objek DateTime
        $tanggal_lahir_obj = new DateTime($tgl);

        // Mengubah tanggal saat ini menjadi objek DateTime
        $tanggal_sekarang_obj = new DateTime($tanggal_sekarang);

        // Menghitung selisih antara tanggal lahir dan tanggal saat ini
        $selisih = $tanggal_lahir_obj->diff($tanggal_sekarang_obj);

        // Mendapatkan tahun, bulan, dan hari dari selisih
        $tahun = $selisih->y;
        $bulan = $selisih->m;
        $hari = $selisih->d;
        return [$tahun,$bulan,$hari];
    }
}

if (! function_exists('golongan')) {
    function golongan($id)
    {
        $data = Anggota::find($id);
        if($data->pramuka==1){
            $warna = '<span class="badge bg-siaga">Siaga</span>';
        }elseif($data->pramuka==2){
            $warna = '<span class="badge bg-penggalang">Penggalang</span>';
        }elseif($data->pramuka==3){
            $warna = '<span class="badge bg-penegak">Penegak</span>';
        }elseif($data->pramuka==4){
            $warna = '<span class="badge bg-pandega">Pandega</span>';
        }elseif($data->pramuka==5){
            $warna = '<span class="badge bg-dewasa">Dewasa</span>';
        }elseif($data->pramuka==6){
            $warna = '<span class="badge bg-dewasa">Pembina</span>';
        }elseif($data->pramuka==7){
            $warna = '<span class="badge bg-dewasa">Pelatih</span>';
        }elseif($data->pramuka==8){
            $warna = '<span class="badge bg-dewasa">Saka</span>';
        }else{
            $warna = '<span class="badge bg-white text-dark">-</span>';
        }

        return $warna;
    }
}
