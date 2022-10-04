@extends('layouts.social')
@section('content')
@php
$follower = App\Models\Follower::where('following', '=', $user->id)->orderByDesc('id')->get();
$following = App\Models\Follower::where('user_id', '=', $user->id)->orderByDesc('id')->get();
@endphp

<div class="banner-user">
    <div class="banner-content">
        <div class="media">
            <div class="item-img">
                <img src="{{ asset('berkas/anggota/02.jpg') }}" alt="User" style="width: 90px; height:90px">
            </div>
            <div class="media-body">
                <h3 class="item-title">{{ $anggota->nama }}</h3>
                <div class="item-subtitle">{{ ucfirst($user->role) }} Kwartir Ranting {{
                    ucwords(strtolower($anggota->district->name))}}</div>
                <ul class="item-social">
                    <li><a href="user-timeline.html#" class="bg-fb"><i class="icofont-facebook"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-twitter"><i class="icofont-twitter"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-dribble"><i class="icofont-instagram"></i></a></li>
                    <li><a href="user-timeline.html#" class="bg-success"><i class="icofont-whatsapp"></i></a></li>
                </ul>
                <ul class="user-meta">
                    <li>Posts: <span>{{ $user->posts->count() }}</span></li>
                    <li>Pengikut: <span>{{ $follower->count() }}</span></li>
                    <li>Diikuti: <span>{{ $following->count() }}</span></li>
                    {{-- <li>Views: <span>1.2k</span></li> --}}

                    @if (Auth::id() != $user->id && isset($follower))

                    @if (!$follower->isEmpty())
                    @foreach ($follower as $item)
                    @if ($item->user_id == Auth::id() )
                    <form class="mt-2" action="{{ route('follow.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ $user->id }}" required>
                        <li><input type="submit" class="btn btn-danger" value="Unfollow"></li>
                    </form>
                    @break
                    @else
                    <form class="mt-2" action="{{ route('follow.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ $user->id }}" required>
                        <li><input type="submit" class="btn btn-primary" value="Follow"></li>
                    </form>
                    @break
                    @endif
                    @endforeach
                    @else
                    <form class="mt-2" action="{{ route('follow.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ $user->id }}" required>
                        <li><input type="submit" class="btn btn-primary" value="Follow"></li>
                    </form>
                    @endif

                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="block-box user-top-header">
    <ul class="menu-list">
        <li class="{{ request()->is('anggota/*/feed') ? 'active' : '' }}"><a
                href="{{ route('social.userFeed', $anggota->id) }}">Feed</a></li>
        <li class="{{ request()->is('anggota/*/sertifikat') ? 'active' : '' }}"><a
                href="{{ route('social.userSertification', $anggota->id) }}">Sertifikat</a></li>
        <li class="{{ request()->is('anggota/*/teman') ? 'active' : '' }}"><a
                href="{{ route('social.userFriend', $anggota->id) }}">Teman</a></li>
        <li class="{{ request()->is('anggota/*/galeri') ? 'active' : '' }}"><a
                href="{{ route('social.userGallery', $anggota->id) }}">Galeri</a></li>
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

@yield('script')
@endsection
