<?php

namespace Database\Seeders;

use App\Models\AnggotaStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama'=>'Tidak Aktif', 'deskripsi'=>'Anggota sudah terdaftar tapi tidak aktif'],
            ['nama'=>'Aktif', 'deskripsi'=>'Anggota Aktif'],
            ['nama'=>'Belum di validasi', 'deskripsi'=>'Anggota baru mendaftar'],
        ];

        AnggotaStatus::insert($data);
    }
}
