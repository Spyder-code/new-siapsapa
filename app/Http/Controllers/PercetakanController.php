<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PercetakanController extends Controller
{
    public function index()
    {
        $status = request('status');
        return view('admin.percetakan.index', compact('status'));
    }

    public function batch()
    {
        $transactions = TransactionDetail::where('status', 2)->where('payment_status','<', 4)->get();
        return view('admin.percetakan.batch', compact('transactions'));
    }

    public function batchShow(TransactionDetail $transaction)
    {
        $transactions = $transaction->transactions;
        return view('admin.percetakan.batchShow', compact('transactions', 'transaction'));
    }

    public function updateStatus(Request $request)
    {
        $data = explode(',',$request->transaction_id);
        $transaction = Transaction::whereIn('id', $data)->update(['status_percetakan' => $request->status]);
        return redirect()->route('percetakan.index',['status'=> $request->status])->with('success', 'Aksi berhasil');
    }

    public function print(Request $request)
    {
        $data = explode(',',$request->transaction_id);
        $transaction = Transaction::whereIn('id', $data)->get();
        $data = array();
        foreach ($transaction->chunk(5) as $idx => $cart) {
            $data[$idx] = $cart;
        }
        return view('new-print', compact('data'));
    }

    public function complete(TransactionDetail $transaction)
    {
        $transaction->update([
            'status' => 3
        ]);

        return back()->with('success', 'Percetakan Kode'.$transaction->code.' berhasil.');
    }

    public function data_table()
    {
        $data = Transaction::whereHas('transactionDetail', function ($query) {
            $query->where('status', 2);
        })->where('status_percetakan', request('status'))->orderBy('transaction_detail_id','desc')->get();

        return DataTables::of($data)
            ->addColumn('foto', function($data){
                if($data->golongan==1){
                    $warna = '<span class="badge bg-siaga">Siaga</span>';
                }elseif($data->golongan==2){
                    $warna = '<span class="badge bg-penggalang">Penggalang</span>';
                }elseif($data->golongan==3){
                    $warna = '<span class="badge bg-penegak">Penegak</span>';
                }elseif($data->golongan==4){
                    $warna = '<span class="badge bg-pandega">Pandega</span>';
                }elseif($data->golongan==5){
                    $warna = '<span class="badge bg-dewasa">Dewasa</span>';
                }else{
                    $warna = '<span class="badge bg-white text-dark">Pelatih</span>';
                }
                return '
                    <div class="justify-content-center text-center">
                    <img src="'.asset('berkas/anggota/'.$data->foto).'" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                        '.$warna.'
                    </div>
                ';
            })
            ->addColumn('nama', function($data){
                return $data->anggota->nama;
            })
            ->addColumn('kwarcab', function($data){
                return $data->anggota->city->name;
            })
            ->addColumn('kwaran', function($data){
                return $data->anggota->district->name;
            })
            ->addColumn('gudep', function($data){
                if($data->anggota->gudep == null){
                    return '-';
                }else{
                    return $data->anggota->gudepInfo->nama_sekolah;
                }
            })
            ->rawColumns(['foto'])
            ->make(true);
    }
}
