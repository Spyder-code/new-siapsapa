@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'Dokumen', 'url' => '#'],
        ]"

        :title="'Upload Dokumen'"
        :description="'Dokumen Saya'"
    />
    @if (Auth::user()->role != 'anggota')
    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
        <a href="{{ route('agenda.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Agenda</a>
    </div>
    @endif
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="row">
            @forelse ($data as $item)
                <div class="col-12 col-md-6">
                    <x-agenda_card :item="$item" />
                </div>
            @empty
                <img src="{{ asset('images/empty.png') }}" class="img-fluid" width="100%">
            @endforelse
        </div>
    </div>
</div>
@endsection

