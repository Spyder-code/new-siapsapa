<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Kegiatan;
use App\Models\PendaftaranAgenda;
use App\Models\Provinsi;
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
        $anggota = PendaftaranAgenda::all()->where('agenda_id', $agenda->id);
        return view('admin.agenda.peserta', compact('agenda','anggota'));
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
        $data['created_by'] = Auth::id();
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
}
