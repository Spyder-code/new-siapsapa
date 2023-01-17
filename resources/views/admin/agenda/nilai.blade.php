@extends('layouts.social')
@section('content')
    <section class="mb-5">
        <div class="container">
            <a href="{{ route('social.event') }}"> Kembali ke agenda</a>
            <p style="text-transform: uppercase">Penilaian {{ $agenda->nama }}</p>
            @if ($agenda->penilaian=='vote')
                @include('admin.agenda.nilai_vote')
            @endif
        </div>
    </section>
@endsection
