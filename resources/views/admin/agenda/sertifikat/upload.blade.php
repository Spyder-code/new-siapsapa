@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <a href="{{ route('agenda.show',$agenda) }}">Kembali ke Detail Agenda</a>
                <div class="card p-3 m-3">
                    <span>Upload Template Sertifikat Agenda</span>
                    <hr>
                    <form action="{{ route('agenda.update',$agenda) }}" method="post" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        @method('PUT')
                        <div class="d-flex gap-3">
                            <input type="file" name="sertifikat">
                        </div>
                        <div class="btn-group mt-2">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <a class="btn btn-sm btn-info" href="{{ route('page.sertifikat.agenda',['agenda'=>$agenda->id,'type'=>'PESERTA']) }}">Print Sertifikat</a>
                        </div>
                        <img src="{{ asset('berkas/agenda/sertifikat-'.$agenda->id.'.jpg') }}" class="img-fluid my-2" style="height: 100px">
                    </form>
                    @foreach ($agenda->kegiatan as $kegiatan)
                    @if ($kegiatan->lomba)
                    <div class="card p-3 shadow mb-2">
                        <span class="mt-4"> Sertifikat {{ $kegiatan->nama_kegiatan }}</span>
                        <hr>
                        <div>
                            <div class="d-flex flex-wrap btn-group gap-3">
                                <a class="btn btn-sm btn-info" href="{{ route('page.sertifikat.lomba',['lomba'=>$kegiatan->lomba->id,'type'=>'PESERTA']) }}"><i class="fas fa-print"></i> Print Sertifikat Peserta</a>
                                <a class="btn btn-sm btn-warning" href="{{ route('page.sertifikat.lomba',['lomba'=>$kegiatan->lomba->id,'type'=>'JUARA']) }}"><i class="fas fa-print"></i> Print Sertifikat Juara</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card p-3">
                    <span>Contoh Sertifikat</span>
                    <hr>
                    <img src="{{ asset('sertif.jpg') }}" class="img-fluid">
                    <p class="mt-3">Spesifikasi Layout:</p>
                    <ul>
                        <li>Ukuran 900x600 px</li>
                        <li>Panjang Atas 200px</li>
                        <li>Panjang Bawah 200px</li>
                        <li>Panjang Ruang Kosong di tengah layout untuk Nama Peserta dan Status Kepesertaan 200px</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
