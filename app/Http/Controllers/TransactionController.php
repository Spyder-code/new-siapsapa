<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Kta;
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
        $data = Cart::where('user_id', Auth::id())->with('anggota')->get();
        $count = $data->count();
        $total = 0;
        $weight = $data->count() * 10;
        foreach ($data as $item) {
            $anggota = $item->anggota;
            $city = City::find($anggota->kabupaten);
            $kta = Kta::where('kabupaten',$anggota->kabupaten)->where('provinsi',$anggota->provinsi)->where('pramuka_id',$anggota->pramuka)->first();
            if($kta){
                $anggota->update([
                    'kta_id' => $kta->id
                ]);
            }
            $total += $city->harga;
            $item->update([
                'harga' => $city->harga
            ]);
        }
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
        // if($cek>0){
        //     return back()->with('danger', 'KTA ada yang salah. Harap hubungi admin untuk proses selanjutnya');
        // }
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
        $data = $request->all();
        if($request->golongan){
            $data['kta_id'] = Kta::where('pramuka_id',$request->golongan)->where('kabupaten',$transaction->anggota->kabupaten)->first()->id;
        }
        $transaction->update($data);

        return back()->with('success','Data berhasil diupdate');
    }

    public function updateTransactionDetail(Request $request, TransactionDetail $transaction)
    {
        $data = $request->all();
        if($request->file){
            $file = $request->file('file');
            $name = $transaction->id.'_'.$file->getClientOriginalName();
            $file->storeAs('public/transaction',$name);
            $data['file'] = 'storage/transaction/'.$name;
        }
        if($request->verifikasi){
            $data['payment_status'] = 1;
            $data['status'] = 2;
        }
        $transaction->update($data);

        return back()->with('success','Data berhasil diupdate');
    }


    public function destroy(Transaction $transaction)
    {
        //
    }

    public function pay(TransactionDetail $transactionDetail)
    {
        $midtransService = new MidtransService();
        $trx = $midtransService->qris($transactionDetail);
        return redirect()->route('transaction.pay.page',$trx);
    }

    public function pay_page(TransactionDetail $transaction)
    {
        if($transaction->payment_status==3){
            $transactionDetail = $transaction;
            return view('successPayment', compact('transactionDetail'));
        }else{
            if($transaction->payment_type=='midtrans'){
                $midtransService = new MidtransService();
                $data = $midtransService->qris($transaction);
                $transaction = $data['transaction'];
                $payment_url = $data['payment_url'];
                return view('payment', compact('transaction','payment_url'));
            }else{
                if(!$transaction->code){
                    $transaction->update([
                        'code' => 'KTA/'.date('ymdHi').'/'.sprintf('%03d',$transaction->id),
                    ]);

                    $transaction = TransactionDetail::find($transaction->id);
                }
                return view('siplah', compact('transaction'));
            }
        }
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
