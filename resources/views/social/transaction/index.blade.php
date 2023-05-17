@extends('layouts.social')
@section('content')
<div class="block-box user-top-header">
    <ul class="menu-list">
        <li><a href="{{ route('social.cart') }}">Keranjang</a></li>
        <li class="{{ $status=='all'?'active':'' }}" style="width: 100%"><a href="{{ route('social.transaction') }}">Semua Transaksi</a></li>
        <li class="{{ $status==0?'active':'' }}" style="width: 100%"><a href="{{ route('social.transaction',['status'=>0]) }}">Belum dibayar</a></li>
        <li class="{{ $status==1?'active':'' }}" style="width: 100%"><a href="{{ route('social.transaction',['status'=>1]) }}">Sudah dibayar</a></li>
        {{-- <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user-photo.html#">Shop</a>
                    <a class="dropdown-item" href="user-photo.html#">Blog</a>
                    <a class="dropdown-item" href="user-photo.html#">Others</a>
                </div>
            </div>
        </li> --}}
    </ul>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom title-part-padding d-flex justify-content-between card-header">
                    <h4 class="card-title mb-0">{{ $status=='all'?'Semua Transaksi':($status=='0'?'Transaksi Belum dibayar':'Transaksi sudah dibayar') }}</h4>
                </div>
                <div class="table-responsive p-4">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Penerima</th>
                                <th>Phone</th>
                                <th>Total Pembayaran</th>
                                <th>Status Pesanan</th>
                                <th>Status Pembayaran</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->penerima }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>Rp. {{ number_format($item->total) }}</td>
                                <td>{{ $item->statusInfo->name }}</td>
                                <td>
                                    <div class="badge bg-light-primary">
                                        {{ $item->paymentInfo->name??'-' }}
                                    </div>
                                </td>
                                <td class="btn-group">
                                    <a href="{{ route('transaction.show',$item) }}" class="btn btn-sm btn-info">
                                        Detail
                                    </a>
                                    @if ($item->payment_status>=4)
                                    <form action="{{ route('transaction.pay',$item) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            Bayar
                                        </button>
                                    </form>
                                    <form action="{{ route('social.transaction.cancel',$item) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')">
                                            Cancel
                                        </button>
                                    </form>
                                    @endif
                                    @if ($item->status==2)
                                    <form action="{{ route('cart.print', $item) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Cetak</button>
                                    </form>
                                    @endif
                                    @if ($item->status==3)
                                    <form action="{{ route('transaction.complete', $item) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('are you sure?')">Tandai Pesanan Sudah diterima Customer</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
