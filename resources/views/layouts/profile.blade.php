@extends('layouts.user')
@section('style')
    @yield('style-user')
@endsection
@section('content')
    @php
        if (empty($anggota)) {
            $anggota = Auth::user()->anggota;
        }
    @endphp
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-4 mt-2">
                @if (!empty($anggota) && $anggota->kta_id !=null)
                    <x-single-card :anggota="$anggota" />
                @endif
                <div class="card mt-3">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            {{-- <a class="list-group-item text-center">
                                <img src="{{ empty($anggota)?asset('images/logosiap.png'):asset('berkas/anggota/'. $anggota->foto) }}" alt="siapsapa" class="img-fluid" style="height: 150px">
                            </a> --}}
                            @if (!empty($anggota)&&Auth::user()->role != 'anggota')
                            <a href="{{ route('statistik.index') }}" class="list-group-item">
                                <i style="margin-right: 20px" class="fas fa-chart-line"></i> Dashboard Admin
                            </a>
                            @endif
                            <a href="{{ route('page.profile') }}" class="list-group-item">
                                <i style="margin-right: 20px" class="fas fa-user"></i> Data Saya
                            </a>
                            <a href="{{ route('page.change_password') }}" class="list-group-item">
                                <i style="margin-right: 20px" class="fas fa-key"></i> Ubah Password
                            </a>
                            <a href="{{ route('page.my_agenda') }}" class="list-group-item">
                                <i style="margin-right: 20px" class="fas fa-calendar"></i>
                                Agenda Saya
                            </a>
                            <a href="{{ route('page.document') }}" class="list-group-item">
                                <i style="margin-right: 20px" class="fas fa-book"></i> Unggah Dokumen
                            </a>
                            <a href="#" class="list-group-item">
                                <i style="margin-right: 20px" class="fas fa-heart"></i> Pesanan Saya <small class="text-secondar" style="margin-left: 10px; font-size:.7rem">(Coming Soon)</small>
                            </a>
                            <a href="#" class="list-group-item">
                                <i style="margin-right: 20px" class="fas fa-pencil-alt"></i> Tulis Artikel <small class="text-secondar" style="margin-left: 10px; font-size:.7rem">(Coming Soon)</small>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 mt-2">
                {{-- error validation --}}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- success message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('danger'))
                    <div class="alert alert-danger">
                        {{ session('danger') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content-user')
            </div>
        </div>
    </div>
@endsection
@section('script')
    @yield('script-user')
@endsection
