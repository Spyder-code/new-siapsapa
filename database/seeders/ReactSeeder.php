<?php

namespace Database\Seeders;

use App\Models\Reacts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Like','path'=>'social/media/figure/reaction_1.png'],
            ['name'=>'Smile','path'=>'social/media/figure/reaction_2.png'],
            ['name'=>'Love','path'=>'social/media/figure/reaction_3.png'],
            ['name'=>'Shy','path'=>'social/media/figure/reaction_4.png'],
            ['name'=>'Angry','path'=>'social/media/figure/reaction_5.png'],
            ['name'=>'Sad','path'=>'social/media/figure/reaction_6.png'],
            ['name'=>'Suprised','path'=>'social/media/figure/reaction_7.png'],
        ];

        Reacts::insert($data);
    }
}
