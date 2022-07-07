@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Management', 'url' => '#'],
            ['name' => 'KTA', 'url' => '#'],
        ]"

        :title="strtoupper($title)"
        :description="'Management KTA'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Form KTA</h4>
            </div>
            <form action="{{ route('kta.store') }}" method="post" class="card-body needs-validation row" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="provinsi" value="{{ $kabupaten->province_id }}">
                <input type="hidden" name="kabupaten" value="{{ $kabupaten->id }}">
                @include('admin.kta.form',['harga'=>$kabupaten->harga,'kta'=>$kta])
                <div class="mb-3 btn-group">
                    <a href="{{ route('kwartir.index',['id_wilayah'=>$kabupaten->province_id]) }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

