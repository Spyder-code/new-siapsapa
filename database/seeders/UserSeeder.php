<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'user_id' => null,
            'name' => 'percetakan',
            'email' => 'percetakan@gmail.com',
            'password' => bcrypt('pramuka'),
            'role' => 'percetakan',
        ]);
    }
}
