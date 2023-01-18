@extends('layouts.social')
@section('content')
    <section class="mb-5">
        <div class="container">
            <a href="{{ route('social.event') }}"> Kembali ke agenda</a>
            <p style="text-transform: uppercase">Penilaian {{ $agenda->nama }}</p>
            @if ($agenda->penilaian=='vote')
                @include('admin.agenda.nilai_vote')
            @endif
            @if ($agenda->penilaian=='subjective')
                @include('admin.agenda.nilai_juri')
            @endif
            @if ($agenda->penilaian=='objective')
                <p class="text-center">PENILAIAN MASIH DALAM PENGEMBANGAN</p>
            @endif
        </div>
    </section>
@endsection
