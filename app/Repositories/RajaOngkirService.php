<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class RajaOngkirService {

    private $url;
    private $key;
    public function __construct()
    {
        $this->url = 'https://api.rajaongkir.com/'.env('TIPE').'/';
        $this->key = env('RAJA_ONGKIR');
    }

    public function getProvince($id = null)
    {
        $response = Http::get($this->url.'province',[
            'key' => $this->key,
            'id' => $id
        ]);

        $data = $response->json();
        return $data['rajaongkir']['results'];
    }

    public function getCity($province_id = null,$id = null)
    {
        $response = Http::get($this->url.'city',[
            'key' => $this->key,
            'province' => $province_id,
            'id' => $id
        ]);

        $data = $response->json();
        return $data['rajaongkir']['results'];
    }

    public function getCost(array $data)
    {
        $response = Http::post($this->url.'cost',[
            'key' => $this->key,
            'origin' => $data['origin'],
            'destination' => $data['destination'],
            'weight' => $data['weight'],
            'courier' => $data['courier'],
        ]);

        $data = $response->json();
        return $data['rajaongkir']['results'][0];
    }
}
