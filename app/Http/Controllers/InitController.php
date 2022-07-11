<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Cart;
use Illuminate\Http\Request;

class InitController extends Controller
{
    public function addToCart()
    {
        $nik = [
            '5108030794710001',
            '5108084106850005',
            '5108063006090001',
            '5108052310070005',
            '5102101808070001',
            '5108020312070001',
            '5108082101080002',
            '5108051111070006',
            '6108012312070001',
            '5108036611070001',
            '5108055205090002',
            '5108035111070001',
            '5108034610070002',
            '5108024403080001',
            '5108035206070001',
            '5108094404070002',
            '5108084106090001',
            '5107081012070003',
            '5107022612080001',
            '5107082909060001',
            '5107031204070001',
            '5107052105080002',
            '5107050902070003',
            '5107061408080002',
            '5107061401080001',
            '5107043112690127',
            '5107056301080003',
            '5107064511070004',
            '5107075205090002',
            '5107044705080003',
            '5107026208070001',
            '5107035012070001',
            '5107084305080007',
            '5107043112690127',
            '5107064407660002',
        ];

        $success = 0;
        $fail = 0;
        $arrFail = [];
        $data = Anggota::whereIn('nik',$nik)->select('id','pramuka','kta_id','nik')->get();
        foreach ($data as $item ) {
            try {
                Cart::create([
                    'user_id' => 1,
                    'anggota_id' => $item->id,
                    'golongan' => $item->pramuka,
                    'harga' => 10000,
                    'kta_id' => $item->kta_id
                ]);
                $success++;
            } catch (\Throwable $th) {
                $fail++;
                array_push($arrFail,$item->nik);
            }
        }

        return response([
            'success' => $success.' Success add to cart',
            'fail' => $fail.' Failed add to cart =>'. implode(',',$arrFail),
        ]);
    }
}
