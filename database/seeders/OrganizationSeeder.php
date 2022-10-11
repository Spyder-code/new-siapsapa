<?php

namespace Database\Seeders;

use App\Models\Organizations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Pembina Pramuka'],
            ['name' => 'Pelatih Pembina Pramuka'],
            ['name' => 'Pembina Profesional'],
            ['name' => 'Pamong Saka'],
            ['name' => 'Instruktur Saka'],
            ['name' => 'Pimpinan Saka'],
            ['name' => 'Pimpinan Sako'],
            ['name' => 'Andalan'],
            ['name' => 'Majelis Pembimbing'],
            ['name' => 'Staff kwartir'],
            ['name' => 'Gugus Darma'],
        ];

        Organizations::insert($data);
    }
}
