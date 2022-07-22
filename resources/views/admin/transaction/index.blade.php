@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '#'],
            ['name' => 'Transaksi', 'url' => '#'],
        ]"

        :title="'Transaksi'"
        :description="'Daftar Transaksi Pesanan Saya'"
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
                                        {{ $item->paymentInfo->name }}
                                    </div>
                                </td>
                                <td>
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
