<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Anggota;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function getCartByUserId ($user_id)
    {
        //get cart response with error message
        $cart = Cart::where('user_id', $user_id)->get();
        if (!$cart || $cart->isEmpty()) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }
        return CartResource::collection($cart);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'anggota_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $anggota = Anggota::find($request->anggota_id);
        if(!$anggota || $anggota->kta_id == null){
            return response()->json([
                'message' => 'KTA tidak aktif. Harap hubungi admin untuk mengaktifkan KTA anda.'
            ], 404);
        }
        $check = Cart::where('anggota_id',$request->anggota_id)->first();
        if($check){
            return response()->json(['message'=>'Berhasil menambahkan ke keranjang. Silahkan cek keranjang!','data'=>new CartResource($check),'status'=>200]);
        }
        $harga = $anggota->city->harga;
        $cart = Cart::create([
            'user_id' => $request->user_id,
            'anggota_id' => $request->anggota_id,
            'kta_id' => $anggota->kta_id,
            'harga' => $harga,
            'golongan' => $anggota->pramuka
        ]);

        return response()->json(['message'=>'Berhasil menambahkan ke keranjang. Silahkan cek keranjang!','data'=>new CartResource($cart),'status'=>200]);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json([
                'message' => 'Cart not found'
            ], 404);
        }
        $cart->delete();
        return response()->json('Cart deleted successfully');
    }

    public function numberOfCart()
    {
        $user_id = request('user_id');
        $cart = Cart::all()->where('user_id', $user_id)->count();
        return response()->json($cart);
    }
}
