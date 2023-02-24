<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Juri;
use App\Models\Lomba;
use App\Models\LombaFile;
use App\Models\LombaStage;
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
        if ($lomba->kepesertaan=='kelompok') {
            $peserta = PesertaLomba::join('tb_anggota','tb_anggota.id','peserta_lomba.anggota_id')
                        ->where('peserta_lomba.lomba_id', $lomba->id)
                        ->select('peserta_lomba.*','tb_anggota.provinsi','tb_anggota.kabupaten','tb_anggota.kecamatan','tb_anggota.gudep')
                        ->get()
                        ->groupBy($lomba->kegiatan->agenda->tingkat);
        }else{
            $peserta = PesertaLomba::where('lomba_id',$lomba->id)->get();
        }

        $role = '';

        if ($lomba->kategori=='campuran') {
            $daftarPeserta = PendaftaranAgenda::where('agenda_id',$lomba->kegiatan->agenda_id)->whereHas('anggota', function($q) use($lomba){
                if($lomba->kegiatan->agenda->tingkat=='provinsi'){
                    $role = 'kwarda';
                    $q->where('provinsi',Auth::user()->anggota->provinsi);
                }
                if($lomba->kegiatan->agenda->tingkat=='kabupaten'){
                    $role = 'kwarcab';
                    $q->where('kabupaten',Auth::user()->anggota->kabupaten);
                }
                if($lomba->kegiatan->agenda->tingkat=='kecamatan'){
                    $role = 'kwaran';
                    $q->where('kecamatan',Auth::user()->anggota->kecamatan);
                }
                if($lomba->kegiatan->agenda->tingkat=='gudep'){
                    $role = 'gudep';
                    $q->where('gudep',Auth::user()->anggota->gudep);
                }
            })->get();
        }
        if ($lomba->kategori=='putri') {
            $daftarPeserta = PendaftaranAgenda::where('agenda_id',$lomba->kegiatan->agenda_id)->whereHas('anggota', function($q) use($lomba){
                if($lomba->kegiatan->agenda->tingkat=='provinsi'){
                    $role = 'kwarda';
                    $q->where('provinsi',Auth::user()->anggota->provinsi);
                }
                if($lomba->kegiatan->agenda->tingkat=='kabupaten'){
                    $role = 'kwarcab';
                    $q->where('kabupaten',Auth::user()->anggota->kabupaten);
                }
                if($lomba->kegiatan->agenda->tingkat=='kecamatan'){
                    $role = 'kwaran';
                    $q->where('kecamatan',Auth::user()->anggota->kecamatan);
                }
                if($lomba->kegiatan->agenda->tingkat=='gudep'){
                    $role = 'gudep';
                    $q->where('gudep',Auth::user()->anggota->gudep);
                }
                $q->where('jk','P');
            })->get();
        }
        if ($lomba->kategori=='putra') {
            $daftarPeserta = PendaftaranAgenda::where('agenda_id',$lomba->kegiatan->agenda_id)->whereHas('anggota', function($q) use( $lomba){
                if($lomba->kegiatan->agenda->tingkat=='provinsi'){
                    $role = 'kwarda';
                    $q->where('provinsi',Auth::user()->anggota->provinsi);
                }
                if($lomba->kegiatan->agenda->tingkat=='kabupaten'){
                    $role = 'kwarcab';
                    $q->where('kabupaten',Auth::user()->anggota->kabupaten);
                }
                if($lomba->kegiatan->agenda->tingkat=='kecamatan'){
                    $role = 'kwaran';
                    $q->where('kecamatan',Auth::user()->anggota->kecamatan);
                }
                if($lomba->kegiatan->agenda->tingkat=='gudep'){
                    $role = 'gudep';
                    $q->where('gudep',Auth::user()->anggota->gudep);
                }
                $q->where('jk','L');
            })->get();
        }
        return view('admin.agenda.daftar_lomba', compact('lomba','peserta','daftarPeserta','role'));
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
                $anggota = Anggota::find($key);
                if(strtolower($anggota->jk[0])=='p'){
                    $na = 'LA';
                }else{
                    $na = 'LI';
                }
                $data = PesertaLomba::create([
                    'nodaf' => $na.'.'.sprintf('%03d',$lomba_id).'.'.sprintf('%03d',$order),
                    'lomba_id' => $lomba_id,
                    'anggota_id' => $key,
                    'gudep_id' => Auth::user()->anggota->gudep,
                    'status' => 0,
                    'order' => $order,
                ]);
                if($lomba->penilaian=='objective'){
                    LombaStage::create([
                        'lomba_id' => $lomba->id,
                        'peserta_id' => $data->id,
                        'gudep_id' =>  Auth::user()->anggota->gudep,
                    ]);
                }
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
            $cek = PesertaLomba::where('lomba_id',$lomba->id)->whereHas('anggota', function($q) use($lomba){
                if($lomba->kegiatan->agenda->tingkat=='provinsi'){
                    $q->where('provinsi',Auth::user()->anggota->provinsi);
                }
                if($lomba->kegiatan->agenda->tingkat=='kabupaten'){
                    $q->where('kabupaten',Auth::user()->anggota->kabupaten);
                }
                if($lomba->kegiatan->agenda->tingkat=='kecamatan'){
                    $q->where('kecamatan',Auth::user()->anggota->kecamatan);
                }
                if($lomba->kegiatan->agenda->tingkat=='gudep'){
                    $q->where('gudep',Auth::user()->anggota->gudep);
                }
            })->first();
        }else{
            $cek = PesertaLomba::where('agenda_id',$lomba->id)->where('anggota',$anggota->id)->first();
        }
        if (is_null($cek)) {
            return back()->with('danger','Anda harus daftar lomba terlebih dahulu');
        }
        $file = LombaFile::where('lomba_id',$lomba->id)->whereHas('anggota', function($q) use($lomba){
            if($lomba->kegiatan->agenda->tingkat=='provinsi'){
                $q->where('provinsi',Auth::user()->anggota->provinsi);
            }
            if($lomba->kegiatan->agenda->tingkat=='kabupaten'){
                $q->where('kabupaten',Auth::user()->anggota->kabupaten);
            }
            if($lomba->kegiatan->agenda->tingkat=='kecamatan'){
                $q->where('kecamatan',Auth::user()->anggota->kecamatan);
            }
            if($lomba->kegiatan->agenda->tingkat=='gudep'){
                $q->where('gudep',Auth::user()->anggota->gudep);
            }
        })->first();
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
        $peserta = PesertaLomba::where('lomba_id',$request->lomba_id)->where('anggota_id', $anggota->id)->first();
        if (!$peserta) {
            return response('Maaf anda tidak terdaftar!');
        }
        $data['peserta_id'] = $peserta->id;
        if($file = $request->file('file')){
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/berkas/lomba/'.$request->lomba_id.'/'), $fileName);
            $data['lomba_id'] = $request->lomba_id;
            $data['anggota_id'] = $anggota->id;
            $data['file_name'] = $fileName;
            $data['file_path'] = 'berkas/lomba/'.$request->lomba_id.'/'.$fileName;
            $data['mime'] = $file->getClientMimeType();
            $cek = LombaFile::where('lomba_id',$lomba->id)->whereHas('anggota', function($q) use($lomba,$anggota){
                        if($lomba->kegiatan->agenda->tingkat=='provinsi'){
                            $q->where('provinsi',$anggota->provinsi);
                        }
                        if($lomba->kegiatan->agenda->tingkat=='kabupaten'){
                            $q->where('kabupaten',$anggota->kabupaten);
                        }
                        if($lomba->kegiatan->agenda->tingkat=='kecamatan'){
                            $q->where('kecamatan',$anggota->kecamatan);
                        }
                        if($lomba->kegiatan->agenda->tingkat=='gudep'){
                            $q->where('gudep',$anggota->gudep);
                        }
                    })->first();
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

    public function stage(Lomba $lomba)
    {
        $peserta = LombaStage::where('lomba_id',$lomba->id)->get();
        if ($lomba->kepesertaan=='kelompok') {
            $lives = LombaStage::join('peserta_lomba','peserta_lomba.id','=','lomba_stages.peserta_id')
                        ->join('tb_anggota','tb_anggota.id','=','peserta_lomba.anggota_id')
                        ->where('lomba_stages.lomba_id',$lomba->id)
                        ->where('lomba_stages.stage',$peserta->max('stage'))
                        ->select('lomba_stages.*','tb_anggota.provinsi','tb_anggota.kabupaten','tb_anggota.kecamatan','tb_anggota.gudep')
                        ->get()
                        ->groupBy($lomba->kegiatan->agenda->tingkat);
        }else{
            $lives = LombaStage::where('lomba_id',$lomba->id)->where('stage',$peserta->max('stage'))->get();
        }
        return view('admin.agenda.stage', compact('peserta','lomba','lives'));
    }

    public function nextStage(Lomba $lomba, Request $request){
        $peserta = LombaStage::where('lomba_id',$lomba->id)->where('stage',$request->stage)->where('is_elimination',0)->get(['lomba_id','gudep_id','peserta_id'])->toArray();
        foreach($peserta as $p){
            $data = $p;
            $data['stage'] = $request->stage + 1;
            LombaStage::create($data);
        }
        return back()->with('success','Data berhasil disimpan');
    }

    public function updateLombaStage(LombaStage $lomba_stage, Request $request){
        $lomba_stage->update($request->all());
        return back()->with('success','Data berhasil disimpan');
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
                $files = PesertaLomba::join('tb_anggota','tb_anggota.id','peserta_lomba.anggota_id')
                    ->where('peserta_lomba.lomba_id', $lomba->id)
                    ->select('peserta_lomba.*','tb_anggota.provinsi','tb_anggota.kabupaten','tb_anggota.kecamatan','tb_anggota.gudep')
                    ->get()
                    ->groupBy($lomba->kegiatan->agenda->tingkat);
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
        $cek = PointJuri::where('peserta_id',$request->peserta_id)->where('juri_id',$request->juri_id)->where('lomba_id',$request->lomba_id)->first();
        if ($cek) {
            $cek->update([
                'point' => $request->point,
                'description' => $request->description
            ]);
        }else{
            $cek = PointJuri::create($request->all());
        }
        // $res = PointJuri::upsert([$data],['juri_id','peserta_id','lomba_id'],['point','description']);

        return response($cek);
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
                $pen = PointJuri::all()->where('lomba_id',$lomba->id)->groupBy('peserta_id');
                foreach ($pen as $key => $item) {
                    if($lomba->kegiatan->agenda->tingkat=='provinsi'){
                        $name = $item->first()->peserta->anggota->province->name;
                    }elseif($lomba->kegiatan->agenda->tingkat=='kabupaten'){
                        $name = $item->first()->peserta->anggota->city->name;
                    }elseif($lomba->kegiatan->agenda->tingkat=='kecamatan'){
                        $name = $item->first()->peserta->anggota->district->name;
                    }else{
                        $name = $item->first()->peserta->anggota->gudepInfo->nama_sekolah;
                    }
                    $data[$key]['nama'] = $name;
                    $data[$key]['point'] = $item->sum('point')/$juriCount;
                }
                $data = collect($data);
                $data = $data->sortByDesc('point');
            }else{
                $data = array();
                $pen = PesertaLomba::all()->where('lomba_id',$lomba->id);
                foreach ($pen as $key => $item) {
                    $data[$key]['nama'] = $item->anggota->nama;
                    $data[$key]['point'] = (int)PointJuri::all()->where('lomba_id',$lomba->id)->whereNull('gudep_id')->where('peserta_id',$item->id)->sum('point');
                }
                $data = collect($data);
                $data = $data->sortByDesc('point');
            }
        }
        if ($lomba->penilaian=='objective') {
            if($lomba->kepesertaan=='kelompok'){
                $data = LombaStage::join('peserta_lomba','peserta_lomba.id','=','lomba_stages.peserta_id')
                        ->join('tb_anggota','tb_anggota.id','=','peserta_lomba.anggota_id')
                        ->where('lomba_stages.lomba_id',$lomba->id)
                        ->select('lomba_stages.*','tb_anggota.provinsi','tb_anggota.kabupaten','tb_anggota.kecamatan','tb_anggota.gudep')
                        ->orderBy('stage','desc')
                        ->get()
                        ->groupBy($lomba->kegiatan->agenda->tingkat);
            }else{
                $data = LombaStage::where('lomba_id',$lomba->id)->orderBy('stage','desc')->orderBy('point','desc')->get()->groupBy('peserta_id');
            }
        }
        return view('admin.agenda.lomba_hasil',compact('lomba','data'));
    }

    public function update(Request $request, Lomba $lomba)
    {
        $data = $request->all();

        if($file = $request->file('sertifikat')){
            $fileName = 'sertifikat-lomba-'.$lomba->id.'.jpg';
            $file->move(public_path('/berkas/agenda'), $fileName);
            $data['sertifikat'] = $fileName;
            $lomba->update($data);
            return back()->with('success','Sertifikat disimpan');
        }
        $lomba->update($data);
        return redirect()->route('agenda.index')->with('success', 'Data berhasil diubah');
    }
}
