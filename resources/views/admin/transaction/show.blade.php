@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '#'],
            ['name' => 'Detail', 'url' => '#'],
            ['name' => 'Transaksi', 'url' => '#'],
        ]"

        :title="'Transaksi'"
        :description="'Detail Transaksi'"
    />
</div>
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12 col-md-6">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Penerima:</span> {{ $transaction->penerima }}</li>
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Phone:</span> {{ $transaction->phone }}</li>
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Alamat:</span> {{ $transaction->alamat }}</li>
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Kota:</span> {{ $transaction->kota }}</li>
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Kode Pos:</span> {{ $transaction->kode_pos }}</li>
        </ul>
    </div>
    <div class="col-12 col-md-6">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Total Pembayaran</span> Rp. {{ number_format($transaction->total) }}</li>
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Status Pesanan:</span> {{ $transaction->statusInfo->name }}</li>
            <li class="list-group-item d-flex justify-content-between"><span style="width:100px">Status Pembayaran:</span> {{ $transaction->paymentInfo->name }}</li>
        </ul>
    </div>
    <div class="col-12 mt-5">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between">
                <h4 class="card-title mb-0">List Pesanan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped file-export" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Golongan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="justify-content-center text-center">
                                        <img src="{{ asset('berkas/anggota/'.$item->anggota->foto) }}" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                                        <span class="badge bg-primary">{{ $item->anggota->kode }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->anggota->nama }}</td>
                                <td>
                                    {{ $item->pramuka->name }}
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
