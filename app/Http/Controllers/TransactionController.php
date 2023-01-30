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
        $role = Auth::user()->role;
        $query = TransactionDetail::query();
        if($role=='admin'){
            if(request()->has('status')){
                $query->where('status',request('status'));
            }
            $transactions = $query->get();
        }else{
            if(request()->has('status')){
                $query->where('status',request('status'));
            }
            $transactions = $query->where('user_id',Auth::user()->id)->get();
        }
        return view('admin.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $role = Auth::user()->role;
        if ($role=='gudep') {
            $gudep = Auth::user()->anggota->gudep;
            $data = Cart::whereHas('anggota', function($q) use($gudep){
                $q->where('gudep',$gudep);
            })->get();
            foreach ($data as $item ) {
                $item->update(['user_id'=>Auth::id()]);
            }
        } else {
            $data = Cart::where('user_id', Auth::id())->with('anggota')->get();
        }
        $count = $data->count();
        $total = $data->sum('harga');
        $weight = $data->count() * 10;
        if($count<5){
            return back()->with('danger','Minimal pesan 5 KTA untuk melakukan transaksi');
        }
        return view('admin.transaction.create', compact('total','weight'));
    }

    public function complete(TransactionDetail $transaction)
    {
        $transaction->update([
            'status' => 4
        ]);

        return back()->with('success', 'Pesanan Complete');
    }


    public function store(Request $request)
    {
        $request->validate([
            'ekspedisi_name' => 'required',
            'ekspedisi_tipe' => 'required',
            'ekspedisi_price' => 'required',
        ]);
        $data = $request->all();
        $carts = Cart::all()->where('user_id', Auth::id());
        if ($carts->count() <= 0) {
            return redirect()->back()->with('error', 'Tidak ada produk yang ditambahkan');
        }
        $data['user_id'] = Auth::id();
        $data['item_price'] = (int)str_replace(['Rp.',' ',','],'',$request->item_price);
        $data['ekspedisi_price'] = (int)str_replace(['Rp.',' '],'',$request->ekspedisi_price);
        $data['total'] = $data['item_price'] + $data['ekspedisi_price'];
        $data['payment_status'] = 4;
        $data['status'] = 1;
        $cek = Cart::all()->where('user_id', Auth::id())->whereNull('kta_id')->count();
        if($cek>0){
            return back()->with('danger', 'KTA ada yang salah. Harap hubungi admin untuk proses selanjutnya');
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
        if($request->social){
            return redirect()->route('social.transaction')->with('success', 'Berhasil melakukan transaksi');
        }
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
        $transaction->update($request->all());
        return back()->with('success','Data berhasil diupdate');
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

    public function paymentSuccess()
    {
        if (request('status_code')==200) {
            $transactionDetail = TransactionDetail::where('code', request('order_id'))->first();
            return view('successPayment', compact('transactionDetail'));
        }else{
            abort(404);
        }
    }
}
