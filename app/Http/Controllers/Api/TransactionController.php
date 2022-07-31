<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\TransactionDetailResource;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Repositories\MidtransService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $transactions = TransactionDetail::where('user_id', $user_id)->get();
        if (!$transactions || $transactions->isEmpty()) {
            return response()->json([
                'message' => 'transactions not found'
            ], 404);
        }
        return TransactionDetailResource::collection($transactions);
    }

    public function show(TransactionDetail $transactionDetail)
    {
        $transactions = Transaction::where('transaction_detail_id', $transactionDetail->id)->get();
        if (!$transactions || $transactions->isEmpty()) {
            return response()->json([
                'message' => 'transactions not found'
            ], 404);
        }
        return CartResource::collection($transactions);
    }

    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $data = $request->all();
        $carts = Cart::all()->where('user_id', $user_id);
        if ($carts->count() <= 0) {
            return response()->json('Tidak ada produk yang ditambahkan');
        }
        $data['user_id'] = $user_id;
        $data['item_price'] = $carts->sum('harga');
        $data['ekpedisi_price'] = 0;
        $data['total'] = $data['item_price'] + $data['ekpedisi_price'];
        $data['payment_status'] = 4;
        $data['status'] = 1;
        $cek = Cart::all()->where('user_id', $user_id)->whereNull('kta_id')->count();
        if($cek>0){
            return response()->json('KTA ada yang salah. Harap cek KTA anggota');
        }
        $transactionDetail = TransactionDetail::create($data);
        foreach ($carts as $cart) {
            $items = [
                'user_id' => $cart->user_id,
                'anggota_id' => $cart->anggota_id,
                'kta_id' => $cart->kta_id,
                'harga' => $cart->harga,
                'golongan' => $cart->golongan,
                'transaction_detail_id' => $transactionDetail->id,
            ];
            $transaction = Transaction::create($items);
        }
        Cart::where('user_id', $user_id)->delete();

        return response()->json([
            'message' => 'Berhasil membuat transaksi',
            'data' => $transactionDetail,
        ]);
    }

    public function pay(TransactionDetail $transactionDetail)
    {
        $midtransService = new MidtransService();
        $paymentUrl = $midtransService->pay($transactionDetail);
        return response()->json([
            'message' => 'Berhasil membuat link pembayaran',
            'data' => $paymentUrl,
        ]);
    }
}
