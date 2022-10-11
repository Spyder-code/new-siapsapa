<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id'=> 17,'pramuka_id' => 8, 'name'=> 'Saka kalpataru'],
            ['id'=> 18,'pramuka_id' => 8, 'name'=> 'Saka bahari'],
            ['id'=> 19,'pramuka_id' => 8, 'name'=> 'Saka bakti husada'],
            ['id'=> 20,'pramuka_id' => 8, 'name'=> 'Saka bhayangkara'],
            ['id'=> 21,'pramuka_id' => 8, 'name'=> 'Saka dirgantara'],
            ['id'=> 22,'pramuka_id' => 8, 'name'=> 'Saka kencana'],
            ['id'=> 23,'pramuka_id' => 8, 'name'=> 'Saka Taruna bumi'],
            ['id'=> 24,'pramuka_id' => 8, 'name'=> 'Saka wanabakti'],
            ['id'=> 25,'pramuka_id' => 8, 'name'=> 'Saka wira kartika'],
            ['id'=> 26,'pramuka_id' => 8, 'name'=> 'Saka pariwisata'],
            ['id'=> 27,'pramuka_id' => 8, 'name'=> 'Saka widya budaya bakti'],
            ['id'=> 28,'pramuka_id' => 8, 'name'=> 'Saka POM'],
            ['id'=> 29,'pramuka_id' => 8, 'name'=> 'Saka adyaksa pemilu'],
            ['id'=> 30,'pramuka_id' => 8, 'name'=> 'Saka milenial'],
            ['id'=> 31,'pramuka_id' => 8, 'name'=> 'Saka Informatika'],
            ['id'=> 32,'pramuka_id' => 8, 'name'=> 'Saka bina sosial'],
        ];

        DocumentType::insert($data);
    }
}
