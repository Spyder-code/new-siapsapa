<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Cart;
use App\Models\Kta;
use App\Models\Pramuka;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('anggota')->get();
        $pramuka = Pramuka::all();
        return view('admin.cart.index', compact('carts','pramuka'));
    }
    public function store(Request $request)
    {
        $data = explode(',',$request->anggota_id);
        $anggota = Anggota::whereIn('id', $data)->get();
        foreach ($anggota as $item ) {
            Cart::create([
                'user_id' => Auth::id(),
                'anggota_id' => $item->id,
                'golongan' => $item->pramuka,
                'harga' => $item->city->harga,
                'kta_id' => $item->kta_id,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Berhasil menambahkan ke keranjang');
    }

    public function update(Cart $cart, Request $request)
    {
        $data = $request->all();
        if($request->golongan){
            $kta = Kta::where('kabupaten', $cart->anggota->kabupaten)->where('pramuka_id', $request->golongan)->first();
            $data['kta_id'] = $kta->id;
        }
        $cart->update($data);
        return back()->with('success', 'Berhasil mengubah data');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }

    public function print(TransactionDetail $transactionDetail)
    {
        $carts = Transaction::where('transaction_detail_id', $transactionDetail->id)->with('anggota')->get();
        $data = array();
        foreach ($carts->chunk(5) as $idx => $cart) {
            $data[$idx] = $cart;
        }
        return view('new-print', compact('data'));
        $pdf = Pdf::loadView('new-print', compact('data'));
        $file_name = date('d-m-H-i').'.pdf';
        return $pdf->download('cetak.pdf');
    }
}
