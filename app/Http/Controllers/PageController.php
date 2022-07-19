<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\PendaftaranAgenda;
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

    public function agenda()
    {
        $agenda = Agenda::all();
        return view('user.agenda.index', compact('agenda'));
    }

    public function show_agenda(Agenda $agenda)
    {
        $kegiatan = Kegiatan::where('agenda_id', $agenda->id)->orderBy('jam', 'asc')->get();
        return view('user.agenda.show',compact('agenda','kegiatan'));
    }

    public function peserta_agenda(Agenda $agenda)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $anggota = PendaftaranAgenda::all()->where('agenda_id', $agenda->id);
        $cek = PendaftaranAgenda::where('agenda_id', $agenda->id)->where('anggota_id',Auth::user()->anggota->id)->first();
        return view('user.agenda.peserta', compact('agenda','anggota','cek'));
    }

    public function change_password()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        return view('user.change_password', compact('user','anggota'));
    }
}
