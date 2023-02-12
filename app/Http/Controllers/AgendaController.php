<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AgendaFile;
use App\Models\Anggota;
use App\Models\Juri;
use App\Models\Kegiatan;
use App\Models\PanitiaAgenda;
use App\Models\PendaftaranAgenda;
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
        if ($agenda->tingkat=='provinsi') {
            $daftarPeserta = Anggota::whereHas('cetak', function($q){
                $q->whereHas('transactionDetail', function($a){
                    $a->where('transaction_details.payment_status','<',4);
                });
            })->where('status',1)->where('provinsi',Auth::user()->anggota->provinsi)->get();
        }
        if ($agenda->tingkat=='kabupaten') {
            $daftarPeserta = Anggota::whereHas('cetak', function($q){
                $q->whereHas('transactionDetail', function($a){
                    $a->where('transaction_details.payment_status','<',4);
                });
            })->where('status',1)->where('kabupaten',Auth::user()->anggota->kabupaten)->get();
        }
        if ($agenda->tingkat=='kecamatan') {
            $daftarPeserta = Anggota::whereHas('cetak', function($q){
                $q->whereHas('transactionDetail', function($a){
                    $a->where('transaction_details.payment_status','<',4);
                });
            })->where('status',1)->where('kecamatan',Auth::user()->anggota->kecamatan)->get();
        }
        if ($agenda->tingkat=='gudep') {
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
                        ->select('pendaftaran_agenda.*')
                        ->get()
                        ->groupBy('tb_anggota.'.$tingkat);
        }else{
            $anggota = PendaftaranAgenda::all()->where('agenda_id', $agenda->id);
        }
        return view('admin.agenda.peserta', compact('agenda','anggota','daftarPeserta'));
    }

    public function show(Agenda $agenda)
    {
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
                $pendaftar = PendaftaranAgenda::where('agenda_id', $agenda_id)->max('order');
                $order = $pendaftar + 1;
                $data = PendaftaranAgenda::create([
                    'nodaf' => 'PA.'.sprintf('%03d',$agenda_id).'.'.sprintf('%03d',$order),
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
