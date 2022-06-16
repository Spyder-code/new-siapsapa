<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return response()->json([
            'message' => 'Agenda deleted successfully'
        ]);
    }

    public function addKegiatan()
    {
        $agenda_id = request('agenda_id');
        $jam = request('jam');
        $nama_kegiatan = request('nama_kegiatan');

        $data = Kegiatan::create([
            'agenda_id' => $agenda_id,
            'jam' => $jam,
            'nama_kegiatan' => $nama_kegiatan
        ]);

        return response()->json([
            'data' => $data,
            'message' => 'Kegiatan added successfully'
        ]);
    }

    public function deleteKegiatan()
    {
        $id = request('id');
        $data = Kegiatan::destroy($id);

        return response()->json([
            'data' => $data,
            'message' => 'Kegiatan deleted successfully'
        ]);
    }

    public function updateKegiatan()
    {
        $id = request('id');
        $data = Kegiatan::find($id);
        $data->update(request()->all());

        return response()->json([
            'data' => $data,
            'message' => 'Kegiatan updated successfully'
        ]);
    }
}
