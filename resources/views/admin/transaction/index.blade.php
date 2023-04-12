@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '#'],
            ['name' => 'Transaksi', 'url' => '#'],
        ]"

        :title="'Transaksi'"
        :description="'Daftar Transaksi'"
    />
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between">
                <h4 class="card-title mb-0">List Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Penerima</th>
                                <th>Phone</th>
                                <th>Total Pembayaran KTA</th>
                                <th>Ongkir</th>
                                <th>Status Pesanan</th>
                                <th>Metode Pembayaran</th>
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
                                <td>Rp. {{ number_format($item->item_price) }}</td>
                                <td>Rp. {{ number_format($item->ekspedisi_price) }}</td>
                                <td>{{ $item->statusInfo->name }}</td>
                                <td>
                                    <form action="{{ route('transactiondetail.update',$item) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <select name="payment_type" id="payment_type{{ $item->id }}" class="form-control" onchange="submit()">
                                            <option {{ $item->payment_type=='midtrans'?'selected':'' }} value="midtrans">E-Money/Transfer Rekening</option>
                                            <option {{ $item->payment_type=='siplah'?'selected':'' }} value="siplah">SIPLAH (BLIBLI)</option>
                                        </select>
                                    </form>
                                </td>
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
                                    <form action="{{ route('transaction.pay.page',$item) }}" method="GET">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            Bayar
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

@section('script')
    <script>
        var table = $(".file-export").DataTable();
    </script>
@endsection
