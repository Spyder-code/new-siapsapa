<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Lomba;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'agenda_id' => 'required',
            'nama_kegiatan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tempat' => 'nullable',
        ]);

        $kegiatan = Kegiatan::create($data);

        $lomba = $request->lomba;
        $lomba['kegiatan_id'] = $kegiatan->id;

        Lomba::create($lomba);
        return back()->with('success','Data berhasil dibuat');
    }

    public function updateRequest(Request $request)
    {
        Kegiatan::find($request->id)->update($request->all());
        return back()->with('success','Update berhasil');
    }
}
