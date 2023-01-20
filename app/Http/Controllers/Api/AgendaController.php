<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\PesertaAgendaResource;
use App\Models\Agenda;
use App\Models\AgendaFile;
use App\Models\Anggota;
use App\Models\Juri;
use App\Models\Kegiatan;
use App\Models\PendaftaranAgenda;
use App\Models\PointJuri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getAgenda()
    {
        if(request('status')){
            $agenda = Agenda::all()->where('is_finish', request('status'));
        }else{
            $agenda = Agenda::all();
        }
        if (!$agenda || $agenda->isEmpty()) {
            return response()->json([
                'message' => 'Agenda not found'
            ], 404);
        }
        return AgendaResource::collection($agenda);
    }

    public function addPeserta()
    {
        $agenda_id = request('agenda_id');
        $nik = request('nik');
        $anggota = Anggota::where('nik',$nik)->orWhere('email',$nik)->first();
        if($anggota == null){
            return response()->json([
                'status' => 0,
                'message' => 'Anggota Tidak ditemukan!'
            ]);
        }else{
            $anggota_id = $anggota->id;
            $cek = PendaftaranAgenda::where('agenda_id', $agenda_id)->where('anggota_id',$anggota_id)->first();
            if($cek==null){
                $pendaftar = PendaftaranAgenda::where('agenda_id', $agenda_id)->max('order');
                $order = $pendaftar + 1;
                try {
                    $data = PendaftaranAgenda::create([
                        'nodaf' => 'PA.'.sprintf('%03d',$agenda_id).'.'.sprintf('%03d',$order),
                        'agenda_id' => $agenda_id,
                        'anggota_id' => $anggota_id,
                        'status' => 0,
                        'order' => $order,
                    ]);
                    return response()->json([
                        'status' => 1,
                        'data' => $data,
                        'message' => 'Peserta berhasil didaftarkan!'
                    ]);
                } catch (\Throwable $th) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Server Bermasalah',
                        'error' => $th
                    ], 404);
                }
            }else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Anggota sudah terdaftar!'
                ]);
            }
        }

    }

    public function getPesertaAgenda(Agenda $agenda)
    {
        $peserta = PendaftaranAgenda::where('agenda_id', $agenda->id)->get();
        if (!$peserta || $peserta->isEmpty()) {
            return response()->json([
                'message' => 'Peserta not found'
            ], 404);
        }
        return PesertaAgendaResource::collection($peserta);
    }

    public function deletePeserta()
    {
        $id = request('id');
        $data = PendaftaranAgenda::where('id',$id)->orWhere('nodaf',$id)->delete();

        return response()->json([
            'data' => $data,
            'message' => 'Pendaftar deleted successfully'
        ]);
    }

    public function daftarUlang()
    {
        $nik = request('nik');
        $agenda_id = request('agenda_id');
        $anggota = Anggota::where('nik',$nik)->first();
        if(!$anggota){
            return response()->json([
                'status' => 0,
                'message' => 'QR Tidak ditemukan!'
            ]);
        }

        $pendaftar = PendaftaranAgenda::where('agenda_id', $agenda_id)->where('anggota_id',$anggota->id)->first();

        if (!$pendaftar) {
            return response()->json([
                'status' => 0,
                'message' => 'Pendaftaran Tidak ditemukan!. Anda tidak terdaftar dari agenda ini!'
            ], 404);
        }

        $pendaftar->update([
            'status' => 1
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Daftar ulang berhasil!'
        ]);
    }

    public function cancel()
    {
        $nik = request('nik');
        $agenda_id = request('agenda_id');
        $anggota = Anggota::where('nik',$nik)->first();
        if(!$anggota){
            return response()->json([
                'status' => 0,
                'message' => 'QR Tidak ditemukan!'
            ]);
        }

        $pendaftar = PendaftaranAgenda::where('agenda_id', $agenda_id)->where('anggota_id',$anggota->id)->first();

        if (!$pendaftar) {
            return response()->json([
                'status' => 0,
                'message' => 'Pendaftaran Tidak ditemukan!. Anda tidak terdaftar dari agenda ini!'
            ], 404);
        }

        $pendaftar->update([
            'status' => 0
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Batalkan daftar ulang berhasil!'
        ]);
    }

    public function addPointJuri(Request $request)
    {
        $juri = Juri::find($request->juri_id);
        $data = $request->all();
        $data['agenda_id'] =  $juri->agenda_id;
        $data['juri_id'] =  $juri->id;
        if($juri->agenda->kepesertaan=='kelompok'){
            $res = PointJuri::upsert([$data],['id'],['point','description']);
        }else{
            $res = PointJuri::upsert([$data],['juri_id','peserta_id','agenda_id'],['point','description']);
        }

        return response($res);
    }
}
