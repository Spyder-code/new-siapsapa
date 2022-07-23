@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Payment', 'url' => '#'],
            ['name' => 'Success', 'url' => '#'],
        ]"

        :title="'Pembayaran'"
        :description="'Pembayaran status'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">
                    <h4 class="alert-heading">Pembayaran berhasil!</h4>
                    <p>Terima kasih telah melakukan pembayaran. Kami akan segera memproses pesanan anda.</p>
                    <hr>
                    <p class="mb-0">
                        <a href="{{ route('transaction.show', $transaction) }}" class="btn btn-primary">Detail Transaksi</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

