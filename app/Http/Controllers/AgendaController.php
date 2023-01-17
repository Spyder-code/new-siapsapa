<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AgendaFile;
use App\Models\Anggota;
use App\Models\Juri;
use App\Models\Kegiatan;
use App\Models\PendaftaranAgenda;
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
        $daftarPeserta = Transaction::join('transaction_details','transaction_details.id','=','transactions.transaction_detail_id')
        ->join('tb_anggota','tb_anggota.id','=','transactions.anggota_id')
        ->select('tb_anggota.*','transactions.transaction_detail_id','transactions.anggota_id')
        ->where('transaction_details.payment_status','<',4)
        ->where('tb_anggota.status',1)
        ->where('tb_anggota.gudep',Auth::user()->anggota->gudep)
        ->get();
        if ($agenda->kepesertaan=='kelompok') {
            $anggota_id = PendaftaranAgenda::where('agenda_id', $agenda->id)->pluck('anggota_id');
            $anggota = Anggota::whereIn('id',$anggota_id)->get()->groupBy('gudep');
        }else{
            $anggota = PendaftaranAgenda::all()->where('agenda_id', $agenda->id);
        }
        return view('admin.agenda.peserta', compact('agenda','anggota','daftarPeserta'));
    }

    public function show(Agenda $agenda)
    {
        $kegiatan = Kegiatan::where('agenda_id', $agenda->id)->orderBy('jam', 'asc')->get();
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
        $data['created_by'] = Auth::id();
        $data['provinsi_id'] = $anggota->provinsi;
        $data['kabupaten_id'] = $anggota->kabupaten;
        $data['kecamatan_id'] = $anggota->kecamatan;
        Agenda::create($data);
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
        $agenda->update($data);
        return redirect()->route('agenda.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Data berhasil dihapus');
    }

    public function daftarLomba(Request $request)
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

    public function file(Agenda $agenda)
    {
        $anggota = Auth::user()->anggota;
        $gudep = $anggota->gudep;
        $cek = PendaftaranAgenda::where('agenda_id',$agenda->id)->whereHas('anggota', function($q) use($gudep){
            $q->where('gudep',$gudep);
        })->first();
        if (is_null($cek)) {
            return back()->with('danger','Anda harus daftar agenda terlebih dahulu');
        }
        $file = AgendaFile::where('gudep_id',$anggota->gudep)->first();
        return view('admin.agenda.file', compact('agenda','file'));
    }

    public function fileStore(Request $request)
    {
        $request->validate([
            'file' => 'max:20000'
        ]);
        $data = array();
        $data['size'] = $request->file->getSize();
        if($file = $request->file('file')){
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/berkas/lomba/'.$request->agenda_id.'/'), $fileName);
            $data['agenda_id'] = $request->agenda_id;
            $data['anggota_id'] = Auth::user()->anggota->id;
            $data['gudep_id'] = Auth::user()->anggota->gudep;
            $data['file_name'] = $fileName;
            $data['file_path'] = 'berkas/lomba/'.$request->agenda_id.'/'.$fileName;
            $data['mime'] = $file->getClientMimeType();
            $cek = AgendaFile::where('gudep_id',$data['gudep_id'])->first();
            if ($cek) {
                $cek->update($data);
            }else{
                AgendaFile::create($data);
            }
        }

        return response($file);
    }

    public function fileDestroy(Request $request)
    {
        AgendaFile::where('agenda_id',$request->agenda_id)->where('file_name',$request->file)->delete();
        return response('success');
    }

    public function juri(Agenda $agenda)
    {
        $juri = Juri::all()->where('agenda_id',$agenda->id);
        return view('admin.agenda.juri', compact('agenda','juri'));
    }

    public function juriAdd(Request $request)
    {
        $juri = Juri::create([
            'agenda_id' => $request->agenda_id,
            'anggota_id' => $request->anggota_id,
        ]);

        return response($juri);
    }

    public function juriDestroy(Juri $juri)
    {
        $juri->delete();
        return back()->with('success','data berhasil dihapus!');
    }

    public function nilai(Agenda $agenda)
    {
        $files = AgendaFile::where('agenda_id',$agenda->id)->get();
        return view('admin.agenda.nilai',compact('agenda','files'));
    }
}
