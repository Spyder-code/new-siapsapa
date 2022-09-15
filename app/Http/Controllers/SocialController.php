<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use App\Models\Pramuka;
use App\Models\Provinsi;
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

    public function userGallery($anggota_id)
    {
        $anggota = Anggota::find($anggota_id);
        $user = $anggota->user;
        return view('social.user.gallery', compact('user','anggota'));
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
        $pramuka = Pramuka::where('id','!=',5)->select('name','id')->get();
        $data = Document::all()->where('user_id', Auth::id())->groupBy('pramuka');
        return view('social.user.sertification', compact('user','anggota','pramuka','data'));
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

    public function shop()
    {
        return view('social.shop');
    }

    public function announcement()
    {
        return view('social.announcement');
    }

    public function profile()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        $provinsi = Provinsi::pluck('name','id');
        return view('social.profile', compact('anggota','user','provinsi'));
    }

}
