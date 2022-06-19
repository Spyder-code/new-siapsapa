<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Repositories\StatistikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function home()
    {
        Cache::forget('statistik');
        $data = Cache::remember('statistik', 60*60*24, function () {
            $statistik = new StatistikService('all');
            $count = $statistik->getNumberOfPramuka();
            return $count;
        });
        return view('user.home', compact('data'));
    }

    public function profile()
    {
        $anggota = Auth::user()->anggota;
        $provinsi = Provinsi::pluck('name','id');
        return view('user.profile', compact('anggota','provinsi'));
    }

    public function change_password()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        return view('user.change_password', compact('user','anggota'));
    }
}
