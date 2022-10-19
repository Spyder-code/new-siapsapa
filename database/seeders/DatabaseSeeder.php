<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostMedia;
use App\Models\PostTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Post::factory(30)->create();
        // PostTag::factory(50)->create();
        // PostMedia::factory(100)->create();

        $this->call([
            // AnggotaStatusSeeder::class
            // UserSeeder::class
            // DocumentTypeSeeder::class,
            // OrganizationSeeder::class
            ReactSeeder::class
        ]);
    }
}
