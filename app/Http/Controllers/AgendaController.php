<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AgendaFile;
use App\Models\Anggota;
use App\Models\Juri;
use App\Models\Kegiatan;
use App\Models\Lomba;
use App\Models\LombaStage;
use App\Models\PanitiaAgenda;
use App\Models\PendaftaranAgenda;
use App\Models\PesertaLomba;
use App\Models\PointJuri;
use App\Models\PointVote;
use App\Models\Provinsi;
use App\Models\Transaction;
use App\Repositories\WilayahService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index()
    {
        $data = Agenda::all();
        foreach ($data as $item ) {
            $time = strtotime($item->tanggal_selesai);
            $now = strtotime(date('Y-m-d'));
            if ($time > $now) {
                $item->is_finish = 0;
            } else {
                $item->is_finish = 1;
            }
            $item->save();
        }
        return view('admin.agenda.index', compact('data'));
    }

    public function create()
    {
        $provinsi = Provinsi::pluck('name', 'id');
        return view('admin.agenda.create', compact('provinsi'));
    }

    public function edit(Agenda $agenda)
    {
        $provinsi = Provinsi::pluck('name', 'id');
        return view('admin.agenda.edit', compact('provinsi','agenda'));
    }

    public function peserta(Agenda $agenda)
    {
        $daftarPeserta = [];
        $role = '';
        if ($agenda->tingkat=='provinsi') {
            $role = 'kwarda';
            $daftarPeserta = Anggota::whereHas('cetak', function($q){
                $q->whereHas('transactionDetail', function($a){
                    $a->where('transaction_details.payment_status','<',4);
                });
            })->where('status',1)->where('provinsi',Auth::user()->anggota->provinsi)->get();
        }
        if ($agenda->tingkat=='kabupaten') {
            $role = 'kwarcab';
            $daftarPeserta = Anggota::whereHas('cetak', function($q){
                $q->whereHas('transactionDetail', function($a){
                    $a->where('transaction_details.payment_status','<',4);
                });
            })->where('status',1)->where('kabupaten',Auth::user()->anggota->kabupaten)->get();
        }
        if ($agenda->tingkat=='kecamatan') {
            $role = 'kwaran';
            $daftarPeserta = Anggota::whereHas('cetak', function($q){
                $q->whereHas('transactionDetail', function($a){
                    $a->where('transaction_details.payment_status','<',4);
                });
            })->where('status',1)->where('kecamatan',Auth::user()->anggota->kecamatan)->get();
        }
        if ($agenda->tingkat=='gudep') {
            $role = 'gudep';
            $daftarPeserta = Anggota::whereHas('cetak', function($q){
                $q->whereHas('transactionDetail', function($a){
                    $a->where('transaction_details.payment_status','<',4);
                });
            })->where('status',1)->where('gudep',Auth::user()->anggota->gudep)->get();
        }
        if ($agenda->kepesertaan=='kelompok') {
            $anggota_id = PendaftaranAgenda::where('agenda_id', $agenda->id)->pluck('anggota_id');
            // $anggota = Anggota::whereIn('id',$anggota_id)->get();
            $tingkat = $agenda->tingkat;
            $anggota = PendaftaranAgenda::join('tb_anggota','tb_anggota.id','pendaftaran_agenda.anggota_id')
                        ->where('pendaftaran_agenda.agenda_id', $agenda->id)
                        ->select('pendaftaran_agenda.*','tb_anggota.provinsi','tb_anggota.kabupaten','tb_anggota.kecamatan','tb_anggota.gudep')
                        ->get()
                        ->groupBy($tingkat);
        }else{
            $anggota = PendaftaranAgenda::all()->where('agenda_id', $agenda->id);
        }
        return view('admin.agenda.peserta', compact('agenda','anggota','daftarPeserta','role'));
    }

    public function show(Agenda $agenda)
    {
        $lomba = Lomba::join('kegiatan','kegiatan.id','=','lomba.kegiatan_id')
                    ->join('agenda','agenda.id','=','kegiatan.agenda_id')
                    ->where('agenda.id',$agenda->id)
                    ->select('lomba.*')
                    ->get();

        $juara = array();
        $tingkat = $agenda->tingkat;
        $index = 0;
        foreach ($lomba as $lom) {
            if ($lom->penilaian=='vote') {
                $data = PointVote::select('lomba_file_id')
                        ->selectRaw('count(*) as total')
                        ->groupBy('lomba_file_id')
                        ->orderByRaw('total desc')
                        ->take(3)->get();
                foreach ($data as $idx => $nilai) {
                    if($tingkat=='gudep'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->gudepInfo->nama_sekolah;
                    }
                    if($tingkat=='kecamatan'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->district->name;
                    }
                    if($tingkat=='kabupaten'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->city->name;
                    }
                    if($tingkat=='provinsi'){
                        $juara[$index]['nama'] = $nilai->lomba_file->anggota->province->name;
                    }
                    $juara[$index]['point'] = 100 - ($idx * 40);
                    $index++;
                }
            }
            if ($lom->penilaian=='subjective') {
                $juriCount = Juri::where('lomba_id',$lom->id)->count();
                if ($lom->kepesertaan=='kelompok') {
                    $data = array();
                    $pen = PointJuri::all()->where('lomba_id',$lom->id)->groupBy('peserta_id');
                    foreach ($pen as $key => $item) {
                        if($lom->kegiatan->agenda->tingkat=='provinsi'){
                            $name = $item->first()->peserta->anggota->province->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kabupaten'){
                            $name = $item->first()->peserta->anggota->city->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kecamatan'){
                            $name = $item->first()->peserta->anggota->district->name;
                        }else{
                            $name = $item->first()->peserta->anggota->gudepInfo->nama_sekolah;
                        }
                        $data[$key]['nama'] = $name;
                        $data[$key]['point'] = $item->sum('point');
                    }
                    $data = collect($data);
                    $data = $data->sortByDesc('point');
                    foreach ($data as $idx => $nilai) {
                        if($idx<3){
                            $juara[$index]['nama'] = $nilai['nama'];
                            $juara[$index]['point'] = 100 - ($idx * 40);
                            $index++;
                        }
                    }
                }else{
                    $data = array();
                    $pen = PesertaLomba::all()->where('lomba_id',$lom->id);
                    foreach ($pen as $key => $item) {
                        if($lom->kegiatan->agenda->tingkat=='provinsi'){
                            $name = $item->anggota->province->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kabupaten'){
                            $name = $item->anggota->city->name;
                        }elseif($lom->kegiatan->agenda->tingkat=='kecamatan'){
                            $name = $item->anggota->district->name;
                        }else{
                            $name = $item->anggota->gudepInfo->nama_sekolah;
                        }
                        $data[$key]['nama'] = $name;
                        $data[$key]['point'] = (int)PointJuri::all()->where('lomba_id',$lom->id)->whereNull('gudep_id')->where('peserta_id',$item->id)->sum('point');
                    }
                    $data = collect($data);
                    $data = $data->sortByDesc('point');
                    foreach ($data as $idx => $nilai) {
                        if($idx<3){
                            $juara[$index]['nama'] = $nilai['nama'];
                            $juara[$index]['point'] = 100 - ($idx * 40);
                            $index++;
                        }
                    }
                }
            }
            if ($lom->penilaian=='objective') {
                if($lom->kepesertaan=='kelompok'){
                    $data = LombaStage::join('peserta_lomba','peserta_lomba.id','=','lomba_stages.peserta_id')
                            ->join('tb_anggota','tb_anggota.id','=','peserta_lomba.anggota_id')
                            ->where('lomba_stages.lomba_id',$lom->id)
                            ->select('lomba_stages.*','tb_anggota.provinsi','tb_anggota.kabupaten','tb_anggota.kecamatan','tb_anggota.gudep')
                            ->orderBy('stage','desc')
                            ->get()
                            ->groupBy($lom->kegiatan->agenda->tingkat);
                }else{
                    $data = LombaStage::where('lomba_id',$lom->id)->orderBy('stage','desc')->orderBy('point','desc')->get()->groupBy('peserta_id');
                }
                foreach ($data as $idx => $nilai) {
                    if($idx<3){
                        if($tingkat=='gudep'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->gudepInfo->nama_sekolah;
                        }
                        if($tingkat=='kecamatan'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->district->name;
                        }
                        if($tingkat=='kabupaten'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->city->name;
                        }
                        if($tingkat=='provinsi'){
                            $juara[$index]['nama'] = $nilai->first()->peserta->anggota->province->name;
                        }
                        $juara[$index]['point'] = 100 - ($idx * 40);
                        $index++;
                    }
                }
            }
        }

        $champion = array();
        foreach($juara as $jua){
            if(isset($champion[$jua['nama']]))
                $champion[$jua['nama']] += $jua['point'];
            else
                $champion[$jua['nama']] = $jua['point'];
        }


        $kegiatan = Kegiatan::where('agenda_id', $agenda->id)->orderBy('waktu_mulai', 'asc')->get()->groupBy('waktu_mulai');
        return view('admin.agenda.show', compact('agenda', 'kegiatan'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if($file = $request->file('foto')){
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/berkas/agenda'), $fileName);
            $data['foto'] = $fileName;
        }
        $anggota = Auth::user()->anggota;
        $data['jenis'] = 'non_lomba';
        $data['created_by'] = Auth::id();
        $data['provinsi_id'] = $anggota->provinsi;
        $data['kabupaten_id'] = $anggota->kabupaten;
        $data['kecamatan_id'] = $anggota->kecamatan;
        $agenda = Agenda::create($data);
        PanitiaAgenda::create([
            'agenda_id' => $agenda->id,
            'anggota_id' => $anggota->id
        ]);
        return redirect()->route('agenda.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, Agenda $agenda)
    {
        $data = $request->all();
        if($file = $request->file('foto')){
            $fileName = $agenda->foto;
            $file->move(public_path('/berkas/agenda'), $fileName);
            $data['foto'] = $fileName;
        }
        if($file = $request->file('sertifikat')){
            $fileName = 'sertifikat-'.$agenda->id.'.jpg';
            $file->move(public_path('/berkas/agenda'), $fileName);
            $data['sertifikat'] = $fileName;
            $agenda->update($data);
            return back()->with('success','Sertifikat disimpan');
        }
        $agenda->update($data);
        return redirect()->route('agenda.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Data berhasil dihapus');
    }

    public function daftarAgenda(Request $request)
    {
        $agenda_id = $request->agenda_id;
        $anggota_id = $request->anggota_id;
        foreach ($anggota_id as $key ) {
            $cek = PendaftaranAgenda::where('agenda_id', $agenda_id)->where('anggota_id',$key)->first();
            if($cek==null){
                $anggota = Anggota::find($key);
                if(strtolower($anggota->jk[0])=='p'){
                    $na = 'PI';
                }else{
                    $na = 'PA';
                }
                $pendaftar = PendaftaranAgenda::where('agenda_id', $agenda_id)->max('order');
                $order = $pendaftar + 1;
                $data = PendaftaranAgenda::create([
                    'nodaf' =>  $na.'.'.sprintf('%03d',$agenda_id).'.'.sprintf('%03d',$order),
                    'agenda_id' => $agenda_id,
                    'anggota_id' => $key,
                    'status' => 0,
                    'order' => $order,
                ]);
            }
        }
        return back()->with('success','pendaftaran Berhasil');
    }

    public function sertifikat(Agenda $agenda)
    {
        return view('admin.agenda.sertifikat.upload',compact('agenda'));
    }

    public function panitia(Agenda $agenda)
    {
        $panitia = PanitiaAgenda::all()->where('agenda_id',$agenda->id);
        return view('admin.agenda.panitia', compact('agenda','panitia'));
    }
}
