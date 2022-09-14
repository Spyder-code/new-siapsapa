<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    public function userFeed($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        return view('social.user.feed', compact('user','anggota'));
    }

    public function userAccount($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        return view('social.user.account', compact('user','anggota'));
    }

    public function userFriend($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        return view('social.user.friend', compact('user','anggota'));
    }

    public function userSertification($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        return view('social.user.sertification', compact('user','anggota'));
    }

    public function news()
    {
        return view('social.blog');
    }

    public function event()
    {
        return view('social.event');
    }

    public function photo()
    {
        return view('social.photo');
    }

    public function video()
    {
        return view('social.video');
    }

}
