<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Pramuka'],
            ['name'=>'Karya Ilmiah'],
            ['name'=>'Desain Grafis'],
            ['name'=>'Video Grafis'],
            ['name'=>'Karya Terapan'],
            ['name'=>'Olahraga'],
            ['name'=>'Seni'],
            ['name'=>'Politik'],
            ['name'=>'Agama'],
        ];

        PostCategory::insert($data);
    }
}
