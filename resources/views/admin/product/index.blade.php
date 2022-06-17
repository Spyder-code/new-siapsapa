@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/magnific.css') }}">
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Produk', 'url' => '#'],
        ]"

        :title="'Produk'"
        :description="'Produk Saya'"
    />
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <a href="{{ route('product.create') }}" class="btn btn-success">Tambah Produk</a>
    </div>
</div>
@endsection
@section('content')
    <div class="row el-element-overlay">
        @forelse ($data as $product)
        <div class="col-lg-3 col-md-6">
            <x-product.item :product="$product" />
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-light-info">
                <h5 class="text-center">Tidak ada produk</h5>
            </div>
        </div>
        @endforelse
    </div>
@endsection

@section('script')
    <script src="{{ asset('dashboard/dist/js/magnific.js') }}"></script>
    <script src="{{ asset('dashboard/dist/js/magnific.init.js') }}"></script>
@endsection
