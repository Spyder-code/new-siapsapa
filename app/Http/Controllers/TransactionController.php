<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Repositories\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = TransactionDetail::all()->where('user_id',Auth::id());
        return view('admin.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $total = Cart::all()->where('user_id', Auth::id())->sum('harga');
        return view('admin.transaction.create', compact('total'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $carts = Cart::all()->where('user_id', Auth::id());
        if ($carts->count() <= 0) {
            return redirect()->back()->with('error', 'Tidak ada produk yang ditambahkan');
        }
        $data['user_id'] = Auth::id();
        $data['item_price'] = $carts->sum('harga');
        $data['ekpedisi_price'] = 0;
        $data['total'] = $data['item_price'] + $data['ekpedisi_price'];
        $data['payment_status'] = 4;
        $data['status'] = 1;
        $cek = Cart::all()->where('user_id', Auth::id())->whereNull('kta_id')->count();
        if($cek>0){
            return back()->with('danger', 'KTA ada yang salah. Harap cek KTA anggota');
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
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('transaction.index')->with('success', 'Berhasil melakukan transaksi');
    }


    public function show(TransactionDetail $transaction)
    {
        $transactions = $transaction->transactions;
        return view('admin.transaction.show', compact('transactions', 'transaction'));
    }


    public function edit(Transaction $transaction)
    {
        //
    }


    public function update(Request $request, Transaction $transaction)
    {
        //
    }


    public function destroy(Transaction $transaction)
    {
        //
    }

    public function pay(TransactionDetail $transactionDetail)
    {
        $midtransService = new MidtransService();
        $paymentUrl = $midtransService->pay($transactionDetail);
        return redirect($paymentUrl);
    }

    public function notificationHandling()
    {
        $midtransService = new MidtransService();
        return $midtransService->notification();
    }
}
