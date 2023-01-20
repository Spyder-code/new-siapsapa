<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Juri;
use App\Models\Lomba;
use App\Models\LombaFile;
use App\Models\PendaftaranAgenda;
use App\Models\PesertaLomba;
use App\Models\PointJuri;
use App\Models\PointVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LombaController extends Controller
{
    public function daftar(Lomba $lomba)
    {
        $gudep = Auth::user()->anggota->gudep;
        if ($lomba->kepesertaan=='kelompok') {
            $peserta = PesertaLomba::where('lomba_id',$lomba->id)->get()->groupBy('gudep_id');
        }else{
            $peserta = PesertaLomba::where('lomba_id',$lomba->id)->get();
        }

        if ($lomba->kategori=='campuran') {
            $daftarPeserta = PendaftaranAgenda::where('agenda_id',$lomba->kegiatan->agenda_id)->whereHas('anggota', function($q) use($gudep){
                $q->where('gudep',$gudep);
            })->get();
        }
        if ($lomba->kategori=='putri') {
            $daftarPeserta = PendaftaranAgenda::where('agenda_id',$lomba->kegiatan->agenda_id)->whereHas('anggota', function($q) use($gudep){
                $q->where('jk','P');
                $q->where('gudep',$gudep);
            })->get();
        }
        if ($lomba->kategori=='putra') {
            $daftarPeserta = PendaftaranAgenda::where('agenda_id',$lomba->kegiatan->agenda_id)->whereHas('anggota', function($q) use($gudep){
                $q->where('jk','L');
                $q->where('gudep',$gudep);
            })->get();
        }
        return view('admin.agenda.daftar_lomba', compact('lomba','peserta','daftarPeserta'));
    }

    public function storeDaftar(Lomba $lomba, Request $request)
    {
        $lomba_id = $lomba->id;
        $anggota_id = $request->anggota_id;
        foreach ($anggota_id as $key ) {
            $cek = PesertaLomba::where('lomba_id', $lomba_id)->where('anggota_id',$key)->first();
            if($cek==null){
                $pendaftar = PesertaLomba::where('lomba_id', $lomba_id)->max('order');
                $order = $pendaftar + 1;
                $data = PesertaLomba::create([
                    'nodaf' => 'KL.'.sprintf('%03d',$lomba_id).'.'.sprintf('%03d',$order),
                    'lomba_id' => $lomba_id,
                    'anggota_id' => $key,
                    'gudep_id' => Auth::user()->anggota->gudep,
                    'status' => 0,
                    'order' => $order,
                ]);
            }
        }
        return back()->with('success','pendaftaran Berhasil');
    }

    public function destroyPeserta(PesertaLomba $peserta)
    {
        $peserta->delete();
        return back()->with('success','Data berhasil ditarik');
    }

    public function file(Lomba $lomba)
    {
        $anggota = Auth::user()->anggota;
        $gudep = $anggota->gudep;
        if ($lomba->kepesertaan=='kelompok') {
            $cek = PesertaLomba::where('lomba_id',$lomba->id)->whereHas('anggota', function($q) use($gudep){
                $q->where('gudep',$gudep);
            })->first();
        }else{
            $cek = PesertaLomba::where('agenda_id',$lomba->id)->where('anggota',$anggota->id)->first();
        }
        if (is_null($cek)) {
            return back()->with('danger','Anda harus daftar agenda terlebih dahulu');
        }
        $file = LombaFile::where('gudep_id',$anggota->gudep)->first();
        return view('admin.agenda.file', compact('lomba','file'));
    }

    public function fileStore(Request $request)
    {
        $request->validate([
            'file' => 'max:20000'
        ]);
        $data = array();
        $data['size'] = $request->file->getSize();
        $lomba = Lomba::find($request->lomba_id);
        $anggota = Anggota::where('user_id',$request->user_id)->first();
        $anggota_id = $anggota->id;
        if ($lomba->kepesertaan=='kelompok') {
            $data['gudep_id'] = $anggota->gudep;
        }else{
            $peserta = PesertaLomba::where('lomba_id',$request->lomba_id)->where('anggota', $anggota_id)->first();
            if (!$peserta) {
                return response('Maaf anda tidak terdaftar!');
            }
            $data['peserta_id'] = $peserta->id;
        }
        if($file = $request->file('file')){
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/berkas/lomba/'.$request->lomba_id.'/'), $fileName);
            $data['lomba_id'] = $request->lomba_id;
            $data['anggota_id'] = $anggota_id;
            $data['file_name'] = $fileName;
            $data['file_path'] = 'berkas/lomba/'.$request->lomba_id.'/'.$fileName;
            $data['mime'] = $file->getClientMimeType();
            $cek = LombaFile::where('gudep_id',$data['gudep_id'])->first();
            if ($cek) {
                $cek->update($data);
            }else{
                LombaFile::create($data);
            }
        }

        return response($file);
    }

    public function fileDestroy(Request $request)
    {
        LombaFile::where('lomba_id',$request->lomba_id)->where('file_name',$request->file)->delete();
        return response('success');
    }

    public function openFile(LombaFile $file)
    {
        return view('admin.agenda.open_file', compact('file'));
    }

    public function juri(Lomba $lomba)
    {
        $juri = Juri::all()->where('lomba_id',$lomba->id);
        return view('admin.agenda.juri', compact('lomba','juri'));
    }

    public function juriAdd(Request $request)
    {
        $juri = Juri::create([
            'lomba_id' => $request->lomba_id,
            'anggota_id' => $request->anggota_id,
        ]);

        return response($juri);
    }

    public function juriDestroy(Juri $juri)
    {
        $juri->delete();
        return back()->with('success','data berhasil dihapus!');
    }

    public function nilai(Lomba $lomba)
    {
        $anggota_id = Auth::user()->anggota->id;
        $lomba_id = $lomba->id;
        $next = Anggota::whereHas('cetak', function($q){
            $q->whereHas('transactionDetail', function($a){
                $a->where('transaction_details.payment_status','<',4);
            });
        })->where('user_id',Auth::id())->first();
        $cekJuri = Juri::where('lomba_id',$lomba_id)->where('anggota_id',$anggota_id)->first();
        if (!$next) {
            return back()->with('danger','Anda tidak bisa memberikan penilaian dikarenakan belum memiliki Kartu Tanda Anggota (KTA)');
        }
        if (!$cekJuri && $lomba->penilaian=='subjective') {
            return back()->with('danger','Anda tidak punya akses sebagai Juri');
        }

        if ($lomba->penilaian=='vote') {
            $files = LombaFile::where('lomba_id',$lomba->id)->get();
            $cek = PointVote::where('anggota_id',$anggota_id)->whereHas('lomba_file', function($q) use($lomba_id){
                $q->where('lomba_id', $lomba_id);
            })->first();
            return view('admin.agenda.nilai',compact('lomba','files','cek'));
        }
        if ($lomba->penilaian=='subjective') {
            if ($lomba->kepesertaan=='kelompok') {
                $files = PesertaLomba::all()->where('lomba_id',$lomba_id)->groupBy('gudep_id');
            } else {
                $files = PesertaLomba::all()->where('lomba_id',$lomba_id);
            }
            $juri_id = Juri::where('lomba_id',$lomba_id)->where('anggota_id',$anggota_id)->first()->id;
            return view('admin.agenda.nilai',compact('lomba','files','juri_id'));
        }


    }

    public function addVote(Lomba $lomba, Request $request)
    {
        $anggota_id = Auth::user()->anggota->id;
        $lomba_id = $lomba->id;
        $cek = PointVote::where('anggota_id',$anggota_id)->whereHas('lomba_file', function($q) use($lomba_id){
            $q->where('lomba_id', $lomba_id);
        })->first();
        if (!$cek) {
            PointVote::create([
                'anggota_id' => $anggota_id,
                'lomba_file_id' => $request->lomba_file_id
            ]);
            return back()->with('success','Vote anda berhasil ditambahkan');
        }
        return back('danger','Anda sudah melakukan vote');
    }

    public function destroyVote(PointVote $vote)
    {
        $vote->delete();
        return back()->with('success','Vote berhasil ditarik');
    }

    public function addPointJuri(Request $request)
    {
        $juri = Juri::find($request->juri_id);
        $data = $request->all();
        $data['lomba_id'] =  $juri->lomba_id;
        $data['juri_id'] =  $juri->id;
        if($juri->lomba->kepesertaan=='kelompok'){
            $res = PointJuri::upsert([$data],['id'],['point','description']);
        }else{
            $res = PointJuri::upsert([$data],['juri_id','peserta_id','lomba_id'],['point','description']);
        }

        return response($res);
    }

    public function hasil(Lomba $lomba)
    {
        if ($lomba->penilaian=='vote') {
            $data = PointVote::select('lomba_file_id')
                    ->selectRaw('count(*) as total')
                    ->groupBy('lomba_file_id')
                    ->orderByRaw('total desc')
                    ->get();
        }
        if ($lomba->penilaian=='subjective') {
            $juriCount = Juri::where('lomba_id',$lomba->id)->count();
            if ($lomba->kepesertaan=='kelompok') {
                $data = array();
                $pen = PesertaLomba::all()->where('lomba_id',$lomba->id)->keyBy('gudep_id')->groupBy('gudep_id');
                $i=0;
                foreach ($pen as $key => $item) {
                    $data[$i]['nama'] = $item->first()->gudep->nama_sekolah;
                    $data[$i]['point'] = (int)PointJuri::all()->where('lomba_id',$lomba->id)->whereNull('peserta_id')->where('gudep_id',$key)->sum('point')/$juriCount;
                    $i++;
                }
                $data = collect($data);
                $data = $data->sortByDesc('point');
            }else{
                $data = array();
                $pen = PesertaLomba::all()->where('lomba_id',$lomba->id);
                foreach ($pen as $key => $item) {
                    $data[$key]['nama'] = $item->anggota->nama;
                    $data[$key]['point'] = (int)PointJuri::all()->where('lomba_id',$lomba->id)->whereNull('gudep_id')->where('peserta_id',$item->id)->sum('point')/$juriCount;
                }
                $data = collect($data);
                $data = $data->sortByDesc('point');
            }
        }
        return view('admin.agenda.lomba_hasil',compact('lomba','data'));
    }
}
