@extends('layouts.social')
@section('content')
<div class="banner-user">
    <div class="banner-content">
        <div class="media">
            <div class="item-img">
                <img src="{{ asset('berkas/anggota/02.jpg') }}" alt="User" style="width: 90px; height:90px">
            </div>
            <div class="media-body">
                <h3 class="item-title">{{ $anggota->nama }}</h3>
                <div class="item-subtitle">{{ ucfirst($user->role) }} Kwartir Ranting {{ ucwords(strtolower($anggota->district->name))}}</div>
                <ul class="item-social">
                    <li><a href="user-timeline.html#" class="bg-fb"><i class="icofont-facebook"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-twitter"><i class="icofont-twitter"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-dribble"><i class="icofont-instagram"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-success"><i class="icofont-whatsapp"></i></a></li>
                </ul>
                <ul class="user-meta">
                    <li>Posts: <span>30</span></li>
                    <li>Pengikut: <span>12</span></li>
                    <li>Diikuti: <span>12</span></li>
                    <li>Views: <span>1.2k</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="block-box user-top-header">
    <ul class="menu-list">
        <li><a href="{{ route('social.userFeed', $anggota->id) }}">Feed</a></li>
        <li><a href="{{ route('social.userSertification', $anggota->id) }}">Sertifikat</a></li>
        <li><a href="{{ route('social.userFriend', $anggota->id) }}">Teman</a></li>
        <li><a href="{{ route('social.userAccount', $anggota->id) }}">Profile</a></li>
        {{-- <li>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="user-timeline.html#">Pengikut</a>
                    <a class="dropdown-item" href="user-timeline.html#">Mengikuti</a>
                </div>
            </div>
        </li> --}}
    </ul>
</div>

    @yield('content-user')
@endsection
