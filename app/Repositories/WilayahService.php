<?php namespace App\Repositories;

use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\DocumentType;
use App\Models\Provinsi;
use Carbon\Carbon;

class WilayahService {

    private $id_wilayah;
    public function __construct($id_wilayah)
    {
        $this->id_wilayah = $id_wilayah;
    }

    public function getData()
    {
        $id_wilayah = $this->id_wilayah;
        if ($id_wilayah=='all') {
            return [null,null];
        }
        $len = strlen($id_wilayah);
        if ($len==2) {
            $data = Provinsi::find($id_wilayah);
            $kwartir = 'Provinsi';
        }elseif($len==4){
            $data = City::find($id_wilayah);
            $kwartir = 'Kabupaten';
        }else{
            $data = Distrik::find($id_wilayah);
            $kwartir = 'Kecamatan';
        }

        return [$data, $kwartir];
    }
}
