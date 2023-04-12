@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="alert {{ !$transaction->file ? 'alert-warning' : 'alert-info' }}">
                            @if (!$transaction->file)
                                {{ strtoupper($transaction->paymentInfo->name) }} <br>
                                <i style="font-size: .8rem" class="text-justify">Pesan produk di SIPLah dengan jumlah <b>{{ $transaction->transactions->count() }}</b> dan lakukan pembayaran lalu <b>upload bukti pembayaran</b> di halaman ini</i>
                            @else
                                @if ($transaction->status==1)
                                Menunggu Verifikasi Admin <br>
                                <i style="font-size: .8rem" class="text-justify">Terima Kasih sudah melakukan transaksi. Harap menunggu sebentar, transaksi segera di verifikasi! </i>
                                @else
                                {{ strtoupper($transaction->paymentInfo->name) }} <br>
                                <i style="font-size: .8rem" class="text-justify">Pembayaran Berhasil. Status pesanan : <b>{{ $transaction->statusInfo->name }}</b></i>
                                @endif
                            @endif
                        </div>
                        <ul class="list-group mt-2" style="font-size: .8rem">
                            <li class="list-group-item d-flex justify-content-between">
                                INVOICE : <span>{{ $transaction->code ?? '-' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                ORDER : <span>Cetak {{ $transaction->transactions->count() }} KARTU TANDA ANGGOTA (KTA)</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                TOTAL HARGA: <span>Rp. {{ number_format($transaction->item_price) }}</span>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <b>Panduan Transaksi</b>
                            <ul>
                                <li>Lakukan Transaksi di SIPLah. <a href="https://siplah.blibli.com/product/kartu-tanda-anggota-pramuka/SSIA-0011-00001" target="d_blank">Lakukan Transaksi</a></li>
                                <li>Tutorial Pesan. <a href="https://youtu.be/O0ob4A0hoJI" target="d_blank">Lihat Tutorial</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-between flex-wrap" style="gap: 10px">
                        @if ($transaction->status==1)
                        <form action="{{ route('transactiondetail.update',$transaction) }}" method="post" style="width: 100%" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" name="file" id="file" class="form-control" accept="">
                            <button class="btn py-2 mt-3 btn-sm btn-success btn-rounded w-100" type="submit"> Upload Bukti Pembayaran</button>
                        </form>
                        @endif
                        <div style="width: 100%">
                            <button type="button" onclick="location.reload()" class="btn py-2 btn-sm btn-info btn-rounded w-100"> Check Payment Status</button>
                        </div>
                        <div style="width: 100%">
                            <a href="{{ route('transaction.index') }}" class="btn py-2 btn-sm btn-secondary btn-rounded w-100"> Back to home</a>
                        </div>
                    </div>
                    @if ($transaction->file)
                        <div class="p-3">
                            <p>Bukti Pembayaran: </p>
                            <img src="{{ asset($transaction->file) }}" alt="TRX" class="img-fluid">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
