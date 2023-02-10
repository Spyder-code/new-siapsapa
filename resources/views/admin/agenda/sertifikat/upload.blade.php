@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <a href="{{ route('agenda.show',$agenda) }}">Kembali ke Detail Agenda</a>
                <div class="card p-3 mt-3">
                    <span>Upload Template Sertifikat Agenda</span>
                    <hr>
                    <form action="{{ route('agenda.update',$agenda) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex gap-3">
                            <input type="file" name="sertifikat">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
                        <img src="{{ asset('berkas/agenda/sertifikat-'.$agenda->id.'.jpg') }}" class="img-fluid my-2" style="height: 100px">
                    </form>
                    @foreach ($agenda->kegiatan as $kegiatan)
                    @if ($kegiatan->lomba)
                    <span class="mt-4">Upload Template Sertifikat {{ $kegiatan->nama_kegiatan }}</span>
                    <hr>
                    <form action="{{ route('lomba.update',$kegiatan->lomba) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex gap-3">
                            <input type="file" name="sertifikat">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
                        <img src="{{ asset('berkas/agenda/sertifikat-lomba-'.$kegiatan->lomba->id.'.jpg') }}" class="img-fluid my-2" style="height: 100px">
                        </form>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card p-3">
                    <span>Contoh Sertifikat</span>
                    <hr>
                    <img src="{{ asset('berkas/template_sertifikat.png') }}" class="img-fluid">
                    <p class="mt-3">Spesifikasi Layout:</p>
                    <ul>
                        <li>Ukuran 900x600 px</li>
                        <li>Ruang Kosong di tengah layout untuk Nama Peserta</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
