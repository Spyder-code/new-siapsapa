<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Document;
use App\Models\Kegiatan;
use App\Models\PendaftaranAgenda;
use App\Models\Pramuka;
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
        foreach ($agenda as $item ) {
            $time = strtotime($item->tanggal_selesai);
            $now = strtotime(date('Y-m-d'));
            if ($time > $now) {
                $item->is_finish = 0;
            } else {
                $item->is_finish = 1;
            }
            $item->save();
        }
        return view('user.agenda.index', compact('agenda'));
    }

    public function show_agenda(Agenda $agenda)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $kegiatan = Kegiatan::where('agenda_id', $agenda->id)->orderBy('jam', 'asc')->get();
        return view('user.agenda.show',compact('agenda','kegiatan'));
    }

    public function my_agenda()
    {
        $anggota = Auth::user()->anggota;
        $agenda = PendaftaranAgenda::where('anggota_id', $anggota->id)->get();
        return view('user.agenda.my', compact('agenda'));
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

    public function document()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $cek = Auth::user()->anggota;
        if($cek->pramuka==3 || $cek->pramuka==4){
            $pramuka = Pramuka::where('id','!=',5)->pluck('name','id');
        }else{
            $pramuka = Pramuka::where('id','!=',5)->where('id','!=','8')->pluck('name','id');
        }
        $data = Document::all()->where('user_id', Auth::id())->groupBy('pramuka');
        return view('user.document.index', compact('data','pramuka'));
    }
}
