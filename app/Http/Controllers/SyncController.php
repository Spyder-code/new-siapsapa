<?php

namespace App\Http\Controllers;

use App\Jobs\SyncAnggotaKta;
use App\Models\Anggota;
use App\Models\Document;
use App\Models\Kta;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function document()
    {
        $data = Document::all();
        foreach ($data as $item ) {
            $item->pramuka = $item->documentType->pramuka_id;
            $item->save();
        }

    }

    public function anggotaKta()
    {
        // chunk anggota
        $data = Anggota::all(['id', 'kabupaten','kta_id'])->whereNull('kta_id');
        foreach ($data->chunk(1000) as $anggota) {
            // foreach ($anggota as $item) {
            //     $kta = Kta::where('kabupaten',$item->kabupaten)->first();
            //     if($kta){
            //         $item->update(['kta_id'=>$kta->id]);
            //     }
            // }
            dispatch(new SyncAnggotaKta($anggota));
        }

        return response()->json([
            'message' => 'Berhasil mengupdate data'
        ], 200);
    }
}
