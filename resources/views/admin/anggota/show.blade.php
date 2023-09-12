@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- dropzone css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<style>
    .dz-image img {
        width: 100%;
        height: 100%;
    }
    .dropzone.dz-started .dz-message {
        display: block !important;
    }
    .dropzone {
        border: 2px dashed #028AF4 !important;;
    }
    .dropzone .dz-preview.dz-complete .dz-success-mark {
        opacity: 1;
    }
    .dropzone .dz-preview.dz-error .dz-success-mark {
        opacity: 0;
    }
    .dropzone .dz-preview .dz-error-message{
        top: 144px;
    }
</style>
@endsection
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Anggota', 'url' => '#'],
            ['name' => 'Detail', 'url' => '#'],
        ]"

        :title="'Detail Anggota'"
        :description="'Anggota'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 justify-content-center">
        <div class="card">
            <div class="border-bottom title-part-padding d-flex justify-content-between">
                <h4 class="card-title mb-0">Detail Profile</h4>
                <div class="d-flex gap-4">
                    <a href="{{ route('anggota.edit', $anggota) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                    @if ($anggota->cetak)
                    <form action="{{ route('percetakan.print') }}" method="post" target="_blank">
                        @csrf
                        <button type="submit" name="transaction_id" class="btn btn-sm btn-success" value="{{ $anggota->cetak->id }}"><i class="fas fa-print"></i> Print</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="card mb-3">
                {{-- @if ($anggota->kta_id==null)
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Info!</strong>
                        Mohon maaf KTA masih belum tersedia untuk anggota ini.
                    </div>
                @else
                    <img src="{{ asset('images/logosiap.png') }}" alt="siapsapa" style="">
                    <x-kta :anggota="$anggota" />
                @endif --}}
                <x-kta :anggota="$anggota" />
                <div class="card-body row">
                    <ul class="list-group list-group-flush col-6">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="">NIK: {{ $anggota->nik }}</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="">Email: {{ $anggota->email }}</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="">Dokumen: {{ $anggota->document_type->name ?? '-' }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
