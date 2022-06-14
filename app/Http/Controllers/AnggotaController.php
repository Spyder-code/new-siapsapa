<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaRequest;
use App\Models\Anggota;
use App\Models\City;
use App\Models\Distrik;
use App\Models\Provinsi;
use App\Repositories\AnggotaService;
use App\Repositories\WilayahService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AnggotaController extends Controller
{
    public function index()
    {
        $is_gudep = false;
        if(request('gudep')){
            $is_gudep = true;
        }
        if(request('id_wilayah')){
            $id_wilayah = request('id_wilayah');
        }else{
            $user = Auth::user();
            $role = $user->role;
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        $kwartir = $data[1];
        $title = $data[0]->name ?? 'Nasional';
        return view('admin.anggota.index', compact('is_gudep','data','id_wilayah','kwartir','title'));
    }

    public function create()
    {
        if(request('id_wilayah')){
            $id_wilayah = request('id_wilayah');
        }else{
            $user = Auth::user();
            $role = $user->role;
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        if($data[0]==null){
            $data[0] = Provinsi::pluck('name', 'id');
        }

        return view('admin.anggota.create', compact('data'));
    }

    public function edit(Anggota $anggotum)
    {
        $anggota = $anggotum;
        if(request('id_wilayah')){
            $id_wilayah = request('id_wilayah');
        }else{
            $user = Auth::user();
            $role = $user->role;
            if($role=='admin')
                $id_wilayah = 'all';
            if($role=='kwarda')
                $id_wilayah = $user->anggota->provinsi;
            if($role=='kwarcab')
                $id_wilayah = $user->anggota->kabupaten;
            if($role=='kwaran')
                $id_wilayah = $user->anggota->kecamatan;
        }

        $wilayah = new WilayahService($id_wilayah);
        $data = $wilayah->getData();
        if($data[0]==null){
            $data[0] = Provinsi::pluck('name', 'id');
        }

        return view('admin.anggota.edit', compact('data','anggota'));
    }

    public function store(AnggotaRequest $request)
    {
        $data = $request->validated();
        $service = new AnggotaService();
        $anggota = $service->createUser($data);
        return redirect()->route('anggota.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(AnggotaRequest $request, Anggota $anggotum)
    {
        $data = $request->validated();
        $service = new AnggotaService();
        $anggota = $service->updateUser($data, $anggotum);
        return redirect()->route('anggota.index')->with('success', 'Data berhasil diubah');
    }

    public function data_table()
    {
        $id_wilayah = request('id_wilayah');
        $is_gudep = request('gudep');
        $query = Anggota::query();
        if($is_gudep == 1){
            $query->whereNotNull('gudep');
        }else{
            $query->whereNull('gudep');
        }

        if($id_wilayah=='all'){
            $data = $query->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
        }else{
            $len = strlen($id_wilayah);
            if ($len==2) {
                $data = $query->where('provinsi',$id_wilayah)->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
            }elseif($len==4){
                $data =  $query->where('kabupaten',$id_wilayah)->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
            }else{
                $data = $query->where('kecamatan',$id_wilayah)->select('id','kode','jk','nama','tgl_lahir','foto','pramuka','gudep','kabupaten','kecamatan','provinsi');
            }

        }

        return DataTables::of($data)
            ->addColumn('foto', function($data){
                if($data->pramuka==1){
                    $warna = '<span class="badge bg-siaga">Siaga</span>';
                }elseif($data->pramuka==2){
                    $warna = '<span class="badge bg-penggalang">Penggalang</span>';
                }elseif($data->pramuka==3){
                    $warna = '<span class="badge bg-penegak">Penegak</span>';
                }elseif($data->pramuka==4){
                    $warna = '<span class="badge bg-pandega">Pandega</span>';
                }elseif($data->pramuka==5){
                    $warna = '<span class="badge bg-dewasa">Dewasa</span>';
                }
                return '
                    <div class="justify-content-center text-center">
                    <img src="'.asset('berkas/anggota/'.$data->foto).'" class="img-thumbnail mx-auto d-block" height="80px" width="80px">
                        '.$warna.'
                    </div>
                ';
            })
            ->addColumn('action', function ($data) {
                $html = '<div class="btn-group">
                            <a href="'.route('anggota.edit',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Anggota" class="btn btn-sm btn-warning" style="width:30px"><i class="fas fa-edit"></i></a>
                            <a href="'.route('anggota.show',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Anggota" class="btn btn-sm btn-info" style="width:30px"><i class="fas fa-info"></i></a>
                            <a href="'.route('anggota.show',$data->id).'" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Anggota" class="btn btn-sm btn-secondary" style="width:30px"><i class="fas fa-power-off"></i></a>
                        </div>';
                return $html;
            })
            ->addColumn('kabupaten', function ($data) {
                return $data->city->name;
            })
            ->addColumn('kecamatan', function ($data) {
                return $data->district->name;
            })
            ->rawColumns(['action','foto'])
            ->make(true);
    }

    public function warna($pramuka)
    {
        if($pramuka==1){
            return '<span class="badge badge-danger">Siaga</span>';
        }elseif($pramuka==2){
            return '<span class="badge badge-warning">Waspada</span>';
        }elseif($pramuka==3){
            return '<span class="badge badge-success">Kompeten</span>';
        }elseif($pramuka==4){
            return '<span class="badge badge-secondary">Tidak Pramuka</span>';
        }elseif($pramuka==5){
            return '<span class="badge badge-primary">Pramuka</span>';
        }
    }
}
