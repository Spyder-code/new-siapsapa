<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Document;
use App\Models\Kegiatan;
use App\Models\PendaftaranAgenda;
use App\Models\PesertaLomba;
use App\Models\Pramuka;
use App\Models\Provinsi;
use App\Models\User;
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

        $anggota = User::whereHas('anggota')->whereIn('role',['kwarda','kwarcab','kwaran','gudep'])->inRandomOrder()->take(6)->get();
        return view('social.index', compact('data','anggota'));
    }

    public function profile()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
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

    public function statistik()
    {
        if (request('id_wilayah')) {
            $id_wilayah = request('id_wilayah');
        }else{
            $id_wilayah = 'all';
        }
        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Kwartir Nasional';
        $kwartir = $data[1];
        return view('user.statistik', compact('id_wilayah', 'title', 'kwartir'));
    }

    public function statistikDetail()
    {
        if (request('id_wilayah')) {
            $id_wilayah = request('id_wilayah');
        }else{
            $id_wilayah = 'all';
        }
        $role = request('role');
        $data = $this->getData($id_wilayah);
        $title = $data[0]->name ?? 'Kwartir Nasional';
        $kwartir = $data[1];
        return view('user.statistik_detail', compact('id_wilayah', 'title', 'kwartir','role'));
    }


    public function getData($id_wilayah)
    {
        if ($id_wilayah=='all') {
            return [null,null];
        }
        $len = strlen($id_wilayah);
        if ($len==2) {
            $data = Provinsi::find($id_wilayah, ['name', 'id', 'no_prov as code', 'id as prev']);
            $kwartir = 'Kwartir Daerah';
        }elseif($len==4){
            $data = City::find($id_wilayah, ['name', 'id', 'no_kab as code', 'province_id as prev']);
            $kwartir = 'Kwartir Cabang';
        }else{
            $data = Distrik::find($id_wilayah, ['name', 'id', 'no_kec as code', 'regency_id as prev']);
            $kwartir = 'Kwartir Ranting';
        }

        return [$data, $kwartir];
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
        if ($agenda->kepesertaan=='kelompok') {
            $anggota_id = PendaftaranAgenda::where('agenda_id', $agenda->id)->pluck('anggota_id');
            $anggota = Anggota::whereIn('id',$anggota_id)->get()->groupBy('gudep');
        }else{
            $anggota = PendaftaranAgenda::all()->where('agenda_id', $agenda->id);
        }
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

    public function sertifikatAgenda($code = null)
    {
        if($code==null){
            $data = PendaftaranAgenda::where('agenda_id',request('agenda'))->get();
        }else{
            $data = PendaftaranAgenda::where('nodaf',$code)->get();
            if(!$data){
                return abort(404);
            }
        }
        return view('admin.agenda.sertifikat.sertifikat_agenda', compact('data'));
    }

    public function sertifikatLomba($code = null)
    {
        if($code==null){
            $data = PesertaLomba::where('lomba_id',request('lomba'))->get();
        }else{
            $data = PesertaLomba::where('nodaf',$code)->get();
            if(!$data){
                return abort(404);
            }
        }
        return view('admin.agenda.sertifikat.sertifikat_lomba', compact('data'));
    }
}
