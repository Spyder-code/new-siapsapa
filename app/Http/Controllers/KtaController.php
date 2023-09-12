<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Distrik;
use App\Models\Kta;
use App\Models\Provinsi;
use App\Repositories\KtaService;
use Illuminate\Http\Request;

class KtaController extends Controller
{
    public function index()
    {
        $id_wilayah = request('id_wilayah');
        $data = $this->getData($id_wilayah);
        $title = 'KTA '.$data[1].' '.$data[0]->name;
        $kabupaten = $data[0];
        $siaga = Kta::where('kabupaten', $kabupaten->id)->where('pramuka_id',1)->first();
        $penggalang = Kta::where('kabupaten', $kabupaten->id)->where('pramuka_id',2)->first();
        $penegak = Kta::where('kabupaten', $kabupaten->id)->where('pramuka_id',3)->first();
        $pandega = Kta::where('kabupaten', $kabupaten->id)->where('pramuka_id',4)->first();
        $dewasa = Kta::where('kabupaten', $kabupaten->id)->where('pramuka_id',5)->first();
        $kta = [
            'siaga' => $siaga,
            'penggalang' => $penggalang,
            'penegak' => $penegak,
            'pandega' => $pandega,
            'dewasa' => $dewasa,
        ];
        return view('admin.kta.index', compact('title','kabupaten','kta'));
    }

    public function getData($id_wilayah)
    {
        if ($id_wilayah=='all') {
            return [null,null];
        }
        $len = strlen($id_wilayah);
        if ($len==2) {
            $data = Provinsi::find($id_wilayah, ['name', 'id', 'no_prov as code', 'id as prev']);
            $kwartir = 'Provinsi';
        }elseif($len==4){
            $data = City::find($id_wilayah);
            $kwartir = 'Kabupaten';
        }else{
            $data = Distrik::find($id_wilayah, ['name', 'id', 'no_kec as code', 'regency_id as prev']);
            $kwartir = 'Kecamatan';
        }

        return [$data, $kwartir];
    }

    public function store(Request $request)
    {
        $siaga = Kta::where('kabupaten', $request->kabupaten)->where('pramuka_id', 1)->first();
        $penggalang = Kta::where('kabupaten', $request->kabupaten)->where('pramuka_id', 2)->first();
        $penegak = Kta::where('kabupaten', $request->kabupaten)->where('pramuka_id', 3)->first();
        $pandega = Kta::where('kabupaten', $request->kabupaten)->where('pramuka_id', 4)->first();
        $dewasa = Kta::where('kabupaten', $request->kabupaten)->where('pramuka_id', 5)->first();

        $data = [
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
        ];

        if($request->siaga){
            $request->validate([
                'siaga' => 'array',
                'siaga.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $data_siaga = $data;
            $data_siaga['pramuka_id'] = 1;
            $data_siaga['depan'] = $request->siaga[0] ?? null;
            $data_siaga['belakang'] = $request->siaga[1] ?? null;
            if($siaga==null){
                $service = new KtaService();
                $service->insertData($data_siaga);
            }else{
                $service = new KtaService();
                $service->updateData($data_siaga, $siaga);
            }
        }

        if($request->penggalang){
            $data_penggalang = $data;
            $data_penggalang['pramuka_id'] = 2;
            $data_penggalang['depan'] = $request->penggalang[0] ?? null;
            $data_penggalang['belakang'] = $request->penggalang[1] ?? null;
            if($penggalang==null){
                $service = new KtaService();
                $service->insertData($data_penggalang);
            }else{
                $service = new KtaService();
                $service->updateData($data_penggalang, $penggalang);
            }
        }

        if($request->penegak){
            $data_penegak = $data;
            $data_penegak['pramuka_id'] = 3;
            $data_penegak['depan'] = $request->penegak[0] ?? null;
            $data_penegak['belakang'] = $request->penegak[1] ?? null;
            if($penegak==null){
                $service = new KtaService();
                $service->insertData($data_penegak);
            }else{
                $service = new KtaService();
                $service->updateData($data_penegak, $penegak);
            }
        }

        if($request->pandega){
            $data_pandega = $data;
            $data_pandega['pramuka_id'] = 4;
            $data_pandega['depan'] = $request->pandega[0] ?? null;
            $data_pandega['belakang'] = $request->pandega[1] ?? null;
            if($pandega==null){
                $service = new KtaService();
                $service->insertData($data_pandega);
            }else{
                $service = new KtaService();
                $service->updateData($data_pandega, $pandega);
            }
        }

        if($request->dewasa){
            $data_dewasa = $data;
            $data_dewasa['pramuka_id'] = 5;
            $data_dewasa['depan'] = $request->dewasa[0] ?? null;
            $data_dewasa['belakang'] = $request->dewasa[1] ?? null;
            if($dewasa==null){
                $service = new KtaService();
                $service->insertData($data_dewasa);
            }else{
                $service = new KtaService();
                $service->updateData($data_dewasa, $dewasa);
            }
        }

        return back()->with('success', 'Data berhasil disimpan');
    }
}
