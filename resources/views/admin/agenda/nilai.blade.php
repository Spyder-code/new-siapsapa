@extends('layouts.social')
@section('content')
    <section class="mb-5">
        <div class="container">
            <a href="{{ route('agenda.detail',$lomba->kegiatan->agenda_id) }}"> Kembali ke agenda</a>
            <p style="text-transform: uppercase">Penilaian {{ $lomba->kegiatan->nama_kegiatan }}</p>
            @if ($lomba->penilaian=='vote')
                @include('admin.agenda.nilai_vote')
            @endif
            @if ($lomba->penilaian=='subjective')
                @include('admin.agenda.nilai_juri')
            @endif
            @if ($lomba->penilaian=='objective')
                <p class="text-center">PENILAIAN MASIH DALAM PENGEMBANGAN</p>
            @endif
        </div>
    </section>
@endsection
